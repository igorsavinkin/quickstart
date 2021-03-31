@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Question number  {{ $task->counter }} 
                </div>

                <div class="panel-body">
                    <!-- Validation Errors -->
                    @include('common.errors')

                    <!-- Trivia Form -->
                    <form action="{{ url('trivia')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
						<input type="hidden" name="answer" value="{{ $task->answer }}">
						<input type="hidden" name="question" value="{{ $task->name }}">
						<input type="hidden" name="processed_numbers" value="{{ $task->processed_numbers }}">
                        <!-- Trivia question -->
                        <div class="form-group"> 
                            <div class="col-sm-10 col-sm-offset-2">Select <strong>{{ $task->name }}.</strong> </div>
							<div class="col-sm-10 col-sm-offset-3"> 
							    @foreach ($task->variants as $v)									
									<input type="radio"  name="variant" value="{{ $v }}">
									<label for="{{ $v }}">{{ $v }}</label><br> 
								@endforeach
                            </div>
							
                        </div>

                        <!-- Submit Btn -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn"></i>Answer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>             
        </div>
    </div>
@endsection
