@component('mail::message')

# Hello {{ $name }},

Thank you for your interest in RWEStore. An administrator account has been created for you. Please login at the URL "/admin/login".

Email: {{ $email }}

Password: {{ $password }}

@endcomponent