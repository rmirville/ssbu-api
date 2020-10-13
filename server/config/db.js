require('dotenv').config({path: '../../.env'});

const { normalizePort } = require('../shared/utility/network');

const hostname = process.env.SSBUTOOLS_DB_MONGO_R_HOST;

const port = normalizePort(process.env.SSBUTOOLS_DB_MONGO_R_PORT);

const dbname = process.env.SSBUTOOLS_DB_MONGO_R_DB;
const username = process.env.SSBUTOOLS_DB_MONGO_R_USER;
const secret = process.env.SSBUTOOLS_DB_MONGO_R_SECRET;
const type = process.env.SSBUTOOLS_DB_MONGO_R_TYPE;

const dbConfig = {type, hostname, port, dbname, username, secret};
Object.freeze(dbConfig);

module.exports = dbConfig;
