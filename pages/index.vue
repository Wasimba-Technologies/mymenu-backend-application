
<template>
<div>
  <Title>MyMenu | Digital menu in customers mobile phones</Title>
  <!-- Hero Section -->
  <div class="relative bg-white overflow-hidden">
    <div class="mx-auto">
      <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
        <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
          fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
          <polygon points="50,0 100,0 50,100 0,100" />
        </svg>

        <Popover>
          <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
            <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
              <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                <div class="flex items-center justify-between w-full md:w-auto">
                  <a href="#" class="font-bold text-red-600 text-xl">
                    MyMenu
                  </a>
                  <div class="-mr-2 flex items-center md:hidden">
                    <PopoverButton
                      class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-red-600">
                      <span class="sr-only">Open main menu</span>
                      <MenuIcon class="h-6 w-6" aria-hidden="true" />
                    </PopoverButton>
                  </div>
                </div>
              </div>
              <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                <a v-for="item in navigation" :key="item.name" :href="item.href"
                  class="font-medium text-gray-500 hover:text-gray-900">{{ item.name }}</a>
                <a href="#" class="font-medium text-red-600 hover:text-red-600">Log in</a>
              </div>
            </nav>
          </div>

          <transition enter-active-class="duration-150 ease-out" enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in"
            leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
            <PopoverPanel focus
              class="absolute z-10 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
              <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                <div class="px-5 pt-4 flex items-center justify-between">
                  <div>
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-red-600.svg" alt="" />
                  </div>
                  <div class="-mr-2">
                    <PopoverButton
                      class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-red-600">
                      <span class="sr-only">Close main menu</span>
                      <XIcon class="h-6 w-6" aria-hidden="true" />
                    </PopoverButton>
                  </div>
                </div>
                <div class="px-2 pt-2 pb-3 space-y-1">
                  <a v-for="item in navigation" :key="item.name" :href="item.href"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">{{
                        item.name
                    }}</a>
                </div>
                <a href="#"
                  class="block w-full px-5 py-3 text-center font-medium text-red-600 bg-gray-50 hover:bg-gray-100"> Log
                  in </a>
              </div>
            </PopoverPanel>
          </transition>
        </Popover>

        <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
          <div class="sm:text-center lg:text-left">
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
              <span class="block xl:inline">Their mobile phones</span>
              {{ ' ' }}
              <span class="block text-red-600 xl:inline">is your menu now!</span>
            </h1>
            <p
              class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
              Create a digital menu for your restaurant or bar. Engage more with your customers. Let your customers scan
              the QR code on their table and have your menu instantly on their phone.</p>
            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
              <div class="rounded-md shadow">
                <a href="#"
                  class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-600 md:py-4 md:text-lg md:px-10">
                  Get started </a>
              </div>
              <div class="mt-3 sm:mt-0 sm:ml-3">
                <a href="#"
                  class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-red-600 bg-red-100 hover:bg-red-200 md:py-4 md:text-lg md:px-10">
                  Live demo </a>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
      <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full blur-sm"
        src="https://menusavvy.com/channel/menusavvy/img/photos/cocktail.jpg" alt="" />
    </div>
  </div>

  <!-- Trusted Companies -->
  <div class="bg-white">
    <div class="mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
      <p class="text-center text-base font-semibold text-gray-600 tracking-wider">Trusted by these six restaurants so
        fars</p>
      <div class="mt-6 grid grid-cols-2 gap-0.5 md:grid-cols-3 lg:mt-8">
        <div class="col-span-1 flex justify-center py-8 px-8 bg-red-50">
          <img class="max-h-16" src="https://cdn.worldvectorlogo.com/logos/kfc-4.svg" alt="KFC" />
        </div>
        <div class="col-span-1 flex justify-center py-8 px-8 bg-red-50">
          <img class="max-h-12" src="https://cdn.worldvectorlogo.com/logos/ken-mary.svg" alt="Ken-Mary" />
        </div>
        <div class="col-span-1 flex justify-center py-8 px-8 bg-red-50">
          <img class="max-h-12" src="https://cdn.worldvectorlogo.com/logos/coca-cola-6.svg" alt="Coca" />
        </div>
        <div class="col-span-1 flex justify-center py-8 px-8 bg-red-50">
          <img class="max-h-12" src="https://cdn.worldvectorlogo.com/logos/pepsi.svg" alt="Pepsi" />
        </div>
        <div class="col-span-1 flex justify-center py-8 px-8 bg-red-50">
          <img class="max-h-12" src="https://cdn.worldvectorlogo.com/logos/pizza-hut.svg" alt="PizzaHut" />
        </div>
        <div class="col-span-1 flex justify-center py-8 px-8 bg-red-50">
          <img class="max-h-12" src="https://cdn.worldvectorlogo.com/logos/b-king.svg" alt="BKing" />
        </div>
      </div>
    </div>
  </div>

  <!-- Features section -->

  <div class="py-12 bg-white">
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
        <div v-for="feature in features" :key="feature.name" class="border border-gray-200 rounded-lg shadow-sm">
          <div class="p-6">
            <img
              src="https://images.pexels.com/photos/1058277/pexels-photo-1058277.jpeg?auto=compress&cs=tinysrgb&w=1600"
              alt="">
            <h2 class="text-xl leading-6 font-medium text-gray-900 mt-6">{{ feature.name }}</h2>
            <p class="mt-4 text-lg text-gray-500">{{ feature.description }}</p>
            <div class="pt-6 pb-8">
              <ul role="list" class="mt-6 space-y-4">
                <li v-for="feature in feature.includedFeatures" :key="feature" class="flex space-x-3">
                  <CheckCircleIcon class="flex-shrink-0 h-5 w-5 text-red-500" aria-hidden="true" />
                  <span class="text-lg text-gray-500">{{ feature }}</span>
                </li>
              </ul>
            </div>
            <a :href="feature.href"
              class="mt-8 block w-full bg-red-600  rounded-md py-2 text-sm font-semibold text-white text-center hover:bg-red-900">{{
                  feature.button
              }}</a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Pricing section  -->
  <div class="mx-auto py-24 px-4 bg-white sm:px-6 lg:px-8">
    <h2
      class="text-3xl text-center font-extrabold text-gray-900 sm:text-5xl sm:leading-none sm:tracking-tight lg:text-6xl">
      Pricing plans for restaurants, hotels or bars of all sizes</h2>
    <p class="mt-6  text-xl text-center text-gray-500">Choose an affordable plan that's packed with the best features
      for engaging your audience, creating customer loyalty, and driving sales.</p>

    <!-- Tiers -->
    <div class="mt-24 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-8">
      <div v-for="tier in pricing.tiers" :key="tier.title"
        class="relative p-8 bg-white border border-gray-200 rounded-2xl shadow-sm flex flex-col">
        <div class="flex-1">
          <h3 class="text-xl font-semibold text-gray-900">{{ tier.title }}</h3>
          <p v-if="tier.mostPopular"
            class="absolute top-0 py-1.5 px-4 bg-red-600 rounded-full text-xs font-semibold uppercase tracking-wide text-white transform -translate-y-1/2">
            Most popular</p>
          <p class="mt-4 flex items-baseline text-gray-900">
            <span class="text-5xl font-extrabold tracking-tight">$<span class="text-red-600">{{ tier.price
            }}</span></span>
            <span class="ml-1 text-xl font-semibold">{{ tier.frequency }}</span>
          </p>
          <p class="mt-6 text-gray-500">{{ tier.description }}</p>

          <!-- Feature list -->
          <ul role="list" class="mt-6 space-y-6">
            <li v-for="feature in tier.features" :key="feature" class="flex">
              <CheckIcon class="flex-shrink-0 w-6 h-6 text-red-600" aria-hidden="true" />
              <span class="ml-3 text-gray-500">{{ feature }}</span>
            </li>
          </ul>
        </div>

        <a href="#"
          :class="[tier.mostPopular ? 'bg-red-600 text-white hover:bg-red-700' : 'bg-red-50 text-red-700 hover:bg-red-100', 'mt-8 block w-full py-3 px-6 border border-transparent rounded-md text-center font-medium']">{{
              tier.cta
          }}</a>
      </div>
    </div>
  </div>

  <!-- Testimonial Section -->

  <div class="mx-auto py-24 px-4 bg-white sm:px-6 lg:px-8">
    <h2
      class="text-3xl text-center font-extrabold text-gray-900 sm:text-5xl sm:leading-none sm:tracking-tight lg:text-6xl">
      Restaurants, Hotels and Bars that love our QRs</h2>
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
              class="absolute top-0 left-0 transform -translate-x-8 -translate-y-24 h-36 w-36 text-red-200 opacity-50"
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
                    <div class="text-base font-medium text-red-600">CEO, Makarwe Restaurant</div>
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

  <div class="mx-auto py-24 px-4 bg-red-50 flex flex-col justify-center  sm:px-6 lg:px-8">
    <h2
      class="text-xl text-center font-extrabold text-gray-900 sm:text-3xl sm:leading-none sm:tracking-tight lg:text-4xl">
      See a demo online menu</h2>
    <p class="mt-6  text-xl text-center text-gray-500">Just open the camera on your phone and scan the <b>QR code</b> below!
    </p>
    <img class="h-40 mt-8" src="https://www.svgrepo.com/show/76016/qr-code.svg" alt="menu" />
  </div>

  <!-- Footer Section -->
  <footer class="bg-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
      <div class="flex justify-center space-x-6 md:order-2">
        <a v-for="item in footerNavigation" :key="item.name" :href="item.href" class="text-gray-400 hover:text-gray-500">
          <span class="sr-only">{{ item.name }}</span>
          <component :is="item.icon" class="h-6 w-6" aria-hidden="true" />
        </a>
      </div>
      <div class="mt-8 md:mt-0 md:order-1">
        <p class="text-center text-base text-gray-400">&copy; 2022 WasimbaLabs, Inc. All rights reserved.</p>
      </div>
    </div>
  </footer>

