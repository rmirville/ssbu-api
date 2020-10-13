const express = require('express');

class HomeService {
  constructor() {}
  async getIndex(req, res, next) {
    res.append('Content-Type', 'application/hal+json');
    return res.status(200).json({
      "_links": {
        "self": {
          "href": ""
        },
        "stages": {
          "href": "/stages"
        }
      }
    });
  }
}

module.exports = { HomeService };
