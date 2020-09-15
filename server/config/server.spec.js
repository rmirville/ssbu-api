describe('Server Config', () => {
  const serverConfig = require('./server');

  describe('hostname', () => {

    it('should exist', () => {
      expect(serverConfig.hasOwnProperty('hostname')).toBe(true);
    });
  
    it('should be of type string', () => {
      expect(serverConfig.hostname).toBeInstanceOf(String);
    });

    it('should not be empty', () => {
      expect(serverConfig.hostname.length).toBeGreaterThan(0);
    });

    it('should not change', () => {
      let fakeHost = ['ibTS0f2GX5', '5JIWTyS8eO'];
      serverConfig.hostname = fakeHost[0];
      expect(serverConfig.hostname === fakeHost[0]).toBe(false);
      serverConfig.hostname = fakeHost[1];
      expect(serverConfig.hostname === fakeHost[1]).toBe(false);
    });

  });

  describe('port', () => {

    it('should exist', () => {
      expect(serverConfig.hasOwnProperty('port')).toBe(true);
    });
  
    it('should be either null or of type number', () => {
      expect((serverConfig.port instanceof Number) || (serverConfig.port === null)).toBe(true);
    });

    it('should not change', () => {
      let fakePort = ['ibTS0f2GX5', '5JIWTyS8eO'];
      serverConfig.port = fakePort[0];
      expect(serverConfig.port === fakePort[0]).toBe(false);
      serverConfig.port = fakePort[1];
      expect(serverConfig.port === fakePort[1]).toBe(false);
    });

  });

});
