const Offre = require('./geo');
describe("Test of GetAddress", () => {

    test('Test of Computing Distance',() => {
        let Geo = new geo();
        
        function getAddr(){
            Geo.Compute(52.5487429714954,-1.81602098644987);
        }
        expect(getAddr).toHaveReturnedWith("137, Pilkington Avenue, Sutton Coldfield, Birmingham, West Midlands Combined Authority, West Midlands, Angleterre, B72 1LH, Royaume-Uni");
        
    });
    test('Missing Lat',()=> {

        let Geo = new geo();

        function GetAddr(){
            Geo.getAdrrByCoords(52.5487429714954);

        }
        expect(getAddr).toThrow(new Error('Parameter missing'));
    })

    test('Missing Lon',()=> {

        let Geo = new geo();

        function GetAddr(){
            Geo.getAdrrByCoords(null,52.5487429714954);

        }
        expect(getAddr).toThrow(new Error('Parameter missing'));
    })
    
    test('Lon NaN',()=> {

        let Geo = new geo();

        function GetAddr(){
            Geo.getAdrrByCoords("abc",52.5487429714954);

        }
        expect(getAddr).toThrow(new Error('Parameters must be numbers'));
    })
    test('Lat NaN',()=> {

        let Geo = new geo();

        function GetAddr(){
            Geo.getAdrrByCoords(46.213,"abc");
        }
        expect(getAddr).toThrow(new Error('Parameters must be numbers'));
    })


});
// describe('Test of GetAddress', function () {

//     test('Test Getting an actual address', () => {
//         let Geo = new geo();
        
//         function Compute(){
//             Geo.Compute(48.859315,48.859675,2.293957,2.292365);
//         }
//         expect(Compute).toHaveReturnedWith(0.12315179265289337);
        
//     });
//     test('Missing Lat1',()=> {

//         let Geo = new geo();
//         function Compute(){
//             Geo.Compute(null,48.859675,2.293957,2.292365);
//         }
//         expect(Compute).toThrow(new Error('Parameter missing'));
//     })

//     test('Missing Lon1',()=> {

//         let Geo = new geo();

//         function Compute(){
//             Geo.Compute(48.859315,null,2.293957,2.292365);

//         }
//         expect(Compute).toThrow(new Error('Parameter missing'));
//     })
    
//     test('Missing lat2',()=> {

//         let Geo = new geo();

//         function Compute(){
//             Geo.Compute(48.859315,48.859675,null,2.292365);

//         }
//         expect(Compute).toThrow(new Error('Parameter missing'));
//     })
//     test('Missing lon2',()=> {

//         let Geo = new geo();

//         function Compute(){
//             Geo.Compute(48.33,48.859675,2.293957,null);
//         }
//         expect(Compute).toThrow(new Error('Parameter missing'));
//     })
//     test('Missing lon2',()=> {

//         let Geo = new geo();

//         function Compute(){
//             Geo.Compute("abc",45.23,2.293957,25.3);
//         }
//         expect(Compute).toThrow(new Error('Parameter must be number'));
//     })
//     test('Missing lon2',()=> {

//         let Geo = new geo();

//         function Compute(){
//             Geo.Compute(48.859315,48.859675,"abc",25.3);
//         }
//         expect(Compute).toThrow(new Error('Parameter must be number'));
//     })
//     test('Missing lon2',()=> {

//         let Geo = new geo();

//         function Compute(){
//             Geo.Compute(48.859315,48.859675,2.293957,"abc");
//         }
//         expect(Compute).toThrow(new Error('Parameter must be number'));
//     })
//     test('Missing lon2',()=> {

//         let Geo = new geo();

//         function Compute(){
//             Geo.Compute(48.859315,"abc",2.293957,25.3);
//         }
//         expect(Compute).toThrow(new Error('Parameter missing'));
//     })


// });