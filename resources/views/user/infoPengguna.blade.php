<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Info Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                        <!-- id -->
                        <div>
                            <x-input-label for="id" :value="__('ID Pengguna')" />
                            <x-text-input id="id" class="block mt-1 w-full" type="text" name="id"
                                :value="$user->id" readonly />
                            <x-input-error :messages="$errors->get('id')" class="mt-2" />
                        </div>

                        <!-- Username -->
                        <div class="mt-4">
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                                :value="$user->username" readonly />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <!-- Fullname -->
                        <div class="mt-4">
                            <x-input-label for="fullname" :value="__('Fullname')" />
                            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname"
                                :value="$user->fullname" readonly />
                            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="$user->email" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- address -->
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                :value="$user->address" readonly />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <x-input-label for="phoneNumber" :value="__('Phone Number')" />
                            <x-text-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber"
                                :value="$user->phoneNumber" readonly />
                            <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
                        </div>

                        <!-- birthdate -->
                        <div class="mt-4">
                            <x-input-label for="birthdate" :value="__('Birthdate')" />
                            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"
                                :value="$user->birthdate" readonly />
                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
