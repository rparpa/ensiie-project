var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

/* POST request on home page: authentication & create user */
router.post('/authentication', function(req, res, next) {
  console.log("use authentication controller")
})

module.exports = router;
