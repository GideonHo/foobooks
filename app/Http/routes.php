<?php

#use \Rych\Random\Random;

Route::group(['middleware' => ['web']], function () {

	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('/practice/ex1','PracticeController@getEx1');
	Route::get('/practice/ex2','PracticeController@getEx2');
	Route::get('/practice/ex3','PracticeController@getEx3');
	Route::get('/practice/ex4','PracticeController@getEx4');
	Route::get('/practice/ex5','PracticeController@getEx5');
	Route::get('/practice/ex6','PracticeController@getEx6');
	Route::get('/practice/ex7','PracticeController@getEx7');
	Route::get('/practice/ex8','PracticeController@getEx8');

	Route::get('/practicedebug/ex1','PracticeDebugController@getEx1');
	Route::get('/practicedebug/ex2','PracticeDebugController@getEx2');
	Route::get('/practicedebug/ex3','PracticeDebugController@getEx3');

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

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});

if(App::environment('local')) {

    Route::get('/drop', function() {

        DB::statement('DROP database foobooks');
        DB::statement('CREATE database foobooks');

        return 'Dropped foobooks; created foobooks.';
    });

};

