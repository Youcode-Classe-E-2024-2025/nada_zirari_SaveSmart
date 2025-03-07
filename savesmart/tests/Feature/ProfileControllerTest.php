<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_access_profile_page()
    {
        // Create a user
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        // Create a profile for the user (to ensure there's something to display)
        Profile::factory()->create(['user_id' => $user->id]);

        // Visit the profile index page
        $response = $this->get(route('profiles.index'));

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the user's profile name is displayed on the page (adjust as needed)
        $response->assertSee($user->name); //checking if the user's name is displayed on the page

        // Assert that the profile information is displayed (example, adjust based on your actual view)
        $response->assertSee('Vos Profils'); // Example:  Assert that the page title is present
    }

}
