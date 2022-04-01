@component('mail::message')
# Hey there {{ $user->name }}

A new post was made on {{ $website->name }} ({{ $website->url }}) on {{ $post->created_at->format('H:i A. d/M/Y') }}.

@component('mail::panel')
Title: {{ $post->title }} <br>
Description: {{ $post->description }}
@endcomponent

Thanks,<br>
{{ config('app.name') }} on behalf of {{ $website->name }}
@endcomponent
