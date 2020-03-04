var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');
var cors = require('cors');

var indexRouter = require('./router');
var usersRouter = require('./src/controller/users');
var openDataParisRouter = require('./src/controller/openDataParisController') ;

var app = express();

app.use(function(req, res, next) {
  res.header("Access-Control-Allow-Origin", "*");
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  next();
});

// //add caching with apicache
// const apicache = require('apicache');
// const cache = apicache.middleware;
// app.use(cache("5 minutes"));

app.use(cors());
app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));


app.use('/', indexRouter);
app.use('/users', usersRouter);
app.use('/openDataParis', openDataParisRouter);

module.exports = app;