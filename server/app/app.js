const cookieParser = require('cookie-parser');
const debug = require('debug')('ssbu-api:server');
const express = require('express');
const http = require('http');
const logger = require('morgan');
const path = require('path');

const { DBService } = require('./persistence/db-service');

class App {
  expApp;
  db;
  server;
  router;

  constructor() {
    if (App.instance) {
      return App.instance;
    }
    else {
      App.instance = {
        create: this.create,
        start: this.start
      };
      return App.instance;
    }
  }

  create(serverConfig, dbConfig) {
    this.expApp = express();
    this.router = require('./app-router');
    
    this.expApp.use(logger('dev'));
    this.expApp.use(express.json());
    this.expApp.use(express.urlencoded({ extended: false }));
    this.expApp.use(cookieParser());
    this.expApp.use(express.static(path.join(__dirname, '../public')));

    // get port from environment and store in Express
    const serverPort = this._normalizePort(serverConfig.port.toString() || '3000');
    this.expApp.set('port', serverPort);

    // create http server
    this.server = http.createServer(this.expApp);

    const dbInfo = {
      hostname: dbConfig.hostname,
      port: dbConfig.port,
      dbname: dbConfig.dbname,
      username: dbConfig.username,
      secret: dbConfig.secret,
    }

    // connect to database
    this.db = DBService.connect(dbConfig.type, dbInfo);

    // import routes
    router.init(this.expApp);
  }

  /**
   * Listen on provided port, on all network interfaces.
   */
  start() {
    this.server.listen(port);
    this.server.on('error', this._onError);
    this.server.on('listening', this._onListening);
  }

  /**
   * Event listener for http server "error" event.
   */
  _onError(error) {
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
  }
  
  /**
   * Event listener for HTTP server "listening" event.
   */
  _onListening() {
    var addr = server.address();
    var bind = typeof addr === 'string'
      ? 'pipe ' + addr
      : 'port ' + addr.port;
    debug('Listening on ' + bind);
  }
}

const app = new App();

Object.freeze(app);

module.exports = app;
