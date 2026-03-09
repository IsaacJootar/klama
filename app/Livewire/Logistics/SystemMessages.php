<?php

namespace App\Livewire\Logistics;
use Livewire\Component;
use App\Models\SystemMessage;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Services\EmailMessageService;
use Illuminate\Support\Facades\DB;


#[Title('Logistics | Messaging')]
class SystemMessages extends Component
{


    public  $messages; // message instance
    public $message;
    public $message_type;
    public $sent_by = ''; //Auth User_id(the logged in user)

    public $sent_to = ''; // general manager by default should receive the messages

    public $message_id; // give me a random numberto identify each message

    public $section = 'Logistics'; //Hotel Section,like depart


    protected $rules = [
        'message' => 'required|min:10',
    ];






   public function sendMessage()
{
    $this->send_by = Auth::user()->id; // Auth User ID
    $this->message_id = mt_rand(100000, 999999); // give me a random number

    // Get the user ID of the General Manager
    $this->sent_to = DB::table('user_roles')
        ->where('role', 'General_Manager')
        ->value('user_id');

    $system_message = app(EmailMessageService::class); // inject the dependency class
    $system_message->SendMessageAndCreateRecord(
        $this->message,
        $this->message_type = 'message',
        $this->message_id,
        $this->send_by,
        $this->sent_to,
        $this->section
    );

    toastr()->info('Message Has Been Sent Successfully');
    $this->reset();
}

   public function sendEmail()
{
    $this->sent_by = Auth::user()->id; // Auth User ID
    $this->message_id = mt_rand(100000, 999999); // generate a random message ID

    // Get the user ID of the General Manager
    $this->sent_to = DB::table('user_roles')
        ->where('role', 'General_Manager')
        ->value('user_id');

    $system_message = app(EmailMessageService::class); // inject the dependency class
    $system_message->SendMessageAndCreateRecord(
        $this->message,
        $this->message_type = 'email',
        $this->message_id,
        $this->sent_by,
        $this->sent_to,
        $this->section
    );

    toastr()->info('Email Has Been Sent Successfully');
    $this->reset();
}


    public function render()
    {
        $this->messages = SystemMessage::all();
        return view('livewire.logistics.system-messages')->layout('layouts.logistics');
    }
}
