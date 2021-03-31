@extends('layouts.app')

@section('content')
    <div class="container"> 
			<!-- Current Books -->
            @if (count($books) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Books
                    </div>

                    <div class="panel-body">
						@include('common.errors')
                        <table class="table table-striped book-table">
                            <thead>
								<th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
								<th>Genre</th>
                                <th>Price</th>
								<th>Description</th>
								<th>Published</th>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
										<td class="table-text"><div id='id-{{ $book->id }}'>{{ $book->id }}</div></td>
                                        <td class="table-text"><div id='title-{{ $book->id }}'>{{ $book->title }}</div></td>
										<td class="table-text"><div id='author-{{ $book->id }}'>{{ $book->author }}</div></td>
										<td class="table-text"><div id='genre-{{ $book->id }}'>{{ $book->genre }}</div></td>
										<td class="table-text"><div id='price-{{ $book->id }}'>{{ $book->price }}</div></td>
										<td class="table-text"><div id='description-{{ $book->id }}'>{{ $book->description }}</div></td>
										<td class="table-text"><div id='publish_date-{{ $book->id }}'>{{ $book->publish_date }}</div></td>
                                        <td>
                                            <button onclick="$(this).closest('tr').hide();
											                 $(this).closest('tr').next('tr').show();"
												class="btn btn-success"> Edit 
											</button> 
                                        </td>
                                    </tr>
									<tr style="display:none;" >
										<form action="{{ url('edit/'.$book->id) }}" method="POST" id="{{ $book->id }}-book">
											<td class="table-text"><div>{{ $book->id }}</div></td>
											<td class="table-text"><input type="text" name="title" id="book-title" class="form-control" value="{{ $book->title }}"></td>
											<td class="table-text"><input type="text" name="author" id="book-author" class="form-control" value="{{ $book->author }}"></td>
											<td class="table-text"><input type="text" name="genre" id="book-genre" class="form-control" value="{{ $book->genre }}"></td>
											<td class="table-text"><input type="text" name="price" id="book-price" class="form-control" value="{{ $book->price }}"></td>
											<td class="table-text"><input type="text" name="description" id="book-description" class="form-control" value="{{ $book->description }}"></td>
											<td class="table-text"><input type="text" name="publish_date" id="book-publish_date" class="form-control" value="{{ $book->publish_date }}"></td>
	 
											<!-- Book save Button -->
											<td>												
												{{ csrf_field() }}	
												<button type="submit" class="btn btn-primary">Save</button>
												<span onclick="$tr=$(this).closest('tr');
												     var data = $('form#{{ $book->id }}-book').serializeArray();
												     console.log(data);
													 $.ajax({
														  type: 'post',
														  url: '{{ url('edit/'.$book->id) }}',
														  data: data
														}).success(function(response) {														    
														    if(response=='success'){ 																
																// we set the new values from data array into the table fields
																data.forEach(function (arrayItem) {
																	//var x = arrayItem.name + ': ' + arrayItem.value; 																
																	var selector= '#'+arrayItem.name+'-'+{{ $book->id }};
																	//console.log('selector:', selector);
																	$(selector).html(arrayItem.value);
																});
																$tr.hide(); $tr.prev().show();
																setTimeout(function(){ 
																	alert('Success saving edited data on server!');
																}, 600);
																
														   } else { alert('Submition is successful.\nFailure to save data at server!\nCheck the form fields and try it over!');}
														}).fail(function() {
														  alert('Failure to submit data to a server!\nCheck the form fields and try it over.');
														});" 
													class="btn btn-primary">Save (ajax)
												</span>
											</td>
                                        </form>                                    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
			<button  class="btn btn-success" onclick="$('#new-book').show();$(this).hide();">
                <i class="fa fa-btn fa-plus"></i>Add a new book
            </button> &nbsp;
			<button  class="btn btn-success" onclick="$('#new-book-ajax').show();$(this).hide();">
                <i class="fa fa-btn fa-plus"></i>Add a new book (Ajax)
            </button> 
			<br />
            <div class="panel panel-default" id="new-book" style="display:none;">
                <div class="panel-heading">
                    New Book 					
                </div>
                <div class="panel-body" >
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Book Form -->
                    <form action="{{ url('book')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }} 
                            <div class="col-sm-3">
								<label for="book-title" class=" control-label">Title</label>
                                <input type="text" name="title" id="book-title" class="form-control" value="{{ old('book') }}">
                            </div> 

                            <div class="col-sm-3">
								<label for="book-author" class="control-label">Author</label>
                                <input type="text" name="author" id="book-author" class="form-control" value="{{ old('book') }}">
                            </div>                             

                            <div class="col-sm-3">
								<label for="book-genre" class="control-label">Genre</label>
                                <input type="text" name="genre" id="book-genre" class="form-control" value="{{ old('book') }}">
                            </div>                             

                            <div class="col-sm-3">
							    <label for="book-price" class="control-label">Price</label>
                                <input type="text" name="price" id="book-price" class="form-control" value="{{ old('book') }}">
                            </div> 
                            

                            <div class="col-sm-6">
							    <label for="book-description" class=" control-label">Description</label>
                                <input type="text" name="description" id="book-description" class="form-control" value="{{ old('book') }}">
                            </div> 
							
							<div class="col-sm-3">
							    <label for="book-publish_date" class=" control-label">Published</label>
                                <input type="text" name="publish_date" id="book-publish_date" class="form-control" value="{{ old('book') }}">
                            </div> 

                        <!-- Add Book Button --> 
                            <div class="col-sm-3"><center>
							    <label for="book-description" class=" control-label"> </label>
								<br />
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-btn fa-plus"></i>Add
                                </button>
								</center>
                            </div> 
                    </form>
                </div>
            </div>
			<div class="panel panel-default" id="new-book-ajax" style="display:none;">
                <div class="panel-heading">
                    New Book (Ajax)					
                </div>
                <div class="panel-body" >
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Book Form -->
                    <form action="{{ url('book')}}" method="POST" class="form-horizontal" id="ajax-form">
                        {{ csrf_field() }} 
                            <div class="col-sm-3">
								<label for="book-title" class=" control-label">Title</label>
                                <input type="text" name="title" id="book-title" class="form-control" value="{{ old('book') }}">
                            </div> 

                            <div class="col-sm-3">
								<label for="book-author" class="control-label">Author</label>
                                <input type="text" name="author" id="book-author" class="form-control" value="{{ old('book') }}">
                            </div>                             

                            <div class="col-sm-3">
								<label for="book-genre" class="control-label">Genre</label>
                                <input type="text" name="genre" id="book-genre" class="form-control" value="{{ old('book') }}">
                            </div>                             

                            <div class="col-sm-3">
							    <label for="book-price" class="control-label">Price</label>
                                <input type="text" name="price" id="book-price" class="form-control" value="{{ old('book') }}">
                            </div> 
                            

                            <div class="col-sm-6">
							    <label for="book-description" class=" control-label">Description</label>
                                <input type="text" name="description" id="book-description" class="form-control" value="{{ old('book') }}">
                            </div> 
							
							<div class="col-sm-3">
							    <label for="book-publish_date" class=" control-label">Published</label>
                                <input type="text" name="publish_date" id="book-publish_date" class="form-control" value="{{ old('book') }}">
                            </div> 

                        <!-- Add Book Ajax Button --> 
                            <div class="col-sm-3"><center> 
								<br />
                                <div onclick="$('#ajax-form').ajaxSubmit({url: '{{ url('book')}}', type: 'post', 
								      success: function(response){ if(response=='success'){ $('#refresh-btn').show(); } else {alert('Check the form fields!');}
									           } })" class="btn btn-danger">
                                    <i class="fa fa-btn fa-plus"></i>Add (ajax)
                                </div>
								</center>
                            </div> 
							<div class="col-sm-12" style="display:none" id="refresh-btn"><center> 
								<br /> 
                                <div onclick="location.reload();" class="btn btn-block btn-danger">
                                    The new book has been created. Press to refresh the table.
                                </div>
								</center>
                            </div>
                    </form>
                </div>
            </div>

            
    </div>
@endsection
