<?php

Route::group(['middleware' => ['web']], function () {

	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('/book', function () {
	    return 'Show a list of all the books';
	});

	Route::get('/book/create', function () {
		$view = '<form method="POST" action="/book/create">';
		$view .= csrf_field();
		$view = $view.'Book Title: <input type="text" name="title">';
		$view .= '<input type="submit">';
		$view .= '</form>';

		return $view;
	});

	Route::post('/book/create', function() {
		return 'Add the book: '.$_POST['title'];
	});

	Route::match(array('GET', 'POST'), '/test', function(){
	    return 'Hello World';
	});

	Route::get('/book/{title}', function ($title) {
	    return 'Show me an individual book: '.$title;
	});

});
