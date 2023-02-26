<template>
    <div class="min-h-full h-full flex flex-col justify-center py-12 bg-gray-50 sm:px-6 lg:px-8">
        <title>MyMenu |  Register</title>
        <div class="sm:mx-auto sm:w-full sm:max-w-md md:max-w-lg  lg:max-w-xl xl:max-w-2xl 2xl:max-w-3xl">
            <h1 class="text-rose-600 font-bold text-4xl text-center">MyMenu</h1>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Register your restaurant, hotel or bar</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md md:max-w-lg  lg:max-w-xl xl:max-w-2xl 2xl:max-w-3xl">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6 divide-y" action="/login" method="POST">
                    <div>
                        <h2 class="text-gray-400 mb-4">Restaurant Information</h2>
                        <div>
                            <label for="restaurant_name" class="block text-sm font-medium text-gray-700"> Restaurant name </label>
                            <div class="mt-1">
                                <input id="restaurant_name" name="restaurant_name" type="text" autocomplete="restaurant_name" requirose placeholder="Restaurant name here..." class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h2 class="text-gray-400 mb-2 mt-6">Owner Information</h2>
                        <div>
                            <label for="owner_name" class="block text-sm font-medium text-gray-700"> Owner's name </label>
                            <div class="mt-1">
                                <input id="owner_name" name="owner_name" type="text" autocomplete="name" requirose placeholder="Owner name here..." class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="owner_email" class="block text-sm font-medium text-gray-700"> Owner email </label>
                            <div class="mt-1">
                                <input id="owner_email" name="owner_email" type="email" autocomplete="email" requirose placeholder="mymenu@example.com" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700"> Owner Phone number </label>
                            <div class="mt-1">
                                <input id="phone_number" name="phone_number" type="tel" autocomplete="phone" requirose placeholder="0xxx xxx xxx" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="password" class="block text-sm font-medium text-gray-700"> Owner password </label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="password" requirose placeholder="Owner password here..." class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                            </div>
                        </div>
                    </div>



                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    name: "Register"
}
</script>

<style scoped>

</style>
