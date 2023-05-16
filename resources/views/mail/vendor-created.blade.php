<x-mail::message>
{{ trans('mail.vendor.created.message') }}
<x-mail::button :url="route('filament.resources.vendors.edit', $vendor)">
{{ trans('mail.vendor.created.button') }}
</x-mail::button>
</x-mail::message>
