const cookieParser = require('cookie-parser');
const debug = require('debug')('ssbu-api:server');
const express = require('express');
const http = require('http');
const logger = require('morgan');
const path = require('path');

const { normalizePort } = require('../shared/utility/network');
const { DBService } = require('./persistence/db-service');

class App {
  expApp;
  db;
  server;
  router;
  serverConfig;
  dbConfig;

  constructor() { }

  create(serverConfig, dbConfig) {
    this._validateParams(serverConfig, dbConfig);

    this.expApp = express();
    this.router = require('./app-router');
    
    this.expApp.use(logger('dev'));
    this.expApp.use(express.json());
    this.expApp.use(express.urlencoded({ extended: false }));
    this.expApp.use(cookieParser());
    this.expApp.use(express.static(path.join(__dirname, '../../public')));

    // get port from environment and store in Express
    const serverPort = normalizePort(serverConfig.port) || 3000;
    this.expApp.set('port', serverPort);

    // create http server
    this.server = http.createServer(this.expApp);

    // get database info from environment and connect to database
    const dbPort = normalizePort(dbConfig.port);
    const dbInfo = {
      hostname: dbConfig.hostname,
      port: dbPort,
      dbname: dbConfig.dbname,
      username: dbConfig.username,
      secret: dbConfig.secret
    };

    this.dbConfig = {
      type: dbConfig.type,
      port: dbPort,
      dbname: dbConfig.dbname,
      username: dbConfig.username,
      secret: dbConfig.secret
    };

    this.serverConfig = {
      hostname: serverConfig.hostname,
      port: serverPort
    };

    // connect to database
    this.db = DBService.connect(dbConfig.type, dbInfo);

    // import routes
    this.router.init(this.expApp);
  }

  /**
   * Listen on provided port, on all network interfaces.
   */
  start() {
    const port = normalizePort(this.serverConfig.port);
    if (port) {
      this.server.listen(port);
    }
    else {
      this.server.listen();
    }
    this.server.on('error', e => { this._onError(e); });
    this.server.on('listening', () => { this._onListening(); });
  }

  /**
   * Event listener for http server "error" event.
   */
  _onError = function(error) {
    if (error.syscall !== 'listen') {
      throw error;
    }
  
    var bind = typeof port === 'string'
      ? 'Pipe ' + port
      : 'Port ' + port;
  
    // handle specific listen errors with friendly messages
    switch (error.code) {
      case 'EACCES':
        console.error(bind + ' requires elevated privileges');
        process.exit(1);
        break;
      case 'EADDRINUSE':
        console.error(bind + ' is already in use');
        process.exit(1);
        break;
      default:
        throw error;
    }
  };
  
  /**
   * Event listener for HTTP server "listening" event.
   */
  _onListening = function() {
    var addr = this.server.address();
    var bind = typeof addr === 'string'
      ? 'pipe ' + addr
      : 'port ' + addr.port;
    debug('Listening on ' + bind);
  };

  _validateParams(serverConfig, dbConfig) {
    const stringDbParams = {type: dbConfig.type, hostname: dbConfig.hostname, dbname: dbConfig.dbname, username: dbConfig.username, secret: dbConfig.secret};

    for (const param in stringDbParams) {
      if (stringDbParams.hasOwnProperty(param)) {
        if ((typeof stringDbParams[param] === 'undefined') || (typeof stringDbParams[param] !== 'string')) {
          throw new TypeError(`Database ${param} is not of type string`);
        }
      }
    }

    if ((typeof serverConfig.hostname === 'undefined') || (typeof serverConfig.hostname !== 'string')) {
      throw new TypeError(`Server hostname is not of type string`);
    }
  }
}

const app = new App();

module.exports = app;
