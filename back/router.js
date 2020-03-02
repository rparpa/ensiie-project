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
  user = controller.getUserFromCredentials(req.body.username, req.body.password);
  if (null ==! user) {
    res.send(user.toJson());
  } else {
    return res.status(404).send({
      message: 'Incorrect credentials'
    });
  }
})

module.exports = router;
