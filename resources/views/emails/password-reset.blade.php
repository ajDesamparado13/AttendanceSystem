@component('mail::message')
# Hi, {{ $array['name'] }}!

To reset your password on this email ({{ $array['email'] }}), please click the following link.

<br />
<a href="{{ $array['activation_code']}}">
    Reset Password
</a>
<br />
<br />
{{ $array['activation_code']}}

Thanks,<br />
Monstarlab Cebu
@endcomponent