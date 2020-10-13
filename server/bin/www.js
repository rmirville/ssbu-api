#!/usr/bin/env node

/**
 * Module dependencies.
 */
const serverConfig = require('../config/server');
const dbConfig = require('../config/db');
var app = require('../app/app');

app.create(serverConfig, dbConfig);
app.start();
