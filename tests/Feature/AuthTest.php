<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_register_successfully()
    {
        $response = $this->post('/register', [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
        ]);

        $response->assertRedirect('/login'); //check if it redirects

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
        //check if user is created
    }

    #[Test]
    public function user_cannot_register_with_existing_email()
    {
        User::factory()->create([
            'email' => 'john@example.com',
        ]);

        $response = $this->post('/register', [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertCount(1, User::where('email', 'john@example.com')->get());
    }
    #[Test]
    public function user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'role' =>'user'
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('user.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function admin_is_redirected_to_admin_dashboard_after_login()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => bcrypt('password'),
            'is_two_factor_enabled' => false,
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }




    #[Test]
    public function user_cannot_login_with_invalid_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    #[Test]
    public function user_with_otp_enabled_must_verify_otp()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'is_two_factor_enabled' => true,
            'otp_code' => '123456',
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Assuming your login redirects to OTP verification page
        $response->assertRedirect(route('otp.verify.form'));
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function user_cannot_verify_expired_otp()
    {
        $user = User::factory()->create([
            'is_two_factor_enabled' => true,
            'otp_code' => '123456',
            'otp_expires_at' => Carbon::now()->subMinutes(5),
        ]);

        Auth::login($user);

        $response = $this->post('/verify-otp', [
            'otp' => '123456',
        ]);

        $response->assertSessionHasErrors(['otp']);
        $this->assertTrue(Auth::check());
    }

//    #[Test]
//    public function user_can_verify_valid_otp()
//    {
//        $user = User::factory()->create([
//            'password' => bcrypt('password'),
//            'is_two_factor_enabled' => true,
//            'otp_code' => '123456',
//            'otp_expires_at' => Carbon::now()->addMinutes(5),
//        ]);
//
//        // Log the user in and start a session
//        $response = $this->actingAs($user)
//            ->withSession(['is_two_factor_enabled' => false]) // start session manually
//            ->post(route('otp.verify'), [
//                'otp' => '123456',
//            ]);
//
//        // Assert redirect to user dashboard
//        $response->assertRedirect(route('user.dashboard'));
//
//        // Assert OTP cleared in DB
//        $this->assertDatabaseHas('users', [
//            'id' => $user->id,
//            'otp_code' => null,
//        ]);
//
//        // Assert session has 2fa_verified true
//        $this->assertTrue(session('2fa_verified'));
//    }


}
