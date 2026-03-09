<?php
namespace App\Livewire\General;
use App\Models\User;
use Livewire\Component;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRoles;
use App\Models\SystemRole;
use App\Models\HotelSection;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

#[Title('Create User Account')]
class CreateuserAccount extends Component
{
 public $users;
 public $roles;
public $name;
public $email;
public $password;
public $user_id;
public $modal_title = 'Create New User';

public  $modal_flag = false; // event flag for edit
public $aka;
public $sections;
public $section;
public $role; // default role when coming from 'User Authorization
//other Roles GM MM(General Manager), MM(maintenace manager/supervisior), HD(Help Desk), FB(kitchen,Bar,resturant/supervisior), LG(logistics manager/supervisior)
//HK(Room & housekeeping manage/supervisior),  //SM(Sales manage/supervisior)

protected  $rules = [
    'name' => ['required', 'string', 'max:255', 'unique:'.User::class],
    'email' => ['required', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'min:8'],
    'role' => ['required'],
    'section' => ['required'],
];

    public function createUser(){
// get the last id on query
$validated = $this->validate();

$validated['password'] = Hash::make($validated['password']);

event(new Registered($user_id = User::create($validated)));

        $this->aka = Str::substr($this->role, 0, 2); // alaise for middleware check
        UserRoles::create([
            'user_id'=>$this->user_id = $user_id->id,
            'role'=>$this->role,
            'aka'=>$this->aka,
            'section'=>$this->section,
        ]);

        toastr()->info($this->role. ' Account  Has Been Created Successfuly');
        $this->reset();





    }

    public function exit()
    { //rest modal feilds
        $this->reset();
    }


    public function render()
    {
        $this->users = User::with('userRoles')->get();
        $this->roles = SystemRole::all();
        $this->sections = HotelSection::all();
        return view('livewire.general.createuser-account')->layout('layouts.general');
    }


}
