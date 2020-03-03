var express = require('express');
var router = express.Router();

const AuthenticationController = require('./src/controller/authenticationController');
const User = require('./src/entity/User');

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

router.post('/authentication', function(req, res, next) {
  const controller = new AuthenticationController();
  (async () => {
    const user = await controller.getUserFromCredentials(req.body.username, req.body.password);
    if (undefined !== user) {
      res.send(user.toJson());
    } else {
      return res.status(404).send({
        message: 'Incorrect credentials'
      });
    }
  })()
})

router.post('/registration', function(req, res, next) {
  const controller = new AuthenticationController();
  (async () => {
    const user = await controller.createUser(req.body.username, req.body.email, req.body.password);
    if (undefined !== user) {
      res.send(user.toJson());
    } else {
      return res.status(409).send({
        message: 'Cannot create user'
      });
    }
  })()
})

module.exports = router;
