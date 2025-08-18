@component('mail::message')
# New KYC Submission Received

**User:** {{ $user->name }} ({{ $user->email }})  
**Submitted At:** {{ now()->format('Y-m-d H:i:s') }}

@component('mail::button', ['url' => route('admin.users.kyc').'?user_id='.$user->id])
Review Submission
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent