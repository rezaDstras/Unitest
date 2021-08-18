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
        $this->withoutExceptionHandling();
        $response =$this->post('/property',[
           'title'=>'Appartment',
           'price'=>25000,
        ]);
        $response->assertOk();
        $this->assertCount(1,Property::all());
    }
}

