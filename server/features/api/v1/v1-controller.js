const express = require('express');

const stagesController = require('./stages/stages-controller');

let router = express.Router();
router.use('/stages', stagesController);

module.exports = router;
