<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{

	public function testsRegistersSuccessfully()
	{
        $payload = ['email' => 'test@test.com', 'name' => 'Test', $payload];
		$this->json('POST', 'api/users')
	        ->assertStatus(201)
	        ->assertJsonStructure(['name', 'email', 'created_at']);
	}

}
