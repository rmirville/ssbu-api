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

  });

  describe('port', () => {

    it('should exist', () => {
      expect(dbConfig.hasOwnProperty('port')).toBe(true);
    });
  
    it('should be either null or of type number', () => {
      expect((dbConfig.port instanceof Number) || (dbConfig.port === null)).toBe(true);
    });

  });

  describe('database name', () => {

    it('should have a database name', () => {
      expect(dbConfig.hasOwnProperty('dbname')).toBe(true);
    });
  
    it('should have a database name of type string', () => {
      expect(dbConfig.dbname).toBeInstanceOf(String);
    });

    it('should not be empty', () => {
      expect(dbConfig.dbname.length).toBeGreaterThan(0);
    });

  });

  describe('username', () => {

    it('should have a username', () => {
      expect(dbConfig.hasOwnProperty('username')).toBe(true);
    });
  
    it('should have a username of type string', () => {
      expect(dbConfig.username).toBeInstanceOf(String);
    });

    it('should not be empty', () => {
      expect(dbConfig.username.length).toBeGreaterThan(0);
    });

  });

  describe('secret', () => {

    it('should have a secret', () => {
      expect(dbConfig.hasOwnProperty('secret')).toBe(true);
    });
  
    it('should have a secret of type string', () => {
      expect(dbConfig.secret).toBeInstanceOf(String);
    });

    it('should not be empty', () => {
      expect(dbConfig.secret.length).toBeGreaterThan(0);
    });

  });

});
