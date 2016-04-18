<?php

namespace Foobooks\Http\Controllers;

use Foobooks\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Foobooks\Book;
//use Eloquent;

class PracticeController extends Controller {

    public function getEx1(){
        $books = \DB::table('books')->get();

        // Output the results
        foreach ($books as $book) {
            echo $book->title;
        }
    }

    public function getEx2(){
        // Use the QueryBuilder to get all the books where author is like "%Scott%"
        $books = \DB::table('books')->where('author', 'LIKE', '%Scott%')->get();

        // Output the results
        foreach($books as $book) {
            echo $book->title.'<br>';
        }
    }

    public function getEx3(){
        // Use the QueryBuilder to insert a new row into the books table
        // i.e. create a new book
        \DB::table('books')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'published' => 1925,
            'cover' => 'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG',
            'purchase_link' => 'http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565',
        ]);
    }

    public function getEx4(){
        $books = \DB::select("SELECT * FROM books WHERE author LIKE '%Scott%'");

        // Output the results
        foreach($books as $book) {
            echo $book->title.'<br>';
        }
    }

    public function getEx5(){

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

    public function getEx6(){
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

    public function getEx7(){
        # First get a book to update
        $book = Book::where('author', 'LIKE', '%Scott%')->first();

        # If we found the book, update it
        if($book) {

            # Give it a different title
            $book->title = 'The Really Great Gatsby';

            # Save the changes
            $book->save();

            echo "Update complete; check the database to see if your update worked...";
        }
        else {
            echo "Book not found, can't update.";
        }
    }

    public function getEx8(){
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
