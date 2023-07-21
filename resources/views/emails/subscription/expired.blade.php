@component('mail::message')
    # Subscription Expired

    Hi {{ $user->name }} of {{ $tenant->name }},

    We hope this email finds you well.
    We wanted to inform you that your subscription of {{ $plan->name }} plan has expired.We appreciate your support and hope you have enjoyed the benefits of our digital menu.

    Don't worry, you can easily renew your subscription by visiting the below link.
    @component('mail::button', ['url' => config('app.app.url').'/subscriptions'])
        Renew Subscription
    @endcomponent
    Thank you for being a valued member of our service.
    If you have any questions or need assistance,feel free to reach out to our support team at support@wasimbalabs.com.

    Best regards,
    {{ config('app.name') }} Team
@endcomponent
