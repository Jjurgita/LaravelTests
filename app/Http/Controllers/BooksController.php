<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store()
    {
        // $data = request()->validate(['isbn' => 'required', 'title' => 'required']);
        // Book::create(request()->all());
        // Book::create($data);

        // Book::create([
        //     'isbn' => request('isbn'),
        //     'title' => request('title')
        // ]);

        // Book::create($this->validateRequest());

        $data = request()->validate(['isbn' => 'required', 'title' => 'required']);
        $book = Book::create($data);
        return redirect('/books/' . $book->isbn);
    }

    public function update(Book $book)
    {
        // $data = request()->validate(['title' => 'required']);
        // $book->update($data);

        // $book->update($this->validateRequest());

        $data = request()->validate(['isbn' => 'required', 'title' => 'required']);
        $book->update($data);
        return redirect('/books/' . $book->isbn);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }

    // helpers
    private function validateRequest()
    {
        return request()->validate(['isbn' => 'required', 'title' => 'required']);
    }
}
