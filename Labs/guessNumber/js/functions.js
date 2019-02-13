      // Your JavaScript goes here
      var randomNumber = Math.floor(Math.random() * 99) + 1;
      var guesses = document.querySelector('#guesses');
      var lastResult = document.querySelector('#lastResult');
      var lowOrHi = document.querySelector('#lowOrHi');

      var guessesWon = 0;
      var guessesLoss = 0;

      var guessSubmit = document.querySelector('.guessSubmit');
      var guessField = document.querySelector('.guessField');
      var displayScore = document.querySelector("#displayScore");
      
      var guessCount = 1;
      var resetButton = document.querySelector('#reset');
      resetButton.style.display = 'none';
      guessField.focus();
      
      function checkGuess() {
            var userGuess = Number(guessField.value);
            if(isNaN(userGuess) || userGuess > 99)
            {
              lastResult.innerHTML = "ERROR!";
              lastResult.style.backgroundColor = 'yellow';
              guessField.value = '';
              guessField.focus();
            }
            else
            {
                if (guessCount === 1) {
                  guesses.innerHTML = 'Previous guesses: ';
              }
              guesses.innerHTML += userGuess + ' ';
              
                if (userGuess === randomNumber) {
                    $("#lastResult").html("Congratulations! You got it right!");
                    $("#lastResult").css("background", 'green');
                    $("#lowOrHi").html("");
                  // lastResult.innerHTML = 'Congratulations! You got it right!';
                  // lastResult.style.backgroundColor = 'green';
                  // lowOrHi.innerHTML = '';
                  guessesWon++;
                  setGameOver();
                } else if (guessCount === 7) {
                  lastResult.innerHTML = 'Sorry, you lost!';
                  guessesLoss++;
                  setGameOver();
                } else {
                  lastResult.innerHTML = 'Wrong!';
                  $("#lastResult").css("backgroundColor","red" );
                    // lastResult.style.backgroundColor = 'red';
                  if(userGuess < randomNumber) {
                    $("#lowOrHi").html("Last guess was too low!");

                    // lowOrHi.innerHTML = 'Last guess was too low!';
                  } else if(userGuess > randomNumber) {
                    lowOrHi.innerHTML = 'Last guess was too high!';
                  }
                }
                displayScore.innerHTML ="won: " + guessesWon + "  loss: " + guessesLoss;
                guessCount++;
                guessField.value = '';
                guessField.focus();
            }
            
      }
      
      guessSubmit.addEventListener('click', checkGuess);
      
      function setGameOver() {
        guessField.disabled = true;
        guessSubmit.disabled = true;
        resetButton.style.display = 'inline';
        resetButton.addEventListener('click', resetGame);
      }
      
      function resetGame() {
        guessCount = 1;
      
        var resetParas = document.querySelectorAll('.resultParas p');
        for (var i = 0 ; i < resetParas.length ; i++) {
          resetParas[i].textContent = '';
        }
      
        resetButton.style.display = 'none';
      
        guessField.disabled = false;
        guessSubmit.disabled = false;
        guessField.value = '';
        guessField.focus();
      
        lastResult.style.backgroundColor = 'white';
      
        randomNumber = Math.floor(Math.random() * 99) + 1;
      }

