@component('mail::message')
    # Welcome to {{ config('app.name') }}!

    Hi {{ $user->name }},

    Welcome to our platform! We're thrilled to have you as a new member. Before you can fully access our services, we kindly request you to verify your email address.

    You will be required to provide the One Time Password(OTP) which is {{ $user->otp }}

    Verifying your email ensures that you have a valid and active account with us, and it also allows us to keep you informed about important updates and notifications.

    If you didn't sign up for an account on our platform, please ignore this email.

    Thank you for joining {{ config('app.name') }}! If you encounter any issues or have any questions, please don't hesitate to reach out to our support team at support@example.com.

    Best regards,
    The {{ config('app.name') }} Team
@endcomponent
