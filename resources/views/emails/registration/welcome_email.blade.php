@component('mail::message')
    # Welcome to {{ config('app.name') }}!

    Hi {{ $user->name }},

    Welcome to our platform! We're thrilled to have you as a new member. Before you can fully access our services, we kindly request you to verify your email address.

    @component('mail::button', ['url' => route('verification.verify', ['id' => $user->id, 'hash' => $user->email_verification_token])])
        Verify Email
    @endcomponent

    Alternatively, you can also copy and paste the following link into your browser's address bar:

    {{ route('verification.verify', ['id' => $user->id, 'hash' => $user->email_verification_token]) }}

    Verifying your email ensures that you have a valid and active account with us, and it also allows us to keep you informed about important updates and notifications.

    If you didn't sign up for an account on our platform, please ignore this email.

    Thank you for joining {{ config('app.name') }}! If you encounter any issues or have any questions, please don't hesitate to reach out to our support team at support@example.com.

    Best regards,
    The {{ config('app.name') }} Team
@endcomponent
