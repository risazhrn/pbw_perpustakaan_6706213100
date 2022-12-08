<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-4 row form-group">
                        <x-input-label for="peminjam" :value="__('Peminjam')" />
                        <x-text-input id="peminjam" type="text" name="peminjam" :value="$transactions->fullnamePeminjam" readonly />
                    </div>
                    <div class="mt-4 mb-6 row form-group">
                        <x-input-label for="petugas" :value="__('Petugas')" />
                        <x-text-input id="petugas" type="text" name="petugas" :value="$transactions->fullnamePetugas" readonly />
                    </div>
                    <table class="table table-striped table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Koleksi</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable({
                    ajax: '{{ route('getAllDetailTransactions', $transactions->id) }}',
                    serverSide: false,
                    processing: true,
                    deferRender: true,
                    type: 'GET',
                    destroy: true,
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'koleksi',
                            name: 'koleksi'
                        },
                        {
                            data: 'tanggalPinjam',
                            name: 'tanggalPinjam'
                        },
                        {
                            data: 'tanggalKembali',
                            name: 'tanggalKembali'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>
    @endpush

</x-app-layout>
