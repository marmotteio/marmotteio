<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ApiCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
            'Accept' => 'application/json',
        ]);
    }
}
