
@extends('layouts.base-guest')
@section('title')
    Pricing
@stop
@section('description', 'Our pricing range from FREE are further customizable ')
@section('keywords', 'pricing , digital menu, Free QR Menu,')
@section('robots', 'index, follow')
@section('revisit-after', 'content="3 days')

@section('content')
    <div class="relative pb-16 pt-6 sm:pb-24 lg:pb-32">
        <x-nav />
        <!-- Pricing section  -->
        <div id="pricing" class="mx-auto py-24 px-4 bg-white sm:px-6 lg:px-8">
            <h1 class="text-3xl text-center font-extrabold text-gray-900 sm:text-5xl sm:leading-none sm:tracking-tight lg:text-6xl">
                Pricing plans for restaurants, hotels or bars of all sizes
            </h1>
            <p class="mt-6  text-xl text-center text-gray-500">
                Choose an affordable plan that's packed with the best features
                for engaging your audience, creating customer loyalty, and driving sales.
            </p>

            <!-- Tiers -->
            <div  class="mt-24 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-8">
                @foreach($pricing['tiers'] as $tier)
                    <div class="relative p-8 bg-white border border-gray-200 rounded-2xl shadow-sm flex flex-col">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $tier->title }}</h3>
                            @if($tier->mostPopular)
                                <p class="absolute top-0 py-1.5 px-4 bg-rose-600 rounded-full text-xs font-semibold uppercase tracking-wide text-white transform -translate-y-1/2">
                                    Most popular
                                </p>
                            @endif
                            <p class="mt-4 flex items-baseline text-gray-900">
                                  <span class="text-5xl font-extrabold tracking-tight">$
                                      <span class="text-rose-600">
                                          {{ $tier->price}}
                                      </span>
                                  </span>
                                <span class="ml-1 text-xl font-semibold">{{ $tier->frequency }}</span>
                            </p>
                            <p class="mt-6 text-gray-500">{{ $tier->description }}</p>

                            <!-- Feature list -->
                            <ul role="list" class="mt-6 space-y-6">
                                @foreach($tier->features as $feature)
                                    <li  class="flex">
                                        <x-check class="flex-shrink-0 w-6 h-6 text-rose-600" aria-hidden="true" />
                                        <span class="ml-3 text-gray-500">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        @if($tier->mostPopular)
                            <a href="#" class="bg-rose-600 text-white hover:bg-rose-700 mt-8 block w-full py-3 px-6 border border-transparent rounded-md text-center font-medium">
                                {{
                                    $tier->cta
                                }}
                            </a>
                        @else
                            <a href="#" class="bg-rose-50 text-rose-700 hover:bg-rose-100 mt-8 block w-full py-3 px-6 border border-transparent rounded-md text-center font-medium">
                                {{
                                    $tier->cta
                                }}
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
