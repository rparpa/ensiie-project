// jest.mock('pg');

// import fetch, {Response} from 'node-fetch';

const ClientSession = require('./ClientSession');
const {Client} = require('pg');

const mockkk = jest.fn().mockReturnValueOnce("lol");

jest.mock('pg');
// jest.mock('pg',() => {
//     return jest.fn().mockImplementation(() => {
//       return {connect: mockkk};
//     });
//   });



describe("ClientSession tests", () => {
    test('test getSession', () => {
        ClientSession.getSession();
        expect(Client).toHaveBeenCalledTimes(1);
    });
});