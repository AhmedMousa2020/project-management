<?php

namespace Tests\Feature;

use App\Models\User;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
  //  use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered()
    {
        $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->email_verified_at = null;
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();

        $response = $this->actingAs($user)->get('/confirm-password');

        $response->assertStatus(200);
         $user = User::find($user->id);
 $user->delete();
    }

    public function test_password_can_be_confirmed()
    {
        $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->email_verified_at = null;
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
         $user = User::find($user->id);
 $user->delete();
    }

    public function test_password_is_not_confirmed_with_invalid_password()
    {
        $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->email_verified_at = null;
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
         $user = User::find($user->id);
 $user->delete();
    }
}
