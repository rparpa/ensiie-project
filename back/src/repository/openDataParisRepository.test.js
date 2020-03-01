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

  it('should get all parking spots voitures', async () => {
    const res = await request(app)
        .get('/openDataParis/getAllParkingSpotsVoitures')
    expect(res.statusCode).toEqual(200)
    expect(res.body).toBeDefined()
    expect(res.body).toBeInstanceOf(Array);
    expect(res.body[0]).toHaveProperty("_parkingSpotId");
    expect(res.body[15]["_parkingSpotId"]).toHaveLength(40);
    expect(res.body[0]).toHaveProperty("_tarif");
    expect(res.body[0]).toHaveProperty("_latitude");
    expect(res.body[0]).toHaveProperty("_longitude");
  })

  it('should get all parking spots motos', async () => {
    const res = await request(app)
        .get('/openDataParis/getAllParkingSpotsMotos')
    expect(res.statusCode).toEqual(200)
    expect(res.body).toBeDefined()
    expect(res.body).toBeInstanceOf(Array);
    expect(res.body[0]).toHaveProperty("_parkingSpotId");
    expect(res.body[15]["_parkingSpotId"]).toHaveLength(40);
    expect(res.body[0]).toHaveProperty("_typeMob");
    expect(res.body[0]).toHaveProperty("_latitude");
    expect(res.body[0]).toHaveProperty("_longitude");
  })

  it('should get all parking spots velos', async () => {
    const res = await request(app)
        .get('/openDataParis/getAllParkingSpotsVelos')
    expect(res.statusCode).toEqual(200)
    expect(res.body).toBeDefined()
    expect(res.body).toBeInstanceOf(Array);
    expect(res.body[0]).toHaveProperty("_parkingSpotId");
    expect(res.body[15]["_parkingSpotId"]).toHaveLength(40);
    expect(res.body[0]).toHaveProperty("_typeMob");
    expect(res.body[0]).toHaveProperty("_latitude");
    expect(res.body[0]).toHaveProperty("_longitude");
  })

  it('should get all parking spots gratuit', async () => {
    const res = await request(app)
        .get('/openDataParis/getAllParkingSpotsGratuit')
    expect(res.statusCode).toEqual(200)
    expect(res.body).toBeDefined()
    expect(res.body).toBeInstanceOf(Array);
    expect(res.body[0]).toHaveProperty("_parkingSpotId");
    expect(res.body[15]["_parkingSpotId"]).toHaveLength(40);
    expect(res.body[0]).toHaveProperty("_vehiculeId");
    expect(res.body[0]).toHaveProperty("_latitude");
    expect(res.body[0]).toHaveProperty("_longitude");
  })

  it('should get all parking spots livraison', async () => {
    const res = await request(app)
        .get('/openDataParis/getAllParkingSpotsLivraison')
    expect(res.statusCode).toEqual(200)
    expect(res.body).toBeDefined()
    expect(res.body).toBeInstanceOf(Array);
    expect(res.body[0]).toHaveProperty("_parkingSpotId");
    expect(res.body[15]["_parkingSpotId"]).toHaveLength(40);
    expect(res.body[0]).toHaveProperty("_typeVoie");
    expect(res.body[0]).toHaveProperty("_latitude");
    expect(res.body[0]).toHaveProperty("_longitude");
  })

  it('should get all parking spots autocar', async () => {
    const res = await request(app)
        .get('/openDataParis/getAllParkingSpotsAutocar')
    expect(res.statusCode).toEqual(200)
    expect(res.body).toBeDefined()
    expect(res.body).toBeInstanceOf(Array);
    expect(res.body[0]).toHaveProperty("_parkingSpotId");
    expect(res.body[15]["_parkingSpotId"]).toHaveLength(40);
    expect(res.body[0]).toHaveProperty("_arrond");
    expect(res.body[0]).toHaveProperty("_latitude");
    expect(res.body[0]).toHaveProperty("_longitude");
  })

});