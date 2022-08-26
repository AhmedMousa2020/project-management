<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
  //  use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered()
    {
       
        $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->email_verified_at = null;
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();
        $response = $this->actingAs($user)->get('/verify-email');

        $response->assertStatus(200);
         $user = User::find($user->id);
 $user->delete();
    }

    public function test_email_can_be_verified()
    {
        Event::fake();

        $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->email_verified_at = null;
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();
        $response = $this->actingAs($user)->get('/verify-email');

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(RouteServiceProvider::HOME.'?verified=1');
         $user = User::find($user->id);
 $user->delete();
    }

    public function test_email_is_not_verified_with_invalid_hash()
    {
       
        $user = new User();
        $user->name = 'unittest';
        $user->email = 'test@example.com';
        $user->email_verified_at = null;
        $user->password  = '$2y$04$D9lvx7GS.pOLaE54DMj4ZOL4dLqKlR7NoHd/HeH9hFldaGyPaKXz2';
        $user->save();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($user)->get($verificationUrl);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
         $user = User::find($user->id);
 $user->delete();
    }
}
