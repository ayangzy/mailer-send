<?php

namespace App\Services;

use Exception;
use App\Models\Email;
use App\Mail\SendEmail;
use App\Models\Attachment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmailRequest;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\NotFoundException;

class EmailService
{
    public function getEmails()
    {
        return Email::query()->paginate(10);
    }

    public function sendEmail(EmailRequest $request)
    {
        DB::beginTransaction();
        try {
            $email = $this->createEmail($request);

            $recipients = $email->recipients()->createMany($this->createRecipient($request->only('recipient'), $email));

            $this->createAttachment($request, $email);

            foreach ($recipients as $recipient) {
                Mail::to($recipient->to)->send(new SendEmail($email));
            }

            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            throw new Exception('An error occured sending email, please try again');
        }

        return $email;
    }

    public function showEmail($id)
    {
        $email = Email::find($id);

        if (!$email) {
            throw new NotFoundException('Email not found');
        }

        return $email;
    }


    public function getRecipients($id)
    {
        $email = Email::find($id);

        if (!$email) {
            throw new NotFoundException('Email not found');
        }

        $recipients = $email->recipients()->paginate(10);

        return $recipients;
    }

    

    private function createEmail($data): object
    {
        return Email::create([
            'from' => $data->from,
            'subject' => $data->subject,
            'text_content' => $data->text_content,
            'html_content' => json_encode($data->html_content),
            'status' => Email::POSTED,
        ]);
    }

    private function createRecipient(array $data, Email $email): array
    {
        $recipients = [];
        foreach (array_shift($data) as $key => $recipient) {
            $recipientEmail = [
                'email_id' => $email->id,
                'to' => $recipient['to'],
            ];
            array_push($recipients,  $recipientEmail);
        }
        return $recipients;
    }


    private function createAttachment($data, Email $email)
    {
        $fileName = [];

        if ($data->hasfile('file')) {
            foreach ($data->file('file') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files'), $name);
                $fileName[] = $name;
            }
        }
        $file = new Attachment();
        $file->attachment = json_encode($fileName);
        $file->email_id = $email->id;
        $file->save();
    }
}
