<x-mail::message>
## {{ trans('mail.customer.order.created.details') }}

<x-mail::table>
| {{ trans('mail.customer.order.created.table.from') }} | {{ trans('mail.customer.order.created.table.to') }} |
| ----- | ----- |
| {{ $order->pickup_at?->format('M d, Y') }} | {{ $order->delivery_at?->format('M d, Y') }} |
| {{ $order->address_from }} | {{ $order->address_to }} |
| {{ $order->pickup_location_type->getName() }} | {{ $order->delivery_location_type->getName() }} |
</x-mail::table>

## {{ trans('mail.customer.order.created.contact') }}

#### {{ $order->details['contact']['name'] }}
{{ $order->details['contact']['email'] }}
{{ $order->details['contact']['phone'] }}

### {{ trans('mail.customer.order.created.thank') }}
</x-mail::message>
