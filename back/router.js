var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

/* test post */
router.post('/', function(req, res, next) {
  res.json(req.body);
})

module.exports = router;
