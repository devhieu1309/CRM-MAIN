<x-mail::message>
# Công việc {{ $title }} đã được giao.

<x-mail::button :url="$url">
Xem chi tiết công việc
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
