module.exports = function (app, gestorBD) {
    
    // Todos los sofas
    app.get("/bookings/:sofa", function (req, res) {
      let sofa = req.params.sofa;
      let destino = req.query.destino;
  
      let criterio = {id_sofa: sofa};
  
        gestorBD.obtenerItem(criterio, "reservas", function (reservas) {
          if (sofas == null)
            res.send({
              Error: {
                status: 500,
                data: "Se ha producido un error al obtener los sofas, intentelo de nuevo más tarde",
              },
            });
          else {
            
            res.send({ status: 200, data: { reservas: reservas } });
          }
        });
      
    });
  
  
    // CRUD de sofas
    app.post("/bookings", function (req, res) {
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
  