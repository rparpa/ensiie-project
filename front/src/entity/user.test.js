const User = require('./User');

describe('User toJson', function () {

    test('Test toJson', () => {
        let user = new User();
        user.id = "1";
        user.firstName = "Sam";
        user.lastName = "Becket";
        user.numVoie = 7;
        user.typeVoie = "rue";
        user.nomVoie = "Code Quantum",
            user.arrond = 5;
        expect(user.toJson()).toMatchObject({
            id: "1",
            firstName: "Sam",
            lastName: "Becket",
            numVoie: 7,
            typeVoie: "rue",
            nomVoie: "Code Quantum",
            arrond : 5
        })
    });

});