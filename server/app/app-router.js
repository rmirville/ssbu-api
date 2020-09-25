const apiRouter = require('../features/api/api-router');

const init = (server) => {
    server.get('*', function (req, res, next) {
        console.log('Request was made to: ' + req.originalUrl);
        return next();
    });
    
    server.use('/api', apiRouter);
}
module.exports = {
    init: init
};
