<?php

namespace App\Livewire\Logistics;
use Livewire\Component;
use App\Models\SystemMessage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Services\EmailMessageService;

#[Title('Logistics | Messaging History')]
class MessageHistory extends Component
{


    public  $messages; // message instance
    public $message;
    public $message_type;
    //public $sent_by = 12345; //userID= '12345'; // hardcode User ID for now til Auth Module is  ready

    //public $sent_to = 124578; // user

    public $message_id; // give me a random numberto identify each message

    public $section = 'Logistics'; //Hotel Section (department)


    public function render()
    {
        $this->messages = SystemMessage::all();
        return view('livewire.logistics.message-history')->layout('layouts.logistics');
    }
}
