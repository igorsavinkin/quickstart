@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                    <!-- Display Validation Errors @include('common.errors') -->
                    <h3>{{ $msg }} </h3>
					<div class="form-group" >
					@if( $q )
						<div class="col-sm-10 col-sm-offset-0"> The last question: <strong>{{ $q }}</strong> </div>
						
						<div class="col-sm-10 col-sm-offset-0"> 
						Its correct answer: <strong>{{ $answer }}</strong> </div>
					@endif	 
					</div>
					<br />
					<!-- Submit Button --> 
					<div class="col-sm-offset-3 col-sm-6">
						<button onclick="document.location='{{ url()->current() }}' " class="btn btn-default">
							<i class="fa fa-btn"></i>Start a new Trivia game
						</button>						
					</div>					 
                </div>
            </div>             
        </div>
    </div>
@endsection
