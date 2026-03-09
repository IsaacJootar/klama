<?php

namespace App\Services;

use Carbon\Carbon;
use App\Mail\systemEmails;
use Illuminate\Support\Str;
use App\Models\SystemMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EmailMessageService
{



    public function SendMessageAndCreateRecord($message,  $message_type,  $message_id, $sent_by, $sent_to,  $section)
    {

         // Validation rules for the message property
        $validator = Validator::make(
            ['message' => $message], // The input data to validate
            [
                'message' => [
                    'required',
                    'min:15',
                ]
            ]
        );

        // Check if validation fails and throw an exception
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        switch ($message_type) {

            case 'message':
                SystemMessage::create([
                    'message' => $message,
                    'message_type' => $message_type,
                    'message_id' => $message_id,
                    'sent_by' => $sent_by,
                    'sent_to' => $sent_to,
                    'section' => Str::upper($section),
                    'date' => Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d'), // create a class later to accomodate other timezones
                ]);

                break;
            case 'email':

        $user_id = DB::table('user_roles')
        ->where('role', 'General_Manager')
        ->value('user_id');
        
        
        
$to_mail =  $to_mail = DB::table('users')
        ->where('id',  $user_id)
        ->value('email');
                $mail_subject = 'User Mail';
                Mail::to($to_mail)->send(new systemEmails($message, $mail_subject));

                SystemMessage::create([
                    'message' => $message,
                    'message_type' => $message_type,
                    'message_id' => $message_id,
                    'sent_by' => $sent_by,
                    'sent_to' => $sent_to,
                    'section' => Str::upper($section),
                    'date' => Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d'), // create a class later to accomodate other timezones
                ]);


                break;

            default:
                SystemMessage::create([
                    'message' => $message,
                    'message_id' => $message_id,
                    'sent_by' => $sent_by,
                    'sent_to' => $sent_to,
                    'section' => Str::upper($section)
                ]);
        }
    }


    public function ComfirmReservationEmail($mail_message, $customer_email, $mail_subject) {
        Mail::to($customer_email)->send(new systemEmails($mail_message, $mail_subject));

        $to_mail = 'jootarisaac@gmail.com';//for now till auth is ready
        Mail::to($to_mail)->send(new systemEmails($mail_message, $mail_subject = "Reservation has been comfirmed"));

    }

}
