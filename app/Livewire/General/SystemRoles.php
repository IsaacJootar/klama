<?php

namespace App\Livewire\General;
use Livewire\Component;
use App\Models\SystemRole;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
#[Title('System Roles')]
class SystemRoles extends Component
{

    public $roles;
    #[Validate('required|unique:system_roles,role')]
    public $role;

    public $modal_title = 'Activate New Syetem Role.';
    public function save()
    {
       $this->validate();// validate and then save
        SystemRole::create([
            'role'=>$this->role,
        ]);

        toastr()->info('Syetem Role Has Been Activated Successfuly' );
        $this->reset();
    }


    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function render()
    {
        $this->roles = SystemRole::all();
        return view('livewire.general.system-roles')->layout('layouts.general');
    }
}
