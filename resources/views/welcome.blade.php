@extends('layouts.base-guest')
@section('title')
    Digital Menu Maker!
@stop
@section('description', 'Digital QR Menu Maker for your restaurant, bar')
@section('keywords', 'digital menu, my menu, menu for restaurant')
@section('robots', 'index, follow')
@section('revisit-after', 'content="3 days')

@section('content')
    <div>
    <!-- Hero Section -->
    <div class="bg-white">
        <div class="relative overflow-hidden bg-white">
            <div class="hidden lg:absolute lg:inset-0 lg:block" aria-hidden="true">
                <svg class="absolute left-1/2 top-0 -translate-y-8 translate-x-64 transform" width="640" height="784" fill="none" viewBox="0 0 640 784">
                    <defs>
                        <pattern id="9ebea6f4-a1f5-4d96-8c4e-4c2abf658047" x="118" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor" />
                    <rect x="118" width="404" height="784" fill="url(#9ebea6f4-a1f5-4d96-8c4e-4c2abf658047)" />
                </svg>
            </div>

            <div class="relative pb-16 pt-6 sm:pb-24 lg:pb-32">
                <x-nav />

                <main class="mx-auto mt-8 max-w-7xl px-6 sm:mt-24 lg:mt-16">
                    <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                        <div class="sm:text-center md:mx-auto md:max-w-2xl lg:col-span-6 lg:text-left">
                            <h1>
{{--                                <span class="block text-base font-semibold text-gray-500 sm:text-lg lg:text-base xl:text-lg">Coming soon</span>--}}
                                <span class="mt-1 block text-4xl font-bold tracking-tight sm:text-5xl xl:text-6xl">
                                  <span class="block text-gray-900">Their Mobile phones</span>
                                  <span class="block text-rose-600">is your menu now!</span>
                                </span>
                            </h1>
                            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                                Create a digital menu for your restaurant or bar. Engage more with your customers. Let your customers scan
                                the QR code on their table and have your menu instantly on their phone.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="/register"
                                       class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-rose-600 hover:bg-rose-600 md:py-4 md:text-lg md:px-10">
                                        Get started </a>
                                </div>
                                <div class="mt-3 sm:mt-0 sm:ml-3">
                                    <a href="#demo"
                                       class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-rose-600 bg-rose-100 hover:bg-rose-200 md:py-4 md:text-lg md:px-10">
                                        Live demo </a>
                                </div>
                            </div>
                        </div>
                        <div class="relative mt-12 sm:mx-auto sm:max-w-lg lg:col-span-6 lg:mx-0 lg:mt-0 lg:flex lg:max-w-none lg:items-center">
                            <svg class="absolute left-1/2 top-0 origin-top -translate-x-1/2 -translate-y-8 scale-75 transform sm:scale-100 lg:hidden" width="640" height="784" fill="none" viewBox="0 0 640 784" aria-hidden="true">
                                <defs>
                                    <pattern id="4f4f415c-a0e9-44c2-9601-6ded5a34a13e" x="118" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                                    </pattern>
                                </defs>
                                <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor" />
                                <rect x="118" width="404" height="784" fill="url(#4f4f415c-a0e9-44c2-9601-6ded5a34a13e)" />
                            </svg>
                            <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                                <button type="button" class="relative block w-full overflow-hidden rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                                    <span class="sr-only">Watch our video to learn more</span>
                                    <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full blur-sm"
                                         src="https://menusavvy.com/channel/menusavvy/img/photos/cocktail.jpg" alt="" />
{{--                                    <img class="w-full" src="https://images.unsplash.com/photo-1556740758-90de374c12ad?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="">--}}
                                    <span class="absolute inset-0 flex h-full w-full items-center justify-center" aria-hidden="true">
                                        <svg class="h-20 w-20 text-rose-500" fill="currentColor" viewBox="0 0 84 84">
                                          <circle opacity="0.9" cx="42" cy="42" r="42" fill="white" />
                                          <path d="M55.5039 40.3359L37.1094 28.0729C35.7803 27.1869 34 28.1396 34 29.737V54.263C34 55.8604 35.7803 56.8131 37.1094 55.9271L55.5038 43.6641C56.6913 42.8725 56.6913 41.1275 55.5039 40.3359Z" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Trusted Companies -->
                    <div class="bg-white">
                        <div class="mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
                            <p class="text-center text-base font-semibold text-gray-600 tracking-wider">Trusted by these six restaurants so
                                fars</p>
                            <div class="mt-6 grid grid-cols-2 gap-0.5 md:grid-cols-3 lg:mt-8">
                                <div class="col-span-1 flex justify-center py-8 px-8 bg-rose-50">
                                    <img class="max-h-16" src="https://cdn.worldvectorlogo.com/logos/kfc-4.svg" alt="KFC" />
                                </div>
                                <div class="col-span-1 flex justify-center py-8 px-8 bg-rose-50">
                                    <img class="max-h-12" src="https://cdn.worldvectorlogo.com/logos/ken-mary.svg" alt="Ken-Mary" />
                                </div>
                                <div class="col-span-1 flex justify-center py-8 px-8 bg-rose-50">
                                    <img class="max-h-12" src="https://cdn.worldvectorlogo.com/logos/coca-cola-6.svg" alt="Coca" />
                                </div>
                                <div class="col-span-1 flex justify-center py-8 px-8 bg-rose-50">
                                    <img class="max-h-12" src="https://cdn.worldvectorlogo.com/logos/pepsi.svg" alt="Pepsi" />
                                </div>
                                <div class="col-span-1 flex justify-center py-8 px-8 bg-rose-50">
                                    <img class="max-h-12" src="https://cdn.worldvectorlogo.com/logos/pizza-hut.svg" alt="PizzaHut" />
                                </div>
                                <div class="col-span-1 flex justify-center py-8 px-8 bg-rose-50">
                                    <img class="max-h-12" src="https://cdn.worldvectorlogo.com/logos/b-king.svg" alt="BKing" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features section  -->

                    <div id="features" class="py-12 bg-white">
                        <div class="mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="lg:text-center">
                                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">The most
                                    comprehensive platform for QR digital menu</p>
                                <p class="mt-4 text-xl text-gray-500 lg:mx-auto">There are platforms where you can make QR code, but
                                    no menu. There are platforms where you can create a menu but not design your QR</p>
                                <p class="mt-4 text-xl text-gray-700">We do both.</p>
                            </div>
                            <div
                                class="mt-12 space-y-4 sm:mt-16 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-6 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 xl:grid-cols-3">
                                @foreach($features as $feature)
                                    <div  class="border border-gray-200 rounded-lg shadow-sm">
                                        <div class="p-6">
                                            <img
                                                src="https://images.pexels.com/photos/1058277/pexels-photo-1058277.jpeg?auto=compress&cs=tinysrgb&w=1600"
                                                alt="">
                                            <h2 class="text-xl leading-6 font-medium text-gray-900 mt-6">{{ $feature->name }}</h2>
                                            <p class="mt-4 text-lg text-gray-500">{{ $feature->description }}</p>
                                            <div class="pt-6 pb-8">
                                                <ul role="list" class="mt-6 space-y-4">
                                                    @foreach($feature->includedFeatures as $ftr)
                                                        <li  class="flex space-x-3">
                                                            <x-check-circle class="flex-shrink-0 h-5 w-5 text-rose-500" aria-hidden="true" />
                                                            <span class="text-lg text-gray-500">{{ $ftr }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <a href="{{$feature->href}}"
                                               class="mt-8 block w-full bg-rose-600  rounded-md py-2 text-sm font-semibold text-white text-center hover:bg-rose-900">
                                                {{
                                                    $feature->button
                                                }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <!-- Testimonial Section -->
                    <div id="testimonial" class="mx-auto py-24 px-4 bg-white sm:px-6 lg:px-8">
                        <h1
                            class="text-3xl text-center font-extrabold text-gray-900 sm:text-5xl sm:leading-none sm:tracking-tight lg:text-6xl">
                            Restaurants, Hotels and Bars that love our QRs
                        </h1>
                        <p class="mt-6  text-xl text-center text-gray-500">Used by top restaurants, hotels, bars and every diner all-over.
                        </p>

                        <section class="bg-white overflow-hidden mt-8">
                            <div class="relative max-w-7xl mx-auto pt-20 pb-12 px-4 sm:px-6 lg:px-8 lg:py-20">
                                <div class="relative lg:flex lg:items-center">
                                    <div class="hidden lg:block lg:flex-shrink-0">
                                        <img class="h-64 w-64 rounded-full xl:h-80 xl:w-80"
                                             src="https://images.unsplash.com/photo-1614890094520-7b8dd0ec56d2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTl8fGJsYWNrJTIwbWFufGVufDB8fDB8fA%3D%3D&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                                             alt="" />
                                    </div>

                                    <div class="relative lg:ml-10">
                                        <svg
                                            class="absolute top-0 left-0 transform -translate-x-8 -translate-y-24 h-36 w-36 text-rose-200 opacity-50"
                                            stroke="currentColor" fill="none" viewBox="0 0 144 144" aria-hidden="true">
                                            <path stroke-width="2"
                                                  d="M41.485 15C17.753 31.753 1 59.208 1 89.455c0 24.664 14.891 39.09 32.109 39.09 16.287 0 28.386-13.03 28.386-28.387 0-15.356-10.703-26.524-24.663-26.524-2.792 0-6.515.465-7.446.93 2.327-15.821 17.218-34.435 32.11-43.742L41.485 15zm80.04 0c-23.268 16.753-40.02 44.208-40.02 74.455 0 24.664 14.891 39.09 32.109 39.09 15.822 0 28.386-13.03 28.386-28.387 0-15.356-11.168-26.524-25.129-26.524-2.792 0-6.049.465-6.98.93 2.327-15.821 16.753-34.435 31.644-43.742L121.525 15z" />
                                        </svg>
                                        <blockquote class="relative">
                                            <div class="text-2xl leading-9 font-medium text-gray-900">
                                                <p>Clients are happy. They can see that we are a responsible restaurant and their health is a priority. No more old dirty menus. All they need is their phone.</p>
                                            </div>
                                            <footer class="mt-8">
                                                <div class="flex">
                                                    <div class="flex-shrink-0 lg:hidden">
                                                        <img class="h-12 w-12 rounded-full"
                                                             src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                             alt="" />
                                                    </div>
                                                    <div class="ml-4 lg:ml-0">
                                                        <div class="text-base font-medium text-gray-900">Jovenal Bantulaki</div>
                                                        <div class="text-base font-medium text-rose-600">CEO, Makarwe Restaurant</div>
                                                    </div>
                                                </div>
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Demo online menu -->
                    <div id="demo" class="mx-auto py-24 px-4 bg-rose-50 flex flex-col justify-center  sm:px-6 lg:px-8">
                        <h1
                            class="text-xl text-center font-extrabold text-gray-900 sm:text-3xl sm:leading-none sm:tracking-tight lg:text-4xl">
                            See a demo online menu
                        </h1>
                        <p class="mt-6  text-xl text-center text-gray-500">Just open the camera on your phone and scan the <b>QR code</b> below!
                        </p>
                        <img class="h-40 mt-8" src="https://www.svgrepo.com/show/76016/qr-code.svg" alt="menu" />
                    </div>
            </div>
        </div>
        </div>
    </div>
@endsection
