<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    //use RefreshDatabase;

    public function test_reset_password_link_screen_can_be_rendered()
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested()
    {
        Notification::fake();

       $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->email_verified_at = null;
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
         $user = User::find($user->id);
         $user->delete();
    }

    public function test_reset_password_screen_can_be_rendered()
    {
        Notification::fake();

       $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->email_verified_at = null;
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this->get('/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
            $user = User::find($user->id);
            $user->delete();
    }

    public function test_password_can_be_reset_with_valid_token()
    {
        Notification::fake();

       $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->email_verified_at = null;
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });

              $user = User::find($user->id);
              $user->delete();
    }
}
