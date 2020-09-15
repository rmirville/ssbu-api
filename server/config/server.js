require('dotenv').config();

const hostname = process.env.SSBUTOOLS_API_HOST;

let portTemp = process.env.SSBUTOOLS_API_PORT;
const port = ((portTemp !== undefined) && (portTemp.length > 0)) ? portTemp : null;

const serverConfig = {hostname, port};
Object.freeze(serverConfig);

module.exports = serverConfig;
