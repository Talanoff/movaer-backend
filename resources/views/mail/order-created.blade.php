<x-mail::message>
{{ trans('mail.order.created.message') }}
<x-mail::button :url="route('filament.resources.orders.edit', $order)">
{{ trans('mail.order.created.button') }}
</x-mail::button>
</x-mail::message>
