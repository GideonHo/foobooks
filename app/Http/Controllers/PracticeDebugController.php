<?php

namespace Foobooks\Http\Controllers;

//use Foobooks\Http\Controllers\Controller;
//use Illuminate\Http\Request;
//use Foobooks\App\Book;
//use Eloquent;

class PracticeDebugController extends Controller {

    public function getEx1(){

        # Instantiate a new Book Model object
        $book = new Book();
        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $book->title = 'Harry Potter';
        $book->author = 'J.K. Rowling';
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';
        # Invoke the Eloquent save() method
        # This will generate a new row in the `books` table, with the above data
        $book->save();
        return 'Added: '.$book->title;
    }

    public function getEx2(){
        $books = Book::all();

        # Make sure we have results before trying to print them...
        if(!$books->isEmpty()) {

            // Output the books
            foreach($books as $book) {
                echo $book->title.'<br>';
            }
        }
        else {
            echo 'No books found';
        }
    }

    public function getEx3(){
        # First get a book to delete
        $book = Book::where('title', 'LIKE', '%Harry%');

        # If we found the book, delete it
        if($book) {

            # Goodbye!
            $book->delete();

            return "Deletion complete; check the database to see if it worked...";

        }
        else {
            return "Can't delete - Book not found.";
        }   
    }

}
