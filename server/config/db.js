require('dotenv').config();

const hostname = process.env.SSBUTOOLS_DB_MONGO_R_HOST;

let portTemp = process.env.SSBUTOOLS_DB_MONGO_R_PORT;
const port = ((typeof portTemp !== 'undefined') && (portTemp.length > 0)) ? parseInt(portTemp) : null;

const dbname = process.env.SSBUTOOLS_DB_MONGO_R_DB;
const username = process.env.SSBUTOOLS_DB_MONGO_R_USER;
const secret = process.env.SSBUTOOLS_DB_MONGO_R_SECRET;
const type = process.env.SSBUTOOLS_DB_MONGO_R_TYPE;

const dbConfig = {type, hostname, port, dbname, username, secret};

Object.freeze(dbConfig);

module.exports = dbConfig;
