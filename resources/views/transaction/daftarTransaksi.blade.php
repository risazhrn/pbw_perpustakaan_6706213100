<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-4 mb-6">
                        <a href="{{ route('transaksiTambah') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Tambah Transaksi</a>
                    </div>

                    <table class="table table-striped table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Petugas</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Selesai</th>
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
                    ajax: '{{ route('getAllTransactions') }}',
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
                            data: 'peminjam',
                            name: 'peminjam'
                        },
                        {
                            data: 'petugas',
                            name: 'petugas'
                        },
                        {
                            data: 'tanggalPinjam',
                            name: 'tanggalPinjam'
                        },
                        {
                            data: 'tanggalSelesai',
                            name: 'tanggalSelesai'
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
