@component('mail::message')
# KYC Verification Approved

Dear {{ $user->name }},

Your KYC documents have been successfully verified. You now have full access to all platform features.

@component('mail::button', ['url' => url('/dashboard')])
Go to Dashboard
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent