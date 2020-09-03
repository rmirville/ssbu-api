var express = require('express');
var router = express.Router();

/* GET users listing. */
router.get('/classifications', function(req, res, next) {
  res.send('stage classifications');
});

router.get('/piece-maps', function(req, res, next) {
  res.send('stage piece maps');
});

module.exports = router;
