module.exports = function (app, gestorBD) {
  // Viajes de un pasajero
  app.get("/viajespasajero/:id", function (req, res) {
    let criterio = { _id: gestorBD.mongo.ObjectID(req.params.id) };
    gestorBD.obtenerItem(criterio, "usuarios", function (resultUser) {
      if (resultUser == null)
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al obtener el usuario, intentelo de nuevo más tarde",
          },
        });
      else {
        let query = { id_pasajeros: req.params.id };
        gestorBD.obtenerItem(query, "viajes", function (resultTravel) {
          if (resultTravel == null)
            res.send({
              Error: {
                status: 500,
                data: "Se ha producido un error al obtener los viajes del usuario, intentelo de nuevo más tarde",
              },
            });
          else
            res.send({
              status: 200,
              data: { pasajero: resultUser, viajes: resultTravel },
            });
        });
      }
    });
  });

  // Todos los viajes (TODO: Se podrán hacer busquedas sobre ellos)
  app.get("/articulos", function (req, res) {
    gestorBD.obtenerItem({}, "articulos", function (articulos) {
      if (articulos == null)
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al obtener los articulos, intentelo de nuevo más tarde",
          },
        });
      else {
        res.send({ status: 200, data: { articulos: articulos } });
      }
    });
  });

  //Viajes con el id de un conductor concreto
  app.get("/viajesconductor/:id", function (req, res) {
    let criterio = { _id: gestorBD.mongo.ObjectID(req.params.id) };
    gestorBD.obtenerItem(criterio, "usuarios", function (resultUser) {
      if (resultUser == null)
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al obtener el conductor, intentelo de nuevo más tarde",
          },
        });
      else {
        let query = { id_conductor: req.params.id };
        gestorBD.obtenerItem(query, "viajes", function (resultTravel) {
          if (resultTravel == null)
            res.send({
              Error: {
                status: 500,
                data: "Se ha producido un error al obtener los viajes del conductor, intentelo de nuevo más tarde",
              },
            });
          else
            res.send({
              status: 200,
              data: { conductor: resultUser, viajes: resultTravel },
            });
        });
      }
    });
  });

  // CRUD de articulos
  app.post("/articulos/add", function (req, res) {
    gestorBD.insertarItem(req.body, "articulos", function (result) {
      if (result == null) {
        console.log("WARN: Fallo al insertar un articulo.");
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al insertar el articulo, intentelo de nuevo más tarde",
          },
        });
      } else {
        res.send({ status: 200, data: { msg: "articulo insertado" } });
      }
    });
  });

  app.delete("/articulos/delete", function (req, res) {
    let criterio = { _id: gestorBD.mongo.ObjectID(req.body.id) };
    gestorBD.eliminarItem(criterio, "articulos", function (result) {
      if (result == null) {
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al borrar el articulo, intentelo de nuevo más tarde",
          },
        });
      } else {
        res.send({ status: 200, data: { msg: "articulo eliminado" } });
      }
    });
  });

  app.get("/articulos/edit/:id", function (req, res) {
    let criterio = { _id: gestorBD.mongo.ObjectID(req.params.id) };
    gestorBD.obtenerItem(criterio, "articulos", function (articulo) {
      if (articulo == null) {
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error inesperado, intentelo de nuevo más tarde",
          },
        });
      } else {
        res.send({ status: 200, data: { articulo: articulo } });
      }
    });
  });

  app.put("/articulos/edit/:id", function (req, res) {
    let criterio = { _id: gestorBD.mongo.ObjectID(req.params.id) };
    let nuevoarticulo = req.body;
    gestorBD.modificarItem(criterio, nuevoarticulo, "articulos", function (result) {
      if (result == null)
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al modificar el articulo, intentelo de nuevo más tarde",
          },
        });
      else {
        res.send({ status: 200, data: { msg: "Editado correctamente" } });
      }
    });
  });

  app.get("/articulos/search", function (req, res) {
    let origen = req.query.origen;
    let destino = req.query.destino;
    let fecha = req.query.fecha;
    let hora = req.query.hora;

    let criterio = {
      $and: [{ lugar_salida: origen }, { lugar_llegada: destino }],
    };
    gestorBD.obtenerItem(criterio, "articulos", function (result) {
      if (result == null)
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al modificar el articulo, intentelo de nuevo más tarde",
          },
        });
      else {
          console.log(result)
        res.send({ status: 200, articulos: result });
      }
    });
  });
};
