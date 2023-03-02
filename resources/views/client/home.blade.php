@php use App\Enums\DeliveryCategoryEnum; @endphp
<x-app-layout>

    <section class="container">
        <figure
            class="h-screen max-h-[32rem] -mb-24 rounded-lg overflow-hidden bg-center bg-cover"
            style="background-image: url({{ asset('images/banners/banner-1.jpg') }})"
        ></figure>

        <div class="max-w-[90%] xl:max-w-[64rem] bg-white shadow-2xl shadow-slate-200/75 p-5 lg:p-8 rounded-md mx-auto">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 text-sm font-semibold">
                @foreach(DeliveryCategoryEnum::cases() as $category)
                    <a href="#" class="block group text-center">
                        <div class="flex justify-center items-center p-5 lg:p-8 border-2 border-slate-200 rounded-md group-hover:border-blue-600 group-hover:bg-slate-50 transition-colors duration-300">
                            <svg class="h-16">
                                <use xlink:href="{{ asset('images/icons/categories.svg#' . $category->getIconName()) }}"></use>
                            </svg>
                        </div>

                        <div class="mt-1.5 group-hover:text-slate-700">
                            {{ $category->getName() }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-10 xl:py-20">
        <div class="container max-w-4xl">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="relative">
                    <div class="absolute w-28 h-28 -top-5 -left-5 bg-slate-100 -z-10"></div>
                    <h2 class="text-5xl font-bold text-blue-900">2148</h2>
                    <div class="text-slate-600 w-1/2 mt-5">
                        {{ __('Something') }}
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute w-28 h-28 -top-5 left-5 bg-slate-100 -z-10"></div>
                    <h2 class="text-5xl font-bold text-blue-900">153</h2>
                    <div class="text-slate-600 w-1/2 mt-5">
                        {{ __('Something') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 xl:py-20 bg-slate-50">
        <div class="container max-w-4xl">
            <h2 class="text-center text-5xl font-bold">
                {{ __('Something') }}
            </h2>
        </div>
    </section>

</x-app-layout>
