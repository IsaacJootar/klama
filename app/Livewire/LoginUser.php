<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

#[Title('User Login')]
class LoginUser extends Component
{
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.login-user')->layout('layouts.auth-register');
    }

    public function loginUser()
    {
        $this->ensureIsNotRateLimited();

        $validated = $this->validate([
            'email' => 'required|string|max:200',
            'password' => 'required',
        ]);

        $identifier = trim($validated['email']);
        $credentials = ['password' => $validated['password']];
        $credentials[filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'name'] = $identifier;

        if (!Auth::attempt($credentials)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'message' => 'The Email, Password provided does not match our record ',
            ]);
        }

        Session::regenerate();
        RateLimiter::clear($this->throttleKey());

        $user = Auth::user();
        $user->load('userRoles');

        $role = optional($user->userRoles)->aka;
        $roleLabel = optional($user->userRoles)->role ?? 'User';

        $roleRoutes = [
            'FD' => 'reservations',
            'LM' => 'activity-log',
            'GM' => 'general-dashboard',
            'MM' => 'main-dashboard',
            'KR' => 'dashboard',
            'HK' => 'house-dashboard',
            'SM' => 'sales-dashboard',
            'DIR' => 'general-dashboard',
        ];

        $targetRoute = $roleRoutes[$role] ?? 'dashboard';

        toastr()->info('You are successfully logged in as ' . $roleLabel);

        return $this->redirectIntended(default: route($targetRoute, absolute: false), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}