<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Info Koleksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('koleksiUpdate', $collection) }}" method="post">
                        @method('put')
                        @csrf
                        <!-- ID Koleksi -->
                        <div>
                            <x-input-label for="id" :value="__('ID Koleksi')" />
                            <x-text-input id="id" class="block mt-1 w-full" type="text" name="id"
                                :value="$collection->id" disabled />
                        </div>

                        <!-- Nama Koleksi -->
                        <div>
                            <x-input-label for="nama" :value="__('Nama Koleksi')" />

                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                :value="old('nama', $collection->nama)" />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />

                        </div>

                        <!-- Jenis Koleksi -->
                        <div class="mt-4">
                            <x-input-label for="jenis" :value="__('Jenis Koleksi')" />

                            <select id="jenis" name="jenis" id="jenis" class="block block mt-1 w-full"
                                required>
                                <option value="1" @if (old('jenis', $collection->jenis) == 1) selected @endif>Buku</option>
                                <option value="2" @if (old('jenis', $collection->jenis) == 2) selected @endif>Majalah
                                </option>
                                <option value="3" @if (old('jenis', $collection->jenis) == 3) selected @endif>Cakram Digital
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis')" class="mt-2" />

                        </div>

                        <!-- Jumlah Awal Koleksi -->
                        <div class="mt-4">
                            <x-input-label for="jumlahAwal" :value="__('Jumlah Awal')" />
                            <x-text-input id="jumlahAwal" class="block mt-1 w-full" type="number" name="jumlahAwal"
                                :value="$collection->jumlahAwal" disabled />

                        </div>

                        <!-- Jumlah Sisa Koleksi -->
                        <div class="mt-4">
                            <x-input-label for="jumlahSisa" :value="__('Jumlah Sisa')" />
                            <x-text-input id="jumlahSisa" class="block mt-1 w-full" type="number" name="jumlahSisa"
                                :value="$collection->jumlahSisa" disabled />
                        </div>

                        <!-- Jumlah Keluar -->
                        <div class="mt-4">
                            <x-input-label for="jumlahKeluar" :value="__('Jumlah Keluar')" />
                            <x-text-input id="jumlahKeluar" class="block mt-1 w-full" type="number" name="jumlahKeluar"
                                :value="old('jumlahKeluar', $collection->jumlahKeluar)" />
                            <x-input-error :messages="$errors->get('jumlahKeluar')" class="mt-2" />

                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button type="submit" class="ml-4">
                                {{ __('Update') }}
                            </x-primary-button>
                            <x-secondary-button type="reset" class="ml-4">
                                {{ __('Reset') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
