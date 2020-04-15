@component('mail::message')
# Hi, Welcome {{ $array['name'] }}!

To verify your email address ({{ $array['email'] }}), please click the following link.

<br />
<a href="{{ $array['activation_code']}}">
    Verify Email
</a>
<br />
<br />
{{ $array['activation_code']}}

Thanks,<br>
MonstarLab Cebu
@endcomponent