<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
  //  use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
         $user = User::find($user->id);
 $user->delete();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
         $user = User::find($user->id);
 $user->delete();
    }
}
