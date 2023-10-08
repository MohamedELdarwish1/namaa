<?php

namespace App\Listeners;

use App\Events\ReviewArticles;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ReviewArticlesListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReviewArticles $event): void
    {
        $admins =  User::where('role_id', 2)->get();
        foreach ($admins as $admin) {

            $subject = 'Review New Article';
            $message = 'Please review the new article: ' . $event->data; 

            // Send the email
            Mail::raw($message, function ($message) use ($admin, $subject) {
                $message->to($admin->email)
                    ->subject($subject);
            });
        }
    }
}
