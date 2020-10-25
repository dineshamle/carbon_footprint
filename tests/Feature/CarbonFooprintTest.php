<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Models\CarbonFootprint;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CarbonFooprintTest extends TestCase
{
    // use RefreshDatabase;
    use DatabaseMigrations;
    /** @test */
    public function there_is_no_default_route()
    {
        $response = $this->get('/');
        $response->assertStatus(404);
    }

    //activity field is required 
    /** @test */
    public function field_activity_is_required()
    {
        $getData = array_merge($this->data(), ['activity' => '']);
        $response = $this->getJson(route('show.carbonfootprint', $getData));
        $response
        ->assertStatus(400)
        ->assertJson([
            'error' => true,
            'message' => ['activity' => ['The activity field is required.']]
        ]);
    }

    //activity field value is greater than 0
    /** @test */
    public function activity_value_should_be_non_zero()
    {
        $getData = array_merge($this->data(), ['activity' => 0]);
        $response = $this->getJson(route('show.carbonfootprint', $getData));
        $response
        ->assertStatus(400)
        ->assertJson([
            'error' => true,
            'message' => ['activity' => ['The selected activity is invalid.']]
        ]);
    }


    //activity_type field is required
    /** @test */
    public function field_activity_type_is_required()
    {
        $getData = array_merge($this->data(), ['activity_type' => '']);
        $response = $this->getJson(route('show.carbonfootprint', $getData));
        $response
        ->assertStatus(400)
        ->assertJson([
            'error' => true,
            'message' => ['activity_type' => ['The activity type field is required.']]
        ]);
    }

    //country field is required
    /** @test */
    public function field_country_is_required()
    {
        $getData = array_merge($this->data(), ['country' => '']);
        $response = $this->getJson(route('show.carbonfootprint', $getData));
        $response
        ->assertStatus(400)
        ->assertJson([
            'error' => true,
            'message' => ['country' => ['The country field is required.']]
        ]);
    }

    //mode field is required
    /** @test */
    public function field_mode_is_required()
    {
        $getData = array_merge($this->data(), ['mode' => '']);
        $response = $this->getJson(route('show.carbonfootprint', $getData));
        $response
        ->assertStatus(400)
        ->assertJson([
            'error' => true,
            'message' => ['mode' => ['The mode field is required.']]
        ]);
    }

    //Get api response, validate, cache, store and return
    /** @test */
    public function get_api_response_validate_it_cache_it_store_it()
    {
        $response = $this->getJson(route('show.carbonfootprint', $this->data()));

        $response
        ->assertStatus(200)
        ->assertJson([
            'error' => false,
        ]);
        $this->assertCount(1, CarbonFootprint::all());

    }

    private function data()
    {
        return [
            'activity' => 10,
            'activity_type' => 'miles',
            'country' => 'usa',
            'mode' => 'bus',
        ];
    }
}
