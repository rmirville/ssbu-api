const mongoose = require('mongoose');

class DBService {
  constructor() { }

  static connect(type, hostname, port, dbname, username, secret) {

    try {
      this._validateParams(type, hostname, port, dbname, username, secret)
    } catch (err) {
      return new Promise(
        (resolve, reject) => {
          reject(err);
        }
      )
    }

    return this._connectMongo(hostname, dbname, username, secret);
  }

  static _connectMongo(hostname, dbname, username, secret) {
    const urlPrefix = `mongodb+srv://${username}:${secret}@${hostname}`;

    const urlSuffix = `/${dbname}?retryWrites=true&w=majority`;

    const url = urlPrefix + urlSuffix;
    return mongoose.connect(url, {useNewUrlParser: true, useUnifiedTopology: true});
  }

  static _validateParams(type, hostname, port, dbname, username, secret) {
    const stringParams = {type, hostname, dbname, username, secret};

    for (const param in stringParams) {
      if (stringParams.hasOwnProperty(param)) {
        if (typeof stringParams[param] !== 'string') {
          throw new TypeError(`${param} is not of type string`);
        }
      }
    }

    if ((typeof port !== 'number') && (port !== null)) {
      throw new TypeError('port is neither null or of type number');
    }
  }
}

module.exports = { DBService };
