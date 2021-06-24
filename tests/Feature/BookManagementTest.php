<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return void
     */
    public function book_can_be_added()
    {
        // given
        $this->withoutExceptionHandling();
        $bookData = ['isbn' => 9780840700551, 'title' => 'Holy Bible'];
        // when
        $response = $this->post('/books', $bookData);
        // then
        $response->assertStatus(200);
        $this->assertCount(1, Book::all());


        // $response = $this->post('/books', [
        //     'isbn' => 9780840700551,
        //     'title' => 'Holy Bible'
        // ]);
        // $response->assertStatus(200);
    }
}
