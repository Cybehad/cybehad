<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    /**
     * Subscribe to newsletter
     */
    public function subscribe(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100|unique:newsletter_subscriptions,email'
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        // Create subscription
        $subscription = NewsletterSubscription::create([
            'email' => $request->email,
            'token' => Str::random(32),
            'is_active' => true
        ]);

        // Send confirmation email (optional)
        $this->sendConfirmationEmail($subscription);

        return redirect()
                ->back()
                ->with('success', 'Thanks for subscribing to our newsletter!');
    }

    /**
     * Unsubscribe from newsletter
     */
    public function unsubscribe($token)
    {
        $subscription = NewsletterSubscription::where('token', $token)->first();

        if ($subscription) {
            $subscription->update([
                'is_active' => false,
                'unsubscribed_at' => now()
            ]);

            return view('newsletter.unsubscribed');
        }

        abort(404);
    }

    /**
     * Send confirmation email (example implementation)
     */
    protected function sendConfirmationEmail($subscription)
    {
        $unsubscribeLink = route('newsletter.unsubscribe', $subscription->token);
        // This would use your mail service (Mailtrap, SendGrid, etc.)
        Mail::send('emails.newsletter-confirmation', [
            'subscription' => $subscription,
            'unsubscribeLink' => $unsubscribeLink
        ], function($message) use ($subscription) {
            $message->to($subscription->email);
            $message->subject('Thanks for subscribing!');
        });
    }

}
