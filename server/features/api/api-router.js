const express = require('express');

const apiV1Controller = require('./v1/v1-controller');

let router = express.Router();
router.use('/v1', apiV1Controller);

module.exports = router;
