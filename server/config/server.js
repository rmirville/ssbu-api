require('dotenv').config();

const { normalizePort } = require('../shared/utility/network');

const hostname = process.env.SSBUTOOLS_API_HOST;
const port = normalizePort(process.env.SSBUTOOLS_API_PORT);

const serverConfig = {hostname, port};
Object.freeze(serverConfig);

module.exports = serverConfig;
