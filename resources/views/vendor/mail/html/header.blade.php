@props(['url'])
<tr>
<td class="header" style="background-color:#FFFFFF">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo-v2.1.png" class="logo" alt="Laravel Logo">
@else
<!--{!! $slot !!}-->
<img src="{{ asset('backend/assets/logo/image1.png')}}" class="logo" alt="Laravel Logo">
@endif
</a>
</td>
</tr>
