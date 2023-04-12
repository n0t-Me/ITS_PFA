<x-mail::message>
# Account Created

Your account was created here is your information:

- **Name**: {{$name}}
- **Password**: {{$password}}
- **Role**: {{$role}}
- **Team Name**: {{$team_name}}

Please change your password and set your account as soon as possible

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
