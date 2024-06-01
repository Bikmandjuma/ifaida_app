@component('mail::message')
<h1>Ifaida app</h1>
<h2>Assalam aalaikum warahmatullahi wabarakat</h2>
<p>This is application of learning about islam only</p>

@component('mail::panel')
I'm {{ $admin_name }} admin of Ifaida app , u can use this link <a href="{{URL::to('/')}}/sheikh/verify-email-before-registration/{{ $email }}">click me</a> to register yourself !
@endcomponent

<p>Allah be with u , </p>
@endcomponent