<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;


class LoginControllerTest extends TestCase
{

  use RefreshDatabase;

  public function test_user_can_log_in()
  {
    $user = User::factory()->create();

    $this->postJson('/api/register', [
      'name' => 'User 1',
      'email' => 'user1@example.com',
      'password' => 'user_one_20204',
      'password_confirmation' => 'user_one_20204'
    ]);

    Passport::actingAs(
      $user
    );

    $response = $this->postJson('/api/login', [
      'email' => 'user1@example.com',
      'password' => 'user_one_20204',
    ]);

    $response->assertOk();
  }

  public function test_proper_input_data_is_needed_for_log_in()
  {
  }

  public function test_already_logged_in_user_can_not_login_again()
  {
  }

  public function test_logged_in_user_can_log_out()
  {
  }
}
