const app = require('../../bin/www');
const request = require('supertest');


describe('Get ParkingSpots', () => {
  it('should get all parking spots', async () => {
    const res = await request(app)
      .get('/openDataParis/getAllParkingSpots')
    expect(res.statusCode).toEqual(200)
    expect(res.body).toBeDefined()
    expect(res.body).toBeInstanceOf(Array);
    expect(res.body[0]).toHaveProperty("_parkingSpotId");
    expect(res.body[0]["_parkingSpotId"]).toHaveLength(40);
    expect(res.body[0]).toHaveProperty("_numVoie");
    expect(res.body[0]).toHaveProperty("_tarif");
    expect(res.body[0]).toHaveProperty("_latitude");
    expect(res.body[0]).toHaveProperty("_longitude");
  })
});