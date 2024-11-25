<?php
namespace App\Libraries;
use Illuminate\Support\Facades\Mail;

class General
{
    
    public static function sendEmail($to, $subject, $content, $attachments = null)
    {
        // dd($content);
        try {
            $view = 'emails.mail';

            Mail::send($view, $content, function ($message) use ($to, $subject, $attachments) {
                $message->to($to)
                        ->subject($subject);

                if (!empty($attachments)) {
                    foreach ($attachments as $attachment) {
                        $message->attach($attachment);
                    }
                }
            });
            
            return 'Email sent successfully!';
        } catch (\Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
        }
    }
    
}