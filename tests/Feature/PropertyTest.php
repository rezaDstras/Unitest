<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_property_could_be_stored()
    {
       // $this->withoutExceptionHandling();
        $response =$this->post('/property',[
           'title'=>'Appartment',
           'price'=>25000,
        ]);
        $property=Property::first();
        $this->assertCount(1,Property::all());
        //path is defined function in property model
        $response->assertRedirect($property->path());
    }
    /**
     * @test
     */
    public function title_of__property_could_be_validated_as_a_required()
    {
//        $this->withoutExceptionHandling();
        $response =$this->post('/property',[
           'title'=>'',
           'price'=>25000,
        ]);

        $response->assertSessionHasErrors('title');
    }
    /**
     * @test
     */
    public function price_of__property_could_be_validated_as_a_required()
    {
//        $this->withoutExceptionHandling();
        $response =$this->post('/property',[
           'title'=>'title',
           'price'=>'',
        ]);

        $response->assertSessionHasErrors('price');
    }
    /**
     * @test
     */
    public function a_property_could_be_updated()
    {
       // $this->withoutExceptionHandling();
        //first store
        $this->post('/property',[
            'title'=>'Appartment',
            'price'=>25000,
        ]);
        //get created property
        $property=Property::first();

        //update store
        $response=$this->patch($property->fresh()->path(),[
            'title'=>'home',
            'price'=>300,
        ]);
        $this->assertEquals('home',Property::first()->title);
        $this->assertEquals('300',Property::first()->price);

        $response->assertRedirect($property->path());
    }
    /**
     * @test
     */
    public function a_property_could_be_deleted()
    {
        //$this->withoutExceptionHandling();

        $this->post('/property',[
            'title'=>'Appartment',
            'price'=>2500
        ]);
        $property =Property::first();
        $this->assertCount(1,Property::all());

        $response=$this->delete($property->path());

        $this->assertCount(0,Property::all());

        //Return to ...
        $response->assertRedirect('/properties');

    }

}

