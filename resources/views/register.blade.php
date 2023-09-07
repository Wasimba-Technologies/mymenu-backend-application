@extends('layouts.base-guest')
@section('title')
    Register!
@stop
@section('description', 'Register your account to get started creating QR Digital Menu')
@section('keywords', 'register, account , digital menu, menu,')
@section('robots', 'index, follow')
@section('revisit-after', 'content="3 days')

@section('content')
    <div class="relative pb-16 pt-6 sm:pb-24 lg:pb-32">
        <div class="mt-8 min-h-full flex ">
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    <a href="/" class="text-rose-600 font-bold text-4xl text-center">
                        MyMenu
                    </a>
                    <div>
                        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Register your account</h2>
                        <p class="mt-2 text-sm text-gray-600">
                            Or
                            <a href="{{env('FRONT_END_URL').'/login'}}"
                               class="font-medium text-rose-600 hover:text-rose-500">Login to your account</a>
                        </p>
                    </div>

                    <div class="mt-8">
                        <div>
                            <div class="mt-6 relative">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <form id="registerOwnerForm" class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Names</label>
                                    <div class="mt-1">
                                        <input id="name" name="name" type="text" autocomplete="name" required
                                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm"/>
                                        <p class="mt-2 text-sm font-extrabold text-red-600" id="name-error">
                                            {{--                                            @error('name')--}}
                                            {{--                                            {{$message}}--}}
                                            {{--                                            @enderror--}}

                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        address</label>
                                    <div class="mt-1">
                                        <input id="email" name="email" type="email" autocomplete="email" required
                                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm"/>
                                        <p class="mt-2 text-sm font-extrabold text-red-600" id="email-error">
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <label for="tel" class="block text-sm font-medium text-gray-700">Phone
                                        Number</label>
                                    <div class="mt-1">
                                        <input id="phone_number" name="phone_number" type="tel" autocomplete="tel"
                                               required
                                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm"/>
                                        <p class="mt-2 text-sm font-extrabold text-red-600" id="phone-number-error">
                                        </p>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        Password </label>
                                    <div class="mt-1">
                                        <input id="password" name="password" type="password"
                                               autocomplete="current-password" required
                                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md
                                               shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm"/>
                                        <p class="mt-2 text-sm font-extrabold text-red-600" id="password-error">
                                        </p>
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <label for="password" class="block text-sm font-medium text-gray-700"> Confirm
                                        Password </label>
                                    <div class="mt-1">
                                        <input id="password_confirmation" name="password_confirmation" type="password"
                                               autocomplete="current-password" required
                                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm"/>
                                        <p class="mt-2 text-sm font-extrabold text-red-600"
                                           id="password-confirmation-error">
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" id="btnRegister" class="w-full btn-sm-submit">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block relative w-0 flex-1">
                <img class="absolute inset-0 h-full w-full object-cover blur-sm"
                     src="https://menusavvy.com/channel/menusavvy/img/photos/cocktail.jpg" alt=""/>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        async function registerOwner(ev) {
            resetErrors()
            ev.preventDefault()
            document.getElementById("btnRegister").disabled = true;
            await axios.post('api/auth/register', {
                'name': document.getElementById('name').value,
                'phone_number': document.getElementById('phone_number').value,
                'email': document.getElementById('email').value,
                'password': document.getElementById('password').value,
                'password_confirmation': document.getElementById('password_confirmation').value
            }).then(async response => {
                localStorage.setItem('access_token', response.data.access_token)
                window.location.pathname = '/register-restaurant'
            }).catch(err => {
                if (err.response.status === 422) {
                    for (let error in err.response.data.errors?.name) {
                        document.getElementById('name-error').innerHTML = err.response.data.errors?.name[error]
                    }
                    for (let error in err.response.data.errors?.phone_number) {
                        document.getElementById('phone-number-error').innerHTML = err.response.data.errors?.phone_number[error]
                    }
                    for (let error in err.response.data.errors?.email) {
                        document.getElementById('email-error').innerHTML = err.response.data.errors?.email[error]
                    }
                    for (let error in err.response.data.errors?.password) {
                        document.getElementById('password-error').innerHTML = err.response.data.errors?.password[error]
                    }
                    for (let error in err.response.data.errors?.password_confirmation) {
                        document.getElementById('password-confirmation-error').innerHTML = err.response.data.errors?.password_confirmation[error]
                    }
                }
            }).finally(
                () => document.getElementById("btnRegister").disabled = false
            )
        }

        const form = document.getElementById("registerOwnerForm");
        form.addEventListener("submit", registerOwner);

        const resetErrors = () => {
            document.getElementById('name-error').innerHTML = ""
            document.getElementById('phone-number-error').innerHTML = ""
            document.getElementById('email-error').innerHTML = ""
            document.getElementById('password-error').innerHTML = ""
            document.getElementById('password-confirmation-error').innerHTML = ""
        }
    </script>
@endpush
