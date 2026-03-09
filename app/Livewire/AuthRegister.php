<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use App\Models\UserRoles;
use Livewire\Attributes\Title;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;


#[Title('User Authorization')]
class AuthRegister extends Component
{


public $name;
public $email;
public $password;
public $user_id;
public $aka = 'GM';
public $section = 'All'; //create  a model for this later
public $role = 'General_Manager'; // default role when coming from 'User Authorization
//other Roles GM MM(General Manager), MM(maintenace manager/supervisior), HD(Help Desk), FB(kitchen,Bar,resturant/supervisior), LG(logistics manager/supervisior)
//HK(Room & housekeeping manage/supervisior),  //SM(Sales manage/supervisior)
protected  $rules = [
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'min:8'],
];


    public function createUser(){


        $validated = $this->validate();

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user_id = User::create($validated)));

        UserRoles::create([
            'user_id'=>$this->user_id = $user_id->id,
            'role'=>$this->role,
            'aka'=>$this->aka,
            'section'=>$this->section,
        ]);

        toastr()->info('General Manager\'s Account  Has Been Created and Role Successfuly');
        $this->reset();
       // return $this->redirect('/auth-register');




    }

    public function render()
    {
        return view('livewire.auth-register')->layout('layouts.auth-register');
    }


}
