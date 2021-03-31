<?php
 
Route::match(['get', 'post'], '/trivia',  TriviaController::class);