<x-mail::message>
## {{ trans('mail.customer.order.created.details') }}

| {{ trans('mail.customer.order.created.table.from') }} | {{ trans('mail.customer.order.created.table.to') }} |
| ----- | ----- |
| {{ $order->pickup_at?->format('M d, Y') }} | {{ $order->delivery_at?->format('M d, Y') }} |
| {{ $order->address_from }} | {{ $order->address_to }} |
| {{ $order->pickup_location_type->getName() }} | {{ $order->delivery_location_type->getName() }} |

### {{ trans('mail.customer.order.created.thank') }}
</x-mail::message>
