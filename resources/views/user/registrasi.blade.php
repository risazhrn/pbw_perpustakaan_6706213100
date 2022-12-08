<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrasi Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('userStore') }}">
                        @csrf

                        <!-- Username -->
                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                                :value="old('username')" required autofocus />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <!-- Fullname -->
                        <div class="mt-4">
                            <x-input-label for="fullname" :value="__('Fullname')" />
                            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname"
                                :value="old('fullname')" required autofocus />
                            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- address -->
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                :value="old('address')" required autofocus />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <x-input-label for="phoneNumber" :value="__('Phone Number')" />
                            <x-text-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber"
                                :value="old('phoneNumber')" required autofocus />
                            <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
                        </div>

                        <!-- birthdate -->
                        <div class="mt-4">
                            <x-input-label for="birthdate" :value="__('Birthdate')" />
                            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"
                                :value="old('birthdate')" required autofocus />
                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button type="submit" class="ml-4">
                                    {{ __('OK') }}
                                </x-primary-button>
                                <x-secondary-button type="reset" class="ml-4">
                                    {{ __('Reset') }}
                                </x-secondary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
