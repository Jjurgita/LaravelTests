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

    /** @test */
    public function title_is_required_to_create_book()
    {
        /* VALIDATION */

        // // with expect Exception
        // // given
        // $this->withoutExceptionHandling();
        // $bookData = ['isbn' => 9780840700551, 'title' => ''];
        // // // when
        // // $response = $this->post('/books', $bookData);
        // // when / then
        // $this->expectException(\Illuminate\Validation\ValidationException::class);
        // $this->expectExceptionMessage('The given data was invalid.');
        // $response = $this->post('/books', $bookData);
        // // // then
        // // $response->assertStatus(200);
        // // $this->assertCount(1, Book::all());

        // with assert
        // given
        $bookData = ['isbn' => 9780840700551, 'title' => ''];
        // when
        $response = $this->post('/books', $bookData);
        // then
        $response->assertStatus(302);
        $response->assertSessionHasErrors('title');
        $this->assertCount(0, Book::all());
    }

    /** @test */
    public function book_can_be_updated()
    {
        // given
        $this->withoutExceptionHandling();
        $bookData = ['isbn' => 9780840700551, 'title' => 'Holy Bible'];
        $this->post('/books', $bookData);
        // var_dump(Book::all());

        // when
        $updatedBookData = ['isbn' => 9780840700551, 'title' => 'Anything'];
        $response = $this->put('/books/' . $updatedBookData['isbn'], $updatedBookData);

        // then
        $response->assertStatus(200);
        $this->assertCount(1, Book::all());
        $this->assertEquals($updatedBookData['isbn'], Book::first()->isbn);
        $this->assertEquals($updatedBookData['title'], Book::first()->title);
    }
}
