<?php

namespace Tests\Feature;


use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function A_author_could_be_created()
    {
        $this->withoutExceptionHandling();
        $this->post('/author',[
           'name'=>'ehsan',
           'email'=>'email@gmail.com',
           'dateOfBirth'=>'08/27/1993'
        ]);


        $author = Author::all();
        $this->assertCount(1,Author::all());
        //Check date of birth is instance od carbon
        $this->assertInstanceOf(Carbon::class,$author->first()->dateOfBirth);
        //check date format
        $this->assertEquals('1993/27/08',$author->first()->dateOfBirth->format('Y/d/m'));

    }

}
