@component('mail::message')
# Feedback from user

Title:
@component('mail::panel')
{{$feedback->title}}
@endcomponent

Text:
@component('mail::panel')
{{$feedback->text}}
@endcomponent

Email:
@component('mail::panel')
{{$feedback->email}}
@endcomponent

Image:
@component('mail::panel')
{{$feedback->image->original_name ?? 'none'}}
@endcomponent

File:
@component('mail::panel')
{{$feedback->file->original_name ?? 'none'}}
@endcomponent


@component('mail::button', ['url' => $url])
View in admin
@endcomponent

@component('mail::table')
||
|-|
|If you're having trouble clicking the "View in admin" button, copy and paste the URL below into your web browser: <a style="word-break: break-all" href="{{$url}}">{{$url}}</a>|
@endcomponent
@endcomponent
