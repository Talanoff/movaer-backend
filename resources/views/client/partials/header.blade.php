@php
$nav = [
    'for-vendors' => __('for vendors'),
    'for-customers' => __('for customers'),
    'about-us' => __('about us')
];
@endphp

<header role="banner" class="sticky top-0 mb-5 xl:mb-8 py-2.5 text-sm bg-white/80 backdrop-blur-xl">
    <div class="container">
        <div class="flex items-center">
            <a href="{{ url('/') }}">
                <x-logo/>
            </a>

            <nav class="ml-10 flex space-x-5 font-semibold">
                @foreach($nav as $url => $name)
                <a href="{{ url($url) }}" @class([
                    'text-blue-600' => url()->current() === url($url)
                ])>
                    {{ $name }}
                </a>
                @endforeach
            </nav>
        </div>
    </div>
</header>
