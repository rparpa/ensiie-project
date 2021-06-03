const { client } = require('./../db');
const passwordHash = require('password-hash');

module.exports.registerHandler = (req, res) => {
    res.render("connection/connection_register.twig", {});
}

module.exports.postRegisterHandler = (req, res) => {
  let errorMsg = "";
  let id = req.body.id;
  let password = req.body.password;

  if(id !== "" && password !== "") {
    let existsSqlReq = "SELECT * FROM Utilisateur WHERE identifiant=$1;";
    let existsValues = [id];

    client.query(existsSqlReq, existsValues, (err, resp) => {
      const existsResult = err ? err.stack : resp.rows[0];

      if(existsResult === undefined) {
        let sqlReq = "INSERT INTO Utilisateur(identifiant, mdp, statut) values($1, $2, $3);";
        let values = [id, passwordHash.generate(password), 0];

        client.query(sqlReq, values, (err, resp) => {
          const result = err ? err.stack : resp.rows[0];

          if(result === undefined)
            res.redirect("/login");
          else
            res.render("connection/connection_register.twig", {error:"Impossible de créer le compte"});
        });
      } else
        res.render("connection/connection_register.twig", {error:"L'utilisateur " + id + " existe déjà"});
    });
  } else
    res.render("connection/connection_register.twig", {error:"L'identifiant et le mot de passe doivent être définis"});
}
