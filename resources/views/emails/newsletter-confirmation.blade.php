<!-- resources/views/emails/newsletter-confirmation.blade.php -->
@component('mail::message')
# Thanks for subscribing!

You've been added to our newsletter list.

If you didn't request this, you can unsubscribe using the link below.

@component('mail::button', ['url' => $unsubscribeLink])
Unsubscribe
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
