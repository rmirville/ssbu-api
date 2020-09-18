require('dotenv').config();

const { DBService } = require('./db-service');

describe('DBService', () => {
  const mongoose = require('mongoose');

  const type = 'mongodb';
  const host = process.env.SSBUTOOLS_DB_MONGO_R_HOST;
  let portTemp = process.env.SSBUTOOLS_DB_MONGO_R_PORT;
  const port = ((typeof portTemp !== 'undefined') && (portTemp.length > 0)) ? portTemp : null;
  const dbname = process.env.SSBUTOOLS_DB_MONGO_R_DB;
  const user = process.env.SSBUTOOLS_DB_MONGO_R_USER;
  const pass = process.env.SSBUTOOLS_DB_MONGO_R_SECRET;

  const mongoArgs = [type, host, port, dbname, user, pass];

  const dbs = new DBService();

  describe('connect()', () => {

    describe('type mongodb', () => {

      describe('output', () => {
        
        it('is an instance of Promise', () => {
          const output = dbs.connect(...mongoArgs);
          expect(output).toBeInstanceOf(Promise);
        });

        it('resolves to a Mongoose instance', async () => {
          /// console.group('\n=== SPEC - resolves to a Mongoose instance');
          await dbs.connect(...mongoArgs).then(
            (value) => {

              /// console.log('SPEC - promise fulfilled');

              expect(value).toBeInstanceOf(mongoose.Mongoose, 'should be a Mongoose instance');

            },
            (err) => {

              fail('method should connect successfully');

            }
          );
          /// console.groupEnd();
        });
        
        it('creates a valid MongoDB connection', async () => {
          /// console.group('\n=== SPEC - creates a valid mongodb connection:');
          await dbs.connect(...mongoArgs).then(
            async function(value) {

              /// console.log('SPEC - promise fulfilled');

              expect(value.connection).toBeInstanceOf(mongoose.Connection, 'should have a connection property');

              await value.connection.startSession();

              /// console.log(`SPEC - readyState: ${JSON.stringify(value.connection.readyState)}`);

              expect(value.connection.readyState).withContext('should be connected').toBe(1);

            },
            (err) => {

              /// console.log(JSON.stringify(err));
              fail('method should connect successfully');

            }
          );
          /// console.groupEnd();
        });
      
      });

    });

    describe('data validation', () => {

    });

  });

});
