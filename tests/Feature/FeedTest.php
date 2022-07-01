<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FeedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getfeed()
    {

        $user = User::create([
            'first_name' => 'Alex',
            'last_name' => 'Ross',
            'email' => 'alex@gmail.com',
            'password' => Hash::make(123456),
        ]);
        Sanctum::actingAs($user);
        $response = $this->getJson(route('feed'));

        $response->assertStatus(200);
    }
}
