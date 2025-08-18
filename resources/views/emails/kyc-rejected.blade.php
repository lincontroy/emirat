@component('mail::message')
# KYC Verification Rejected

Dear {{ $user->name }},

Your KYC submission has been reviewed but we couldn't approve it for the following reason:

**Reason:**  
{{ $rejectionReason }}

Please correct the issues and submit your KYC documents again.

@component('mail::button', ['url' => url('/kyc')])
Resubmit KYC
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent