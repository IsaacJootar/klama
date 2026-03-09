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
use App\Models\UserRoles;
#[Title('User Login')]


class LoginUser extends Component
{

    public $email;
    public $password;
    public function render()
    {
        return view('livewire.login-user')->layout('layouts.auth-register');
    }


    public function loginUser(){

        $this->ensureIsNotRateLimited();
        $validated =  $this->validate([
            'email'=>'required|email|max:200',
            'password'=>'required'

        ]);



        if(Auth::attempt($validated)){
      Session::regenerate();


      $user = Auth::user();

      // Eager load the role relationship
      $user->load('userRoles');  // This will load the related UserRole
      $role = $user->userRoles->aka;
      // Define role-based redirect paths (index to your module route)
      $roleRoutes = [
          'FD' => 'reservations-dashboard', // for reservations
          'LM' => 'activity-log', // for logistics manager
          'GM' => 'general-dashboard', // for general manager
          'DIR' => 'director-dashboard', // for director
          'MM' => 'main-dashboard', // for maintenance manager
          'KR' => 'dashboard', 
          'HK' => 'house-dashboard', // for general manager
          'SM' => 'sales-dashboard', // for general manager
      ];





            if ($role && isset($roleRoutes[$role])) {
                toastr()->info('You are successfully logged in as ' .$user->userRoles->role);
                $this->redirectIntended(default: route($roleRoutes[$role], absolute: false), navigate: true);
            }
        }





        if (! Auth::attempt($this->only(['email', 'password']))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'message' => 'The Email, Password provided does not match our record ',
            ]);
        }
        RateLimiter::clear($this->throttleKey());


    }


    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
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

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }

}
