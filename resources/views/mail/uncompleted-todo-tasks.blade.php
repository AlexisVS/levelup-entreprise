@component('mail::message')
# Uncompleted Todo Taks today

@component('mail::table')
## User details
| | |
| ------------- |:-------------:|
| User id | {{ $user->id }} |
| Contact name | {{ $user->contacts->name }} |
@foreach($todos as $todo)
| Todo id / Todo Text | {{ $todo->id }} / {{ $todo->text }}
@endforeach

@endcomponent

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
