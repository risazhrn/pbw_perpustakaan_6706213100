<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Koleksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('koleksiStore') }}" method="post">
                        @csrf
                        <!-- Nama Koleksi -->
                        <div>
                            <x-input-label for="nama" :value="__('Nama Koleksi')" />

                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                :value="old('nama')" required autofocus />

                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <!-- Jenis Koleksi -->
                        <div class="mt-4">
                            <x-input-label for="jenis" :value="__('Jenis Koleksi')" />

                            <select name="jenis" id="jenis" class="block block mt-1 w-full">
                                <option selected>--- Select ---</option>
                                <option value="1">Buku</option>
                                <option value="2">Majalah</option>
                                <option value="3">Cakram Digital</option>
                            </select>
                        </div>

                        <!-- Jumlah Koleksi -->
                        <div class="mt-4">
                            <x-input-label for="jumlahAwal" :value="__('jumlah')" />

                            <x-text-input id="jumlahAwal" class="block mt-1 w-full" type="text"
                                name="jumlahAwal" :value="old('jumlahAwal')" required />

                            <x-input-error :messages="$errors->get('jumlahAwal')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Tambah Koleksi') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
