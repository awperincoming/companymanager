@component('mail::message')
Hey {{ $subordinateName }}

Your manager has new subordinate : {{ $name }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
