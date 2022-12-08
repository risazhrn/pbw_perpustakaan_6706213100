<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi Kembalikan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('detailTransactionUpdate') }}">
                        @csrf
                        @method('put')

                        <input type="hidden" name="idKoleksi" value="{{ $detailTransactions->idKoleksi }}">

                        <!-- ID Detail Tranaksi -->
                        <div>
                            <x-input-label for="idTransaksi" :value="__('ID Transaksi')" />
                            <x-text-input id="idTransaksi" class="block mt-1 w-full" type="text" name="idTransaksi"
                                :value="$detailTransactions->idTransaksi" readonly />
                            <x-input-error :messages="$errors->get('idTransaksi')" class="mt-2" />
                        </div>

                        <!-- ID Detail Transaksi -->
                        <div class="mt-4">
                            <x-input-label for="idDetailTransactions" :value="__('ID Detail Transaksi')" />
                            <x-text-input id="idDetailTransactions" class="block mt-1 w-full" type="text"
                                name="idDetailTransactions" :value="$detailTransactions->id" readonly />
                            <x-input-error :messages="$errors->get('idDetailTransactions')" class="mt-2" />
                        </div>

                        <!-- Peminjam -->
                        <div class="mt-4">
                            <x-input-label for="idPeminjam" :value="__('Peminjam')" />
                            <x-text-input id="idPeminjam" class="block mt-1 w-full" type="text" name="idPeminjam"
                                :value="$detailTransactions->namaPeminjam" disabled />
                            <x-input-error :messages="$errors->get('idPeminjam')" class="mt-2" />
                        </div>

                        <!-- Petugas -->
                        <div class="mt-4">
                            <x-input-label for="idPetugas" :value="__('Petugas')" />
                            <x-text-input id="idPetugas" class="block mt-1 w-full" type="text" name="idPetugas"
                                :value="$detailTransactions->namaPetugas" disabled />
                            <x-input-error :messages="$errors->get('idPetugas')" class="mt-2" />
                        </div>

                        <!-- koleksi -->
                        <div class="mt-4">
                            <x-input-label for="koleksi" :value="__('Koleksi')" />
                            <x-text-input id="koleksi" class="block mt-1 w-full" type="text" name="koleksi"
                                :value="$detailTransactions->koleksi" disabled />
                            <x-input-error :messages="$errors->get('koleksi')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />

                            <select name="status" id="status" class="block block mt-1 w-full">
                                <option value="1" @if (old('status', $detailTransactions->status) == 1) selected @endif>Pinjam</option>
                                <option value="2" @if (old('status', $detailTransactions->status) == 2) selected @endif>Kembali
                                </option>
                                <option value="3" @if (old('status', $detailTransactions->status) == 3) selected @endif>Hilang</option>
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
