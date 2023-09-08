<x-mail::message>
# Introduction

Congratulations You are not a premium  user
<p>Your perches details</p>
<p>Plan: {{$plan}}</p>
<p>Your plan ends on:{{$billingEnds}}</p>
<x-mail::button :url="{{route('dashboard')}}">
job a job
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
