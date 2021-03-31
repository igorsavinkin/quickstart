<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Trivia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TriviaController extends Controller
{
    public function __invoke(Request $request)
    {
        $processed_numbers = $request->input('processed_numbers') ? json_decode($request->input('processed_numbers'), true) : [];
		switch ($request->method()) {
			case 'POST':
				$validator = Validator::make($request->all(), [ 
					'variant' => 'required',
				]);			 
							
				if ($validator->fails()) { 	
					array_pop ( $processed_numbers );	
					return view('trivia', [
					   'task' =>  Trivia::get_from_web($processed_numbers, true)  
					])->withErrors( $validator );
				}	
				if ($request->input('variant') != $request->input('answer')){
					$counter = count($processed_numbers) - 1;
					return view('trivia_over', [
					   'msg' =>  "The gave is over. You've answered correctly only ". $counter ." Trivia question(s).",
					   'q' => $request->input('question'),
					   'answer' => $request->input('answer')
					]);	
				}
				
				if (count($processed_numbers) >= 20 ){
					return view('trivia_over', [
					   'msg' =>  "The gave is over. You've answered 20 Trivia questions.",
					   'q' => null
					]);	
				}						
		}
			
		return view('trivia', [
		   'task' =>  Trivia::get_from_web($processed_numbers ) 
		]);	
    }
}