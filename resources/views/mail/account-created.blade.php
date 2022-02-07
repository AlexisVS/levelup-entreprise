@component('mail::message')
# Account Created
@component('mail::table')
## User details
| | |
| ------------- |:-------------:|
| User id | {{ $user->id }} |
| Email | {{ $user->email }} |

@endcomponent
@component('mail::table')
## User TVA
|  |  |
| ------------- |:-------------:|
| Name | {{ $user->tvas->name }} |
| Activity | {{ $user->tvas->activity }} |
| Address | {{ $user->tvas->address }} |
| City | {{ $user->tvas->city }} |
| Country | {{ $user->tvas->country }} |
| Phone | {{ $user->tvas->phone }} |
| Zip code | {{ $user->tvas->zip_code }} |
@endcomponent
@component('mail::table')
## User contact
|  |  |
| ------------- |:-------------:| --------:|
| Email | {{ $user->email }} |
| Name | {{ $user->tvas->name }} |
| Phone | {{ $user->tvas->phone }} |
@endcomponent

Thanks ,<br>
{{ config('app.name') }}
@endcomponent
