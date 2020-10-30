const express = require('express');
const request = require('supertest');

const expApp = express();

const { HomeService } = require('./home-service');

describe('HomeService -', () => {
  const homeSvc = new HomeService();

  describe('getIndex() -', () => {

    beforeEach(() => {
      expApp.get('/', homeSvc.getIndex);
    });

    describe('response -', () => {

      it('is a HAL json response', (done) => {
        /// console.log('\n=== SPEC - return HAL json file');
        request(expApp)
          .get('/')
          .expect('Content-Type', /application\/hal\+json/)
          .end((err, res) => {
            /// console.log(`response: ${JSON.stringify(res.header['content-type'])}`);
            if (err) done.fail(JSON.stringify(err));
            else done(res);
          });
      });

    });
  });
});


