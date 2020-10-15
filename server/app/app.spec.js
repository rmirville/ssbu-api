require('dotenv').config();

const app = require('./app');

describe('App -', () => {
  const mongoose = require('mongoose');

  const dbType = 'mongodb';
  const dbHostname = process.env.SSBUTOOLS_DB_MONGO_R_HOST;
  let dbPortTemp = process.env.SSBUTOOLS_DB_MONGO_R_PORT;
  const dbPort = ((typeof dbPortTemp !== 'undefined') && (dbPortTemp.length > 0)) ? parseInt(dbPortTemp) : null;
  const dbname = process.env.SSBUTOOLS_DB_MONGO_R_DB;
  const dbUsername = process.env.SSBUTOOLS_DB_MONGO_R_USER;
  const dbSecret = process.env.SSBUTOOLS_DB_MONGO_R_SECRET;

  const svrHostname = process.env.SSBUTOOLS_API_HOST;
  let svrPortTemp = process.env.SSBUTOOLS_API_PORT;
  const svrPort = ((typeof svrPortTemp !== 'undefined') && (svrPortTemp.length > 0)) ? parseInt(svrPortTemp) : null;
  const defaultSvrPort = 3000;

  const dbConfig = {type: dbType, hostname: dbHostname, port: dbPort, dbname: dbname, username: dbUsername, secret: dbSecret};
  const svrConfig = {hostname: svrHostname, port: svrPort};

  describe('create() - ', () => {

    describe('data validation - ', () => {

      describe('svrConfig - ', () => {
  
        it('should reject a non-string server host', async () => {
          /// console.group('\n=== SPEC - create validation - reject host type');
          const badArgs = {hostname: false, port: dbPort};
  
          try {
            app.create(badArgs, dbConfig);
            fail('create() should throw an error');
          } catch (err) {
            expect(err).toBeInstanceOf(TypeError);
          }
          /// console.groupEnd();
        });
  
        it('should convert a null server port to the default port', async () => {
          /// console.group('\n=== SPEC - create validation - reject port type null');
          const badArgs = {hostname: svrHostname, port: null};
          await app.create(badArgs, dbConfig);
          expect(app.serverConfig.port).toEqual(defaultSvrPort);
          /// console.groupEnd();
        });
  
        it('should convert a true server port to the default port', async () => {
          /// console.group('\n=== SPEC - connect validation - reject port type true');
          const badArgs = {hostname: svrHostname, port: true};
          await app.create(badArgs, dbConfig);
          expect(app.serverConfig.port).toEqual(defaultSvrPort);
          /// console.groupEnd();
        });
  
        it('should convert an Object server port to the default port', async () => {
          /// console.group('\n=== SPEC - connect validation - reject port type');
          const badArgs = {hostname: svrHostname, port: {several: 'potatoes'}};
          await app.create(badArgs, dbConfig);
          expect(app.serverConfig.port).toEqual(defaultSvrPort);
          /// console.groupEnd();
        });

      });

      describe('dbConfig - ', () => {

        it('should reject a non-string db type', () => {
          /// console.group('\n=== SPEC - create validation - reject type type');
          const badArgs = {type: 47, hostname: dbHostname, port: dbPort, dbname, username: dbUsername, secret: dbSecret};
  
          try {
            app.create(svrConfig, badArgs);
            fail('create() should throw an error');
          } catch (err) {
            expect(err).toBeInstanceOf(TypeError);
          }
          /// console.groupEnd();
        });
  
        it('should reject a non-string db host', async () => {
          /// console.group('\n=== SPEC - create validation - reject host type');
          const badArgs = {type: dbType, hostname: false, port: dbPort, dbname, username: dbUsername, secret: dbSecret};
  
          try {
            app.create(svrConfig, badArgs);
            fail('create() should throw an error');
          } catch (err) {
            expect(err).toBeInstanceOf(TypeError);
          }
          /// console.groupEnd();
        });
  
        it('should convert a null db port to false', async () => {
          /// console.group('\n=== SPEC - create validation - reject port type null');
          const badArgs = {type: dbType, hostname: dbHostname, port: null, dbname, username: dbUsername, secret: dbSecret};
          await app.create(svrConfig, badArgs);
          expect(app.dbConfig.port).toBe(false);
          /// console.groupEnd();
        });
  
        it('should convert a true db port to false', async () => {
          /// console.group('\n=== SPEC - connect validation - reject port type true');
          const badArgs = {type: dbType, hostname: dbHostname, port: true, dbname, username: dbUsername, secret: dbSecret};
          await app.create(svrConfig, badArgs);
          expect(app.dbConfig.port).toBe(false);
          /// console.groupEnd();
        });
  
        it('should convert an object db port to false', async () => {
          /// console.group('\n=== SPEC - connect validation - reject port type');
          const badArgs = {type: dbType, hostname: dbHostname, port: {several: 'potatoes'}, dbname, username: dbUsername, secret: dbSecret};
          await app.create(svrConfig, badArgs);
          expect(app.dbConfig.port).toBe(false);
          /// console.groupEnd();
        });
  
        it('should reject a non-string dbname', async () => {
          /// console.group('\n=== SPEC - create validation - reject dbname type');
          const badArgs = {type: dbType, hostname: dbHostname, port: dbPort, dbname: 38.40, username: dbUsername, secret: dbSecret};
  
          try {
            app.create(svrConfig, badArgs);
            fail('create() should throw an error');
          } catch (err) {
            expect(err).toBeInstanceOf(TypeError);
          }
          /// console.groupEnd();
        });
  
        it('should reject a non-string db username', async () => {
          /// console.group('\n=== SPEC - create validation - reject username type');
          const badArgs = {type: dbType, hostname: dbHostname, port: dbPort, dbname, username: {prop: 'name'}, secret: dbSecret};
  
          try {
            app.create(svrConfig, badArgs);
            fail('create() should throw an error');
          } catch (err) {
            expect(err).toBeInstanceOf(TypeError);
          }
          /// console.groupEnd();
        });
  
        it('should reject a non-string db secret', async () => {
          /// console.group('\n=== SPEC - create validation - reject secret type');
          const badArgs = {type: dbType, hostname: dbHostname, port: dbPort, dbname, username: dbUsername, secret: -93.1};
  
          try {
            app.create(svrConfig, badArgs);
            fail('create() should throw an error');
          } catch (err) {
            expect(err).toBeInstanceOf(TypeError);
          }
          /// console.groupEnd();
        });

      });

    });

  });

  describe('start() - ', () => {

  });

});
