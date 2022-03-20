@component('mail::message')
<div style="padding: 3rem 2rem;">
<img src="http://coronatime.lukabrazi.redberryinternship.ge/img/email/Landing.png">
<h1 style="text-align: center; margin-top:3rem; font-weight:900; font-size: 25px; font-style:normal; color:black">
{{__('Confirmation email')}}
</h1>

<p style="text-align: center; font-size: 18px; font-style:normal; color:black;">{{ __('click this button to verify your email') }}</p>
<br>
<div style="text-align: center;">
<a href="{{'http://coronatime.lukabrazi.redberryinternship.ge/user/verify/' . $user->verifyUser->token}}" style="color:white; font-weight:900;
font-size:16px; background-color: #0fba68;
padding: 15px 80px; border:none;
border-radius:10px; margin: 0 auto; text-decoration:none; text-transform:uppercase;">{{ __('Verify email') }}</a>
</div>
</div>
@endcomponent
