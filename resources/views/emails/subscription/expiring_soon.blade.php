@component('mail::message')
    # Subscription Expiring Soon

    Hi {{ $user->name }} of {{$tenant->name}},

    We hope you're enjoying our service!
    We wanted to remind you that your subscription of {{ $plan->name }} plan is expiring in the next 7 days.
    Don't miss out on the benefits and features that come with your subscription.

    To continue enjoying uninterrupted access,
    we encourage you to renew your subscription before it expires.
    You can always find a new bill to pay by visiting the below link.

    @component('mail::button', ['url' => config('app.app.url').'/subscriptions'])
        Renew Subscription
    @endcomponent

{{--    @if ($user->hasPaymentMethod())--}}
{{--        You don't need to worry about any interruptions, as we will automatically attempt to renew your subscription using your existing payment method.--}}
{{--    @else--}}
{{--        Please ensure that your payment information is up-to-date to avoid any interruptions in your service. You can easily update your payment information by clicking the button below.--}}

{{--        @component('mail::button', ['url' => route('subscription.payment.update')])--}}
{{--            Update Payment Information--}}
{{--        @endcomponent--}}

{{--    @endif--}}

    Thank you for being a loyal customer.
    If you have any questions or need assistance,
    feel free to reach out to our support team at support@wasimbalabs.com.

    Best regards,
    The {{ config('app.name') }} Team
@endcomponent
