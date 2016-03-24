<?php

#use \Rych\Random\Random;

Route::group(['middleware' => ['web']], function () {

	Route::get('/', function () {
	    return view('welcome');
	});
	
	Route::get('/books', 'BookController@getIndex');
	Route::get('/books/create', 'BookController@getCreate');
	Route::post('/books/create', 'BookController@postCreate');
	Route::get('/books/show/{id?}', 'BookController@getShow');

	Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

	Route::get('/practice', function(){
		/*
		echo config('mail.driver');
		echo config('app.url');
		echo \App::environment();

	    $data = Array('foo' => 'bar');
	    Debugbar::info($data);
	    Debugbar::error('Error!');
	    Debugbar::warning('Watch out…');
	    Debugbar::addMessage('Another message', 'mylabel');
		*/

		$random = new Random();
		return $random->getRandomString(8);

    	return 'Practice';
	});

	if(App::environment('local')){
		Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
	}
});
