<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="alert alert-success">
                            <div class="row form-inline" onclick='$(this).parent().remove();'>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <span class="label"><strong>x</strong></span>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('transactionStore') }}">
                        @csrf

                        <!-- Peminjam -->
                        <div>
                            <x-input-label for="idPeminjam" :value="__('Peminjam*')" />
                            <select name="idPeminjam" id="idPeminjam"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                <option value="-1">--Pilih dahulu--</option>
                                @foreach ($users as $user)
                                    @if ($user->id == old('idPeminjam'))
                                        <option value="{{ $user->id }}" selected>{{ $user->fullname }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="koleksi1" :value="__('Koleksi 1*')" />
                            <select name="koleksi[0]" id="koleksi1"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                <option value="-1">--Pilih dahulu--</option>
                                @foreach ($collections as $collection)
                                    @if ($collection->id == old('koleksi[0]'))
                                        <option value="{{ $collection->id }}" selected>{{ $collection->nama }}</option>
                                    @else
                                        <option value="{{ $collection->id }}">{{ $collection->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="koleksi2" :value="__('Koleksi 2')" />
                            <select name="koleksi[1]" id="koleksi2"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                <option value="-1">--Pilih dahulu--</option>
                                @foreach ($collections as $collection)
                                    @if ($collection->id == old('koleksi[1]'))
                                        <option value="{{ $collection->id }}" selected>{{ $collection->nama }}
                                        </option>
                                    @else
                                        <option value="{{ $collection->id }}">{{ $collection->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="koleksi3" :value="__('Koleksi 3')" />
                            <select name="koleksi[2]" id="koleksi3"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                <option value="-1">--Pilih dahulu--</option>
                                @foreach ($collections as $collection)
                                    @if ($collection->id == old('koleksi[2]'))
                                        <option value="{{ $collection->id }}" selected>{{ $collection->nama }}
                                        </option>
                                    @else
                                        <option value="{{ $collection->id }}">{{ $collection->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
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