</div>
</template>

<script setup>
import { defineComponent, h } from 'vue'
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { MenuIcon, XIcon, CheckIcon } from '@heroicons/vue/outline'
import { CheckCircleIcon } from '@heroicons/vue/solid'

const pricing = {
  tiers: [
    {
      title: 'Free',
      price: 0,
      frequency: '/month',
      description: 'If you run a small restaurant or bar, or just need the basics, this plan is great.',
      features: ['Full access to QR tool', ' Access to the menu creation tool', 'Unlimited views', '30 items in the menu', 'Community support'],
      cta: 'Monthly billing',
      mostPopular: false,
    },
    {
      title: 'Starter',
      price: 9,
      frequency: '/month',
      description: 'For bigger restaurants and bars. Offer a full menu. Limitless plan.',
      features: ['Full access to QR tool', ' Access to the menu creation tool', 'Unlimited views', 'Unlimited items in the menu', '300 orders per month', 'Dedicated support'],
      cta: 'Monthly billing',
      mostPopular: true,
    },
    {
      title: 'Pro',
      price: 49,
      frequency: '/month',
      description: 'Dedicated support and infrastructure for your company.',
      features: ['Full access to QR tool', ' Access to the menu creation tool', 'Unlimited views', 'Unlimited items in the menu', 'Unlimited orders', 'Dedicated support'],
      cta: 'Monthly billing',
      mostPopular: false,
    },
  ],
}

