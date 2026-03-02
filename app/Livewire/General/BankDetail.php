<?php

namespace App\Livewire\General;

use App\Models\Bank;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;


#[Title('General Manager | Bank Details ')]

class BankDetail extends Component
{
    
    public  $banks; // bank  instance
    public  $bank;


    #[Validate('required|min:9')]
    public $account_number = '';

    #[Validate('required|min:2')]
    public $bank_name = '';


    public $modal_title = 'Add New Bank  Detail.';

    public  $modal_flag = false; // event flag for edit
    public $bank_id; //create | update (modal flag)
    
    
    public function save()
    {
        
        try {
       $this->validate();// validate and then save
    } catch (ValidationException $e) {
         $this->reset();
    }
        Bank::updateOrCreate(
        ['id' =>$this->bank_id],
            [
                'bank_name'=>$this->bank_name,
                'account_number'=>$this->account_number,
            ]

        );

        toastr()->info($this->bank_id ? 'Bank Detail Has Been Added Successfuly' : 'Bank Detail Has Been Updated Successfuly' );
        $this->dispatch('bank-saved');
        $this->reset();
    }
    
    public function edit($id)
    {
        $this->bank = Bank::findOrFail($id);
        $this->bank_id = $this->bank->id;
        $this->bank_name = $this->bank->bank_name;
        $this->account_number = $this->bank->account_number;
        $this->modal_flag = true;
        $this->modal_title = 'Update Bank Detail';
    }

    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();
        toastr()->info('Bank Detail is deleted successfully');
    }

    public function render()
    {
        $this->banks = Bank::all();
        return view('livewire.general.bank-detail')->layout('layouts.general');
    }
}
