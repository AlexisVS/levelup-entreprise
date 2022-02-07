@component('mail::message')
# New todo created

@component('mail::table')
## User details
| | |
| ------------- |:-------------:|
| User id | {{ $user->id }} |
| Contact name | {{ $user->contacts->name }} |
| Todo Text | {{ $user->todolists->todos->last()->text}}

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
