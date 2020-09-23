require('dotenv').config();

const { DBService } = require('./db-service');

describe('DBService -', () => {
  const mongoose = require('mongoose');

  const type = 'mongodb';
  const host = process.env.SSBUTOOLS_DB_MONGO_R_HOST;
  let portTemp = process.env.SSBUTOOLS_DB_MONGO_R_PORT;
  const port = ((typeof portTemp !== 'undefined') && (portTemp.length > 0)) ? parseInt(portTemp) : null;
  const dbname = process.env.SSBUTOOLS_DB_MONGO_R_DB;
  const user = process.env.SSBUTOOLS_DB_MONGO_R_USER;
  const pass = process.env.SSBUTOOLS_DB_MONGO_R_SECRET;

  const mongoArgs = [type, host, port, dbname, user, pass];

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
            const output = DBService.connect(...mongoArgs);
            /// console.log('SPEC - connect finished');
            /// console.log(`instance of Promise: ${output instanceof Promise}`);
            expect(output).toBeInstanceOf(Promise);
            await output;
          });

          it('resolves to a Mongoose instance', async () => {
            /// console.group('\n=== SPEC - resolves to a Mongoose instance');
            const output = await DBService.connect(...mongoArgs);
            expect(output).toBeInstanceOf(mongoose.Mongoose);
          });
          
          it('creates a valid MongoDB connection', async () => {
            /// console.group('\n=== SPEC - connect output - creates a valid mongodb connection:');
            const output = await DBService.connect(...mongoArgs);
            expect(output.connection).toBeInstanceOf(mongoose.Connection, 'should have a connection property');
            await output.connection.startSession();
            expect(output.connection.readyState).withContext('should be connected').toBe(1);
          });
        
        });

      });

      describe('data validation -', () => {

        it('should reject a non-string type', async () => {
          /// console.group('\n=== SPEC - connect validation - reject type type');
          let badArgs = [47, host, port, dbname, user, pass];

          await DBService.connect(...badArgs).then(
            value => {
              fail('connect() should throw an exception');
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
          let badArgs = [type, false, port, dbname, user, pass];

          await DBService.connect(...badArgs).then(
            value => {
              fail('connect() should throw an exception');
            },
            err => {
              expect(err).toBeInstanceOf(TypeError);
            }
          ).then(
            () => {
              /// console.groupEnd();
          });
        });

        it('should reject a non-number/null port', async () => {
          /// console.group('\n=== SPEC - connect validation - reject port type');
          let badArgs = [type, host, '3000', dbname, user, pass];

          await DBService.connect(...badArgs).then(
            value => {
              fail('connect() should throw an exception');
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
          let badArgs = [type, host, port, 38.40, user, pass];

          await DBService.connect(...badArgs).then(
            value => {
              fail('connect() should throw an exception');
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
          let badArgs = [type, host, port, dbname, {prop: 'name'}, pass];

          await DBService.connect(...badArgs).then(
            value => {
              fail('connect() should throw an exception');
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
          let badArgs = [type, host, port, dbname, user, -93.1];

          await DBService.connect(...badArgs).then(
            value => {
              fail('connect() should throw an exception');
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
