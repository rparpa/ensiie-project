const geograph = require('./geo');
describe("Test of GetAddress", () => {

    test('Test of getting Address', async () => {
        
           data = await geograph.getCoordsByAddr("137, Pilkington Avenue, Sutton Coldfield, Birmingham, West Midlands Combined Authority, West Midlands, Angleterre, B72 1LH, Royaume-Uni");
           
        expect(data).toBe({lat:52.5487429714954,lon:-1.81602098644987});
        
    });
    test('Missing addr',async ()=> {

        try {
            data = await geograph.getCoordsByAddr();
        }
        catch(e){
            expect(e).toEqual('Parameter missing');
        }
       
    })}),

   describe('test of Compute Distance',  () => {

    test('Test Getting a distance', () => {
       
        function Compute(){
            geograph.ComputeDistance(48.859315,48.859675,2.293957,2.292365);
        }
        expect(Compute).toHaveReturnedWith(0.12315179265289337);
        
    });
    test('Missing Lat1',()=> {

        function Compute(){
            geograph.ComputeDistance(null,48.859675,2.293957,2.292365);
        }
        expect(Compute).toThrow(new Error('Parameter missing'));
    })

    test('Missing Lon1',()=> {

        function Compute(){
            geograph.ComputeDistance(48.859315,null,2.293957,2.292365);

        }
        expect(Compute).toThrow(new Error('Parameter missing'));
    })
    
    test('Missing lat2',()=> {

        function Compute(){
            geograph.ComputeDistance(48.859315,48.859675,null,2.292365);

        }
        expect(Compute).toThrow(new Error('Parameter missing'));
    })
    test('Missing lon2',()=> {


        function Compute(){
            geograph.ComputeDistance(48.33,48.859675,2.293957,null);
        }
        expect(Compute).toThrow(new Error('Parameter missing'));
    })
    test('Missing lon2',()=> {

        function Compute(){
            geograph.ComputeDistance("abc",45.23,2.293957,25.3);
        }
        expect(Compute).toThrow(new Error('Parameter must be number'));
    })
    test('Missing lon2',()=> {

        function Compute(){
            geograph.ComputeDistance(48.859315,48.859675,"abc",25.3);
        }
        expect(Compute).toThrow(new Error('Parameter must be number'));
    })
    test('Missing lon2',()=> {

        function Compute(){
            geograph.ComputeDistance(48.859315,48.859675,2.293957,"abc");
        }
        expect(Compute).toThrow(new Error('Parameter must be number'));
    })
    test('Missing lon2',()=> {


        function Compute(){
            geograph.ComputeDistance(48.859315,"abc",2.293957,25.3);
        }
        expect(Compute).toThrow(new Error('Parameter must be a number'));
    })


})