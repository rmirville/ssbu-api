const mongoose = require('mongoose');

class DBService {
  constructor() { }

  static connect(type, info) {

    try {
      this._validateParams(type, info)
    } catch (err) {
      return new Promise(
        (resolve, reject) => {
          reject(err);
        }
      )
    }

    return this._connectMongo(info);
  }

  static _connectMongo(info) {
    const urlPrefix = `mongodb+srv://${info.username}:${info.secret}@${info.hostname}`;

    const urlSuffix = `/${info.dbname}?retryWrites=true&w=majority`;

    const url = urlPrefix + urlSuffix;
    return mongoose.connect(url, {useNewUrlParser: true, useUnifiedTopology: true});
  }

  static _validateParams(type, info) {
    const stringParams = {type, hostname: info.hostname, dbname: info.dbname, username: info.username, secret: info.secret};

    for (const param in stringParams) {
      if (stringParams.hasOwnProperty(param)) {
        if ((typeof stringParams[param] === 'undefined') || (typeof stringParams[param] !== 'string')) {
          throw new TypeError(`${param} is not of type string`);
        }
      }
    }

    if ((typeof info.port !== 'number') && (info.port !== null)) {
      throw new TypeError('port is neither null or of type number');
    }
  }
}

module.exports = { DBService };
