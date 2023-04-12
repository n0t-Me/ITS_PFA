<x-mail::message>
# Your password has been reset

Here is the new password: **{{$rand_pass}}**

Please change your password as soon as possible

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
