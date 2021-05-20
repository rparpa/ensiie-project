//Functions used in password strength calculations

//Regex
const LOWER_REGEX = '[a-z]';
const UPPER_REGEX = '[A-Z]';
const NUMBER_REGEX = '[0-9]';
const SYMBOL_REGEX = '[\\]\\[()?<>$^.*"\'&\-_/]';

//Returns password strength
function getPasswordStrength(password) {
    //Start strength
    let strength = 0;
    //Password length
    let length = password.length;
    //Amount of lower cases
    let lowers = regexCount(password, new RegExp(LOWER_REGEX + '+'));
    //Amount of upper cases
    let uppers = regexCount(password, new RegExp(UPPER_REGEX + '+'));
    //Amount of number
    let numbers = regexCount(password, new RegExp(NUMBER_REGEX + '+'));
    //Amount of symbol
    let symbols = regexCount(password, new RegExp(SYMBOL_REGEX + '+'));

    //All tests are copied from http://www.passwordmeter.com/
    //Also see assets/js/passwordStrengthFunctions.js

    //Bonus
    //Length
    strength += length * 3;
    //Amount of lower cases
    strength += (length - uppers) * 2;
    //Amount of upper cases
    strength += (length - lowers) * 2;
    //Amount of number
    strength += numbers * 4;
    //Amount of symbol
    strength += symbols * 5;

    //Penalty
    //Only lower case or only upper case or only numbers or only symbol
    if(new RegExp('^' + LOWER_REGEX + '+$').test(password)
        || new RegExp('^' + UPPER_REGEX + '+$').test(password)
        || new RegExp('^' + NUMBER_REGEX + '+$').test(password)
        || new RegExp('^' + SYMBOL_REGEX + '+$').test(password))
        strength -= length;
    //Amount letter or number sequences
    strength -= sequenceCount(password) * 3;
    //Amount of consecutive regex
    strength -= consecutiveCount(password) * 2;
    //Amount of repetitions
    strength -= repeatCount(password);

    return strength;
}

//Count the amount of a regex in a string
function regexCount(string,regex) {
    let count = 0;
    //Each character
    for(let i of string){
        if(regex.test(i))
            //Increase count by one
            count++;
    }
    return count;
}

//Count amount of a character repetition
function repeatCount(string) {
    let count = 0;
    let done = [];
    //Each character
    for(let i = 0; i < string.length; i++){
        //Save character
        let currentI = string.charAt(i);

        //If character repetition not already counted
        if(done.indexOf(currentI) < 0) {
            //Says it is done
            done.push(currentI);

            //Each character
            for (let j = 0; j < string.length; j++) {
                if (i !== j && currentI === string.charAt(j))
                    //If the same, increase count by one
                    count++;
            }
        }
    }

    return count;
}

//Count amount of consecutive sequence of characters or numbers
function consecutiveCount(string) {
    let count = 0;
    let sequence = 0;
    let regex = null;

    //Each character
    for(let i = 0; i < string.length; i++){
        //Save character
        let char = string.charAt(i);

        if(regex && regex.test(char)) {
            //If ongoing sequence
            sequence++;
        } else {
            //If sequence ended
            regex = null;
            //Increase count by sequence size
            count += sequence;
            sequence = 0;
        }

        //If not ongoing sequence
        if(!regex){
            //Start a new sequence
            if(new RegExp(LOWER_REGEX).test(char))
                regex = new RegExp(LOWER_REGEX);
            if(new RegExp(UPPER_REGEX).test(char))
                regex = new RegExp(UPPER_REGEX);
            if(new RegExp(NUMBER_REGEX).test(char))
                regex = new RegExp(NUMBER_REGEX);
        }
    }

    //Increase count by last sequence size
    count += sequence;

    return count;
}

//Count the amount of sequence of neighbour characters or numbers (ex: 12345, abcde, 98765, zyxwv)
function sequenceCount(string) {
    let count = 0;
    let sequence = 0;
    let increase = -1;

    //Each character
    for(let i = 1; i < string.length; i++){
        //Current character code
        let charCode = string.charCodeAt(i);
        //Previous character in string
        let prevChar = string.charAt(i - 1);

        //Previous character in alphabet
        let alphabeticPrevChar = String.fromCharCode(charCode - 1);
        //Next character in alphabet
        let alphabeticNextChar = String.fromCharCode(charCode + 1);

        if(increase === 0) {
            //If sequence of decreasing characters
            if(prevChar === alphabeticNextChar)
                //Increase sequence count if the previous character in the string is the same as the next alphabetic character
                sequence++;
            else
                //Stop sequence
                increase = -1;
        }else if(increase === 1) {
            //If sequence of increasing characters
            if (prevChar === alphabeticPrevChar)
                //Increase sequence count if the previous character in the string is the same as the previous alphabetic character
                sequence++;
            else
                //Stop sequence
                increase = -1;
        }else{
            //If none ongoing sequence
            if(prevChar === alphabeticNextChar) {
                //Start decreasing sequence if the previous character in the string is the same as the next alphabetic character
                increase = 0;
                sequence += 2;
            } else if (prevChar === alphabeticPrevChar) {
                //Start increasing sequence if the previous character in the string is the same as the previous alphabetic character
                increase = 1;
                sequence += 2;
            }
        }

        if(sequence >= 3 && increase === -1) {
            //Increase count by sequence size if none ongoing sequence and at least 3 characters are following
            count += sequence;
            sequence = 0;
        }
    }

    if(sequence >= 3) {
        //Increase count by last sequence size if at least 3 characters are following
        count += sequence;
    }

    return count;
}