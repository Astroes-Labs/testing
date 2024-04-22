// script.js 

// Array of words to choose from 
const words = [ 
	"java", 
	"javascript", 
	"python", 
	"pascal", 
	"ruby", 
	"perl", 
	"swift", 
	"kotlin", 
]; 

function getRandomValue(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
// Geting random word from the list 
let randomIndex = Math.floor(Math.random() * words.length); 
let selectedWord = words[randomIndex]; 
console.log(selectedWord); 

// Split the word into an array of characters
let characters = selectedWord.split('');

console.log(characters[1]); // Output: ["H", "e", "l", "l", "o"]

let halfcharactersLength = Math.floor((characters.length)/2);
let randomIndex2 =  getRandomValue(Math.round(characters.length/2), characters.length);
if(randomIndex2 === characters.length){
	randomIndex2 =  getRandomValue(Math.round(characters.length/2), characters.length);
}
/* while((Math.round(Math.random() * characters.length)).length < halfcharactersLength ){

} */
let counter = randomIndex2;

console.log("counter init "+counter); 
while(counter != 0){
	let randomChar = Math.floor(Math.random() * characters.length); 
	if(characters[randomChar] === "_"){
		randomChar = Math.floor(Math.random() * characters.length); 
	}else{
		characters[randomChar] = "_";
		counter -=1;
	}
}
console.log(characters); 

console.log(charactersLength);
let missingChar = words[randomIndex]; 
// To store the already guessed letters 
let guessedlist = []; 

// For initial display Word with missing characters 
let displayWord = ""; 
for (let i = 0; i < selectedWord.length; i++) { 
	displayWord += "_ ";
} 
console.log(displayWord);  
document.getElementById("displayWord").textContent = displayWord; 

// Function to check Guessed letter 
function guessLetter() { 
	let inputElement = 
		document.getElementById("letter-input"); 

	// To check empty input 
	if (!inputElement.value) { 
		alert("Empty Input box. Please add input letter"); 
		return; 
	} 

	let letter = inputElement.value.toLowerCase(); 

	// Clear the input field 
	inputElement.value = ""; 

	// Check if the letter has already been guessed 
	if (guessedlist.includes(letter)) { 
		alert("You have already guessed that letter!"); 
		return; 
	} 

	// Add the letter to the guessed letters array 
	guessedlist.push(letter); 

	// Update the word display based on the guessed letters 
	let updatedDisplay = ""; 
	let allLettersGuessed = true; 
	for (let i = 0; i < selectedWord.length; i++) { 
		if (guessedlist.includes(selectedWord[i])) { 
			updatedDisplay += selectedWord[i] + " "; 
		} else { 
			updatedDisplay += "_ "; 
			allLettersGuessed = false; 
		} 
	} 
	document.getElementById("displayWord") 
		.textContent = updatedDisplay; 

	// Check if all letters have been guessed 
	if (allLettersGuessed) { 
		alert("Congratulations! You guessed the word correctly!"); 
	} 
}
