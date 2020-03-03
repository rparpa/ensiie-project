var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');

var indexRouter = require('./router');
var usersRouter = require('./src/controller/users');
var openDataParisRouter = require('./src/controller/openDataParisController') ;

var app = express();

//add caching with apicache for all application
//const apicache = require('apicache');
//const cache = apicache.middleware;
//app.use(cache("5 minutes")) ;

app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.use('/', indexRouter);
app.use('/users', usersRouter);
app.use('/openDataParis', openDataParisRouter);

module.exports = app;
