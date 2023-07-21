@component('mail::message')
    # Email Verified Successfully

    Hi {{ $user->name }},

    Congratulations! Your email address ({{ $user->email }}) has been successfully verified.
    Thank you for confirming your email.

    You can now fully access all the features of our platform and stay up-to-date with the latest information and updates.

    Get started by registering your service(Restaurant, Bar, Hotel e.t.c) from the link below.

    @component('mail::button', ['url' => config('app.url').'/register_restaurant'])
        Verify Email
    @endcomponent

    If you have any questions or need any assistance, please feel free to reach out to our support team at support@wasimbalabs.com.

    Thank you for being a part of {{ config('app.name') }} community!

    Best regards,
    The {{ config('app.name') }} Team
@endcomponent
