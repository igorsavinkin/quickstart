<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Trivia extends Model
{ 
	static function get_from_web($processed_numbers = array()  ){

		$random_num = rand( 1, 100);
		while (in_array( $random_num, $processed_numbers ))
		{
			$random_num = rand( 1, 100);
		}
		array_push( $processed_numbers,  $random_num );
		
		$self = new Trivia;  
		$self->name = file_get_contents('http://numbersapi.com/' . strval($random_num) . '/trivia?fragment' );
		$self->answer = $random_num;	
		$self->counter = count($processed_numbers);
		
		$variants = [$self->answer, rand( 1, 100), rand( 1, 300) ];
        shuffle( $variants ); 		
		$self->variants = $variants ;
		$self->processed_numbers = json_encode($processed_numbers, JSON_FORCE_OBJECT); 
		return $self;		
	}
}