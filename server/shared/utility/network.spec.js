const { normalizePort } = require('./network');

describe('normalizePort() -', () => {
  it('converts a numerical string into a number', () => {
    const inputVal = '3240';
    const expectedVal = 3240;
    const actualVal = normalizePort(inputVal);
    expect(actualVal).toEqual(expectedVal);
  });

  it('keeps a non-numerical string as a string', () => {
    const inputVal = 'forever';
    const expectedVal = 'forever';
    const actualVal = normalizePort(inputVal);
    expect(actualVal).toEqual(expectedVal);
  });

  it('converts an empty string to false', () => {
    const inputVal = '';
    const actualVal = normalizePort(inputVal);
    expect(actualVal).toBe(false);
  });

  it('converts a negative number to false', () => {
    const inputVal = '-349';
    const actualVal = normalizePort(inputVal);
    expect(actualVal).toBe(false);
  });

  it('converts an object to false', () => {
    const inputVal = {force: 'dark'};
    const actualVal = normalizePort(inputVal);
    expect(actualVal).toBe(false);
  });

  it('converts boolean value true to false', () => {
    const inputVal = true;
    const actualVal = normalizePort(inputVal);
    expect(actualVal).toBe(false);
  });

  it('converts null to false', () => {
    const inputVal = null;
    const actualVal = normalizePort(inputVal);
    expect(actualVal).toBe(false);
  });
});
