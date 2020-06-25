<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class CrimeCaseCreationTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function createCrimeCaseWhenOfficersAreAvailable()
    {
        $payload = [
            'full_name' => 'Taster McTastyBoy',
            'contact_info' => 'Right around the corner',
            'case_report' => 'Bike no more :('
        ];

        $request = $this->post('api/case/report', $payload);

        $request->assertStatus(200);
        $request->assertJsonStructure([
            'created_at', 'deleted_at', 'email', 'id', 'is_available', 'name', 'surname', 'updated_at'
        ]);
    }
}
