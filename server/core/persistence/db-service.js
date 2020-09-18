const mongoose = require('mongoose');

class DBService {
  constructor() { }

  static connect(type, hostname, port, dbname, username, secret) {
    // assuming type = 'mongodb'
    return this._connectMongo(hostname, port, dbname, username, secret);
  }

  static _connectMongo(hostname, port, dbname, username, secret) {

    const urlPrefix = `mongodb+srv://${username}:${secret}@${hostname}`;

    const urlPort = (port !== null) ? `:${port}` : '';

    const urlSuffix = `/${dbname}?retryWrites=true&w=majority`;

    const url = urlPrefix + urlPort + urlSuffix;

    return mongoose.connect(url, {useNewUrlParser: true, useUnifiedTopology: true});
  }
}

module.exports = { DBService };
