<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

  use RefreshDatabase;

  public function test_guest_can_not_create_other_users()
  {
    $response =  $this->postJson('/api/user', [
      'name' => 'User 1',
      'email' => 'user1@example.com',
      'password' => 'user_one_20204',
      'password_confirmation' => 'user_one_20204'
    ]);

    $this->assertCount(0, User::all());
  }

  public function test_user_can_create_other_users()
  {
    $user = User::factory()->create();

    Passport::actingAs(
      $user
    );

    $response =  $this->postJson('/api/user', [
      'name' => 'User 1',
      'email' => 'user1@example.com',
      'password' => 'user_one_20204',
      'password_confirmation' => 'user_one_20204'
    ]);

    $response->assertStatus(200);
    $this->assertCount(2, User::all());
  }

  public function test_an_existing_user_can_be_edited_by_user()
  {
    $user = User::factory()->create();

    Passport::actingAs(
      $user
    );

    $this->postJson('/api/user', [
      'name' => 'User 1',
      'email' => 'user1@example.com',
      'password' => 'user_one_20204',
      'password_confirmation' => 'user_one_20204'
    ]);

    $newUser = User::first();

    $response = $this->putJson("/api/user/$newUser", [
      'name' => 'User 1 new name',
    ]);

    $this->assertEquals('User 1 new name', User::first()->name);
    $response->assertOk();
    $response->assertSessionHasNoErrors();
  }

  public function test_guest_can_not_delete_user()
  {
    $response = $this->deleteJson('/api/user/1');

    $response->assertStatus(401);
  }


  public function test_regular_user_can_not_delete_user()
  {
    $user = User::factory()->normalUser()->create();

    Passport::actingAs(
      $user
    );

    $this->postJson('/api/user', [
      'name' => 'User 1',
      'email' => 'user1@example.com',
      'password' => 'user_one_20204',
      'password_confirmation' => 'user_one_20204'
    ]);

    $response = $this->deleteJson('/api/user/1');

    // $response->assertStatus(403);
    $this->assertCount(2, User::all());
  }

  public function test_only_admin_can_delete_a_user()
  {
    $user = User::factory()->admin()->create();

    Passport::actingAs(
      $user
    );

    $this->postJson('/api/user', [
      'name' => 'User 1',
      'email' => 'user1@example.com',
      'password' => 'user_one_20204',
      'password_confirmation' => 'user_one_20204'
    ]);

    $this->assertCount(2, User::all());

    $userLatest = User::first();

    $response = $this->deleteJson("/api/user/" . $userLatest);

    // $response->assertOk();
    $this->assertCount(1, User::all());
    $this->assertEquals('admin', $user->role);
  }
}
