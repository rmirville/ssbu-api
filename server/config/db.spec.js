const { MongoClient } = require("mongodb");

describe('Database Config', () => {
  const dbConfig = require('./db');

  it('should be able to connect', async () => {

    const hostname = dbConfig.hostname;
    const port = dbConfig.port;
    const dbname = dbConfig.dbname;
    const username = dbConfig.username;
    const secret = dbConfig.secret;

    const urlPrefix = `mongodb+srv://${username}:${secret}@${hostname}`;
    const urlPort = (port === null) ? `:${port}` : '';
    const urlSuffix = `/${dbname}?retryWrites=true&w=majority&useUnifiedTopology=true`;
    const url = urlPrefix + urlPort + urlSuffix;

    const client = new MongoClient(url);
    let connectionSuccess = false;
    try {
      await client.connect();
      connectionSuccess = true;
    }
    catch (err) {
      fail('should connect to database');
    }
    finally {
      await client.close();
    }
    expect(connectionSuccess).toBe(true);

  });

  describe('hostname', () => {

    it('should exist', () => {
      expect(dbConfig.hasOwnProperty('hostname')).toBe(true);
    });
  
    it('should be of type string', () => {
      expect(dbConfig.hostname).toBeInstanceOf(String);
    });

    it('should not be empty', () => {
      expect(dbConfig.hostname.length).toBeGreaterThan(0);
    });

    it('should not change', () => {
      let fakeHost = ['ibTS0f2GX5', '5JIWTyS8eO'];
      dbConfig.hostname = fakeHost[0];
      expect(dbConfig.hostname === fakeHost[0]).toBe(false);
      dbConfig.hostname = fakeHost[1];
      expect(dbConfig.hostname === fakeHost[1]).toBe(false);
    });

  });

  describe('port', () => {

    it('should exist', () => {
      expect(dbConfig.hasOwnProperty('port')).toBe(true);
    });
  
    it('should be either type number, string, or false', () => {
      expect((typeof dbConfig.port === 'number') || (typeof serverConfig.port === 'string') || (serverConfig.port === false)).toBe(true);
    });

    it('should not change', () => {
      let fakePort = ['ibTS0f2GX5', '5JIWTyS8eO'];
      dbConfig.port = fakePort[0];
      expect(dbConfig.port === fakePort[0]).toBe(false);
      dbConfig.port = fakePort[1];
      expect(dbConfig.port === fakePort[1]).toBe(false);
    });

  });

  describe('database name', () => {

    it('should exist', () => {
      expect(dbConfig.hasOwnProperty('dbname')).toBe(true);
    });
  
    it('should be of type string', () => {
      expect(dbConfig.dbname).toBeInstanceOf(String);
    });

    it('should not be empty', () => {
      expect(dbConfig.dbname.length).toBeGreaterThan(0);
    });

    it('should not change', () => {
      let fakeDB = ['ibTS0f2GX5', '5JIWTyS8eO'];
      dbConfig.dbname = fakeDB[0];
      expect(dbConfig.dbname === fakeDB[0]).toBe(false);
      dbConfig.dbname = fakeDB[1];
      expect(dbConfig.dbname === fakeDB[1]).toBe(false);
    });

  });

  describe('username', () => {

    it('should exist', () => {
      expect(dbConfig.hasOwnProperty('username')).toBe(true);
    });
  
    it('should be of type string', () => {
      expect(dbConfig.username).toBeInstanceOf(String);
    });

    it('should not be empty', () => {
      expect(dbConfig.username.length).toBeGreaterThan(0);
    });

    it('should not change', () => {
      let fakeUser = ['ibTS0f2GX5', '5JIWTyS8eO'];
      dbConfig.username = fakeUser[0];
      expect(dbConfig.username === fakeUser[0]).toBe(false);
      dbConfig.username = fakeUser[1];
      expect(dbConfig.username === fakeUser[1]).toBe(false);
    });

  });

  describe('secret', () => {

    it('should exist', () => {
      expect(dbConfig.hasOwnProperty('secret')).toBe(true);
    });
  
    it('should be of type string', () => {
      expect(dbConfig.secret).toBeInstanceOf(String);
    });

    it('should not be empty', () => {
      expect(dbConfig.secret.length).toBeGreaterThan(0);
    });

    it('should not change', () => {
      let fakeSecret = ['ibTS0f2GX5', '5JIWTyS8eO'];
      dbConfig.secret = fakeSecret[0];
      expect(dbConfig.secret === fakeSecret[0]).toBe(false);
      dbConfig.secret = fakeSecret[1];
      expect(dbConfig.secret === fakeSecret[1]).toBe(false);
    });

  });

  describe('type', () => {

    it('should have a database type', () => {
      expect(dbConfig.hasOwnProperty('type')).toBe(true);
    });
  
    it('should be of type string', () => {
      expect(dbConfig.type).toBeInstanceOf(String);
    });

    it('should not be empty', () => {
      expect(dbConfig.type.length).toBeGreaterThan(0);
    });

    it('should not change', () => {
      let fakeType = ['ibTS0f2GX5', '5JIWTyS8eO'];
      dbConfig.type = fakeType[0];
      expect(dbConfig.type === fakeType[0]).toBe(false);
      dbConfig.type = fakeType[1];
      expect(dbConfig.type === fakeType[1]).toBe(false);
    });

  });

});
