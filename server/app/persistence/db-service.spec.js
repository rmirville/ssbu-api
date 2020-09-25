require('dotenv').config();

const { DBService } = require('./db-service');

describe('DBService -', () => {
  const mongoose = require('mongoose');

  const type = 'mongodb';
  const hostname = process.env.SSBUTOOLS_DB_MONGO_R_HOST;
  let portTemp = process.env.SSBUTOOLS_DB_MONGO_R_PORT;
  const port = ((typeof portTemp !== 'undefined') && (portTemp.length > 0)) ? parseInt(portTemp) : null;
  const dbname = process.env.SSBUTOOLS_DB_MONGO_R_DB;
  const username = process.env.SSBUTOOLS_DB_MONGO_R_USER;
  const secret = process.env.SSBUTOOLS_DB_MONGO_R_SECRET;

  const mongoArgs = {type, info: {hostname, port, dbname, username, secret}};

  describe('DBService -', () => {

    describe('connect() -', () => {

      describe('type mongodb -', () => {

        afterEach(async () => {
          /// console.log('=== SPEC - AFTER - closing mongoose connection');
          await mongoose.connection.close();
          await mongoose.disconnect();
          /// console.log('=== SPEC - AFTER - mongoose connection closed');
        });

        describe('output -', () => {

          it('is an instance of Promise', async () => {
            /// console.group('\n=== SPEC - connect output - instance of Promise');
            const output = DBService.connect(mongoArgs.type, mongoArgs.info);
            /// console.log('SPEC - connect finished');
            /// console.log(`instance of Promise: ${output instanceof Promise}`);
            expect(output).toBeInstanceOf(Promise);
            await output;
          });

          it('resolves to a Mongoose instance', async () => {
            /// console.group('\n=== SPEC - resolves to a Mongoose instance');
            const output = await DBService.connect(mongoArgs.type, mongoArgs.info);
            expect(output).toBeInstanceOf(mongoose.Mongoose);
          });
          
          it('creates a valid MongoDB connection', async () => {
            /// console.group('\n=== SPEC - connect output - creates a valid mongodb connection:');
            const output = await DBService.connect(mongoArgs.type, mongoArgs.info);
            expect(output.connection).toBeInstanceOf(mongoose.Connection, 'should have a connection property');
            await output.connection.startSession();
            expect(output.connection.readyState).withContext('should be connected').toBe(1);
          });
        
        });

      });

      describe('data validation -', () => {

        it('should reject a non-string type', async () => {
          /// console.group('\n=== SPEC - connect validation - reject type type');
          let badArgs = {type: 47, info: {hostname, port, dbname, username, secret}};

          await DBService.connect(badArgs.type, badArgs.info).then(
            value => {
              fail('connect() should throw an error');
            },
            err => {
              expect(err).toBeInstanceOf(TypeError);
            }
          ).then(
            () => {
              /// console.groupEnd();
          });
        });

        it('should reject a non-string host', async () => {
          /// console.group('\n=== SPEC - connect validation - reject host type');
          let badArgs = {type, info: {hostname: false, port, dbname, username, secret}};

          await DBService.connect(badArgs.type, badArgs.info).then(
            value => {
              fail('connect() should throw an error');
            },
            err => {
              expect(err).toBeInstanceOf(TypeError);
            }
          ).then(
            () => {
              /// console.groupEnd();
          });
        });

        it('should reject a null port', async () => {
          /// console.group('\n=== SPEC - connect validation - reject port type null');
          let badArgs = {type, info: {hostname, port: null, dbname, username, secret}};

          await DBService.connect(badArgs.type, badArgs.info).then(
            value => {
              fail('connect() should throw an error');
            },
            err => {
              expect(err).toBeInstanceOf(TypeError);
            }
          ).then(
            () => {
              /// console.groupEnd();
          });
        });

        it('should reject a true port', async () => {
          /// console.group('\n=== SPEC - connect validation - reject port type true');
          let badArgs = {type, info: {hostname, port: true, dbname, username, secret}};

          await DBService.connect(badArgs.type, badArgs.info).then(
            value => {
              fail('connect() should throw an error');
            },
            err => {
              expect(err).toBeInstanceOf(TypeError);
            }
          ).then(
            () => {
              /// console.groupEnd();
          });
        });

        it('should reject an object port', async () => {
          /// console.group('\n=== SPEC - connect validation - reject port type');
          let badArgs = {type, info: {hostname, port: {several: 'potatoes'}, dbname, username, secret}};

          await DBService.connect(badArgs.type, badArgs.info).then(
            value => {
              fail('connect() should throw an error');
            },
            err => {
              expect(err).toBeInstanceOf(TypeError);
            }
          ).then(
            () => {
              /// console.groupEnd();
          });
        });

        it('should reject a non-string dbname', async () => {
          /// console.group('\n=== SPEC - connect validation - reject dbname type');
          let badArgs = {type, info: {hostname, port, dbname: 38.40, username, secret}};

          await DBService.connect(badArgs.type, badArgs.info).then(
            value => {
              fail('connect() should throw an error');
            },
            err => {
              expect(err).toBeInstanceOf(TypeError);
            }
          ).then(
            () => {
              /// console.groupEnd();
          });
        });

        it('should reject a non-string username', async () => {
          /// console.group('\n=== SPEC - connect validation - reject username type');
          let badArgs = {type, info: {hostname, port, dbname, username: {prop: 'name'}, secret}};

          await DBService.connect(badArgs.type, badArgs.info).then(
            value => {
              fail('connect() should throw an error');
            },
            err => {
              expect(err).toBeInstanceOf(TypeError);
            }
          ).then(
            () => {
              /// console.groupEnd();
          });
        });

        it('should reject a non-string secret', async () => {
          /// console.group('\n=== SPEC - connect validation - reject secret type');
          let badArgs = {type, info: {hostname: false, port, dbname, username, secret: -93.1}};

          await DBService.connect(badArgs.type, badArgs.info).then(
            value => {
              fail('connect() should throw an error');
            },
            err => {
              expect(err).toBeInstanceOf(TypeError);
            }
          ).then(
            () => {
              /// console.groupEnd();
          });
        });

      });

    });

  });

});
