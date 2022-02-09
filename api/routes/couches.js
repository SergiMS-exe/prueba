module.exports = function (app, gestorBD) {
  // sofas de un pasajero
  function sofasPasajero(req, res) {
    let origen = req.query.origen;
    let destino = req.query.destino;

    if (origen == null) origen = "";
    if (destino == null) destino = "";

    let query = {
      $and: [
        { lugar_salida: { $regex: ".*" + origen + ".*", $options: "i" } },
        { lugar_llegada: { $regex: ".*" + destino + ".*", $options: "i" } },
        { id_pasajeros: { $in: [req.query.passenger] } }
      ]
    };


    let criterio = { _id: gestorBD.mongo.ObjectID(req.query.passenger) };

    gestorBD.obtenerItem(criterio, "usuarios", function (resultUser) {
      if (resultUser == null)
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al obtener el usuario, intentelo de nuevo más tarde",
          },
        });
      else {
        gestorBD.obtenerItem(query, "sofas", function (resultTravel) {
          if (resultTravel == null)
            res.send({
              Error: {
                status: 500,
                data: "Se ha producido un error al obtener los sofas del usuario, intentelo de nuevo más tarde",
              },
            });
          else
            res.send({
              status: 200,
              data: { pasajero: resultUser, sofas: resultTravel },
            });
        });
      }
    });
  };

  // Todos los sofas
  app.get("/couches", function (req, res) {
    let direccion = req.query.direccion;
    let destino = req.query.destino;

    let criterio = {};

    if (direccion != null)
      criterio = { direccion: { $regex: ".*" + direccion + ".*", $options: "i" } };
    if (destino == null) destino = "";

    
      gestorBD.obtenerItem(criterio, "sofas", function (sofas) {
        if (sofas == null)
          res.send({
            Error: {
              status: 500,
              data: "Se ha producido un error al obtener los sofas, intentelo de nuevo más tarde",
            },
          });
        else {
          res.send({ status: 200, data: { sofas: sofas } });
        }
      });
    
  });

  //sofas con el id de un conductor concreto
  function sofasConductor(req, res) {
    let origen = req.query.origen;
    let destino = req.query.destino;

    if (origen == null) origen = "";
    if (destino == null) destino = "";

    let query = {
      $and: [
        { lugar_salida: { $regex: ".*" + origen + ".*", $options: "i" } },
        { lugar_llegada: { $regex: ".*" + destino + ".*", $options: "i" } },
        { id_conductor: req.query.driver }
      ]
    };

    let criterio = { _id: gestorBD.mongo.ObjectID(req.query.driver) };
    gestorBD.obtenerItem(criterio, "usuarios", function (resultUser) {
      if (resultUser == null)
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al obtener el conductor, intentelo de nuevo más tarde",
          },
        });
      else {
        gestorBD.obtenerItem(query, "sofas", function (resultTravel) {
          if (resultTravel == null)
            res.send({
              Error: {
                status: 500,
                data: "Se ha producido un error al obtener los sofas del conductor, intentelo de nuevo más tarde",
              },
            });
          else
            res.send({
              status: 200,
              data: { conductor: resultUser, sofas: resultTravel },
            });
        });
      }
    });
  };

  // CRUD de sofas
  app.post("/couches", function (req, res) {
    gestorBD.insertarItem(req.body, "sofas", function (result) {
      if (result == null) {
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al insertar el , intentelo de nuevo más tarde",
          },
        });
      } else {
        res.send({ status: 200, data: { msg: "sofa insertado" } });
      }
    });
  });

  app.delete("/travels", function (req, res) {
    let criterio = { _id: gestorBD.mongo.ObjectID(req.body.id) };
    gestorBD.eliminarItem(criterio, "sofas", function (result) {
      if (result == null) {
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al borrar el sofa, intentelo de nuevo más tarde",
          },
        });
      } else {
        res.send({ status: 200, data: { msg: "sofa eliminado" } });
      }
    });
  });

  app.get("/travels/:id", function (req, res) {
    let criterio = { _id: gestorBD.mongo.ObjectID(req.params.id) };
    gestorBD.obtenerItem(criterio, "sofas", function (sofa) {
      if (sofa == null) {
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error inesperado, intentelo de nuevo más tarde",
          },
        });
      } else {
        res.send({ status: 200, data: { sofa: sofa } });
      }
    });
  });

  app.put("/travels/:id", function (req, res) {
    let criterio = { _id: gestorBD.mongo.ObjectID(req.params.id) };
    let nuevosofa = req.body;
    gestorBD.modificarItem(criterio, nuevosofa, "sofas", function (result) {
      if (result == null)
        res.send({
          Error: {
            status: 500,
            data: "Se ha producido un error al modificar el sofa, intentelo de nuevo más tarde",
          },
        });
      else {
        res.send({ status: 200, data: { msg: "Editado correctamente" } });
      }
    });
  });
};
