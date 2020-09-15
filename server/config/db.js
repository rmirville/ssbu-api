require('dotenv').config();

const hostname = process.env.SSBUTOOLS_DB_MONGO_R_HOST;

let portTemp = process.env.SSBUTOOLS_DB_MONGO_R_PORT;
const port = (portTemp.length > 0) ? portTemp : null;

const dbname = process.env.SSBUTOOLS_DB_MONGO_R_DB;
const username = process.env.SSBUTOOLS_DB_MONGO_R_USER;
const secret = process.env.SSBUTOOLS_DB_MONGO_R_SECRET;

module.exports = {hostname, port, dbname, username, secret};
