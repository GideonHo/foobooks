<?php

namespace Foobooks\Http\Controllers;

use Foobooks\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {
	    #return 'Show a list of all the books';
    	return view('books.index');
    }

    /**
     * Responds to requests to GET /books/show/{id}
     */
    public function getShow($id = null) {
	    #return 'Show me an individual book: '.$id;
    	return view('books.show')->with('id', $id);
    }

    /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {

        return view('books.create');	

    	/**
		*$view = '<form method="POST" action="/book/create">';
		*$view .= csrf_field();
		*$view = $view.'Book Title: <input type="text" name="title">';
		*$view .= '<input type="submit">';
		*$view .= '</form>';
		*return $view;
		**/
    }

    /**
     * Responds to requests to POST /books/create
     */
    public function postCreate(Request $request) {
		
		#dd($request);
		#dd($request->all());
    	#$request->only(['title','author']);
    	#if($request->input('title')==''){}

    	$this->validate($request,[
    		'title'=>'required|min:3',
    		'author'=>'required|min:3'
    	]);

		return 'Add the book: '.$request->input('title');
		#return redirect('/books');
    }
}