const features = [
  {
    name: 'Create a Digital Menu',
    href: '#',
    button: 'Experience it',
    description: 'Create your menu directly on our platform. Update anytime. Easy And Simple',
    includedFeatures: ['Real-time changes', 'Organize into categories', 'Extras and items variants'],
  },
  {
    name: 'Create QR',
    href: '#',
    button: 'Design it',
    description: '8 different designs. Unlimited color options. Choose QR and Flayer style.',
    includedFeatures: [
      'Beautiful QR Styles',
      'Pick QR Color',
      'Print templates for download',
    ],
  },
  {
    name: 'Go Digital',
    href: '#',
    button: "Go mobile",
    description: 'Now your visitors will use their mobile phone camera to access your menu.',
    includedFeatures: [
      'No mobile app required',
      'Super-fast online menu - PWA',
      'View analytics',
    ],
  },
  {
    name: 'Accept local orders',
    href: '#',
    button: 'Try it',
    description: 'Your customers can order direclty from their phone',
    includedFeatures: [
      'Real-time sound notifications',
      'Continuous orders',
      'Unlimited options, variants and extras',
    ],
  },
  {
    name: 'Accept payments',
    href: '#',
    button: 'Accept countactless payments',
    description: 'Your customers can pay order directly via card or mobile money',
    includedFeatures: [
      'Accept and Credit and Debit Card ',
      'All mobile money payments accepted',
      'Secure online payments',
      'Print receipt'
    ],
  },
  {
    name: 'Customer Log',
    href: '#',
    button: 'Retain your customers',
    description: 'Know all your potential customers for easy contact and retantion.',
    includedFeatures: [
      'Customers can reguster them selfs',
      'Manage the visits on your own',
      'Customer relationship management (CRM)'
    ],
  },
]

const navigation = [
  { name: 'Features', href: '#' },
  { name: 'Pricing', href: '#' },
  { name: 'Testimonials', href: '#' },
  { name: 'Live Demo', href: '#' },
]

const footerNavigation = [
  {
    name: 'Facebook',
    href: '#',
    icon: defineComponent({
      render: () =>
        h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
          h('path', {
            'fill-rule': 'evenodd',
            d: 'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z',
            'clip-rule': 'evenodd',
          }),
        ]),
    }),
  },
  {
    name: 'Instagram',
    href: '#',
    icon: defineComponent({
      render: () =>
        h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
          h('path', {
            'fill-rule': 'evenodd',
            d: 'M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z',
            'clip-rule': 'evenodd',
          }),
        ]),
    }),
  },
  {
    name: 'Twitter',
    href: '#',
    icon: defineComponent({
      render: () =>
        h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
          h('path', {
            d: 'M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84',
          }),
        ]),
    }),
  },
  {
    name: 'GitHub',
    href: '#',
    icon: defineComponent({
      render: () =>
        h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
          h('path', {
            'fill-rule': 'evenodd',
            d: 'M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z',
            'clip-rule': 'evenodd',
          }),
        ]),
    }),
  },
  {
    name: 'Dribbble',
    href: '#',
    icon: defineComponent({
      render: () =>
        h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
          h('path', {
            'fill-rule': 'evenodd',
            d: 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z',
            'clip-rule': 'evenodd',
          }),
        ]),
    }),
  },
]
</script>