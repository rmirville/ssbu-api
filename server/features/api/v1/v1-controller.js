const express = require('express');

const stagesController = require('./stages/stages-controller');

const { HomeService } = require('./home/home-service');

const homeSvc = new HomeService();

let router = express.Router();
router.use('/stages', stagesController);

router.get('/', homeSvc.getIndex);

module.exports = router;
