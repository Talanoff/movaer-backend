<x-mail::message>
{{ trans('mail.admin.order.created.message') }}
<x-mail::button :url="route('filament.resources.orders.edit', $order)">
{{ trans('mail.admin.order.created.button') }}
</x-mail::button>
</x-mail::message>
