# Trivia numbers game

The code is developed with Laravel 6.0 and uses MVC development structure.
 
The `TriviaControlle`r is a Single Action Controllers. 
The `Trivia` model is one that inherits from `Models` and does not use ant DB.
The processed questions are controlled by `$processed_numbres` variable array. That variable array is sent as json to the view and retrived in `TriviaController` from a form input to keep updated. It allows to track how many questions a user has answered.
Since the numbers in `$processed_numbres` are unique, therefore the game questions are not repeatable. 
