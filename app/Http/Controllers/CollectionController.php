<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('koleksi.daftarKoleksi', ['collection' => Collection::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('koleksi.registrasi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:collections'],
            'jenis' => ['required', 'gt:0'],
            'jumlah' => ['required', 'gt:0'],
        ],
            [
                'nama.unique' => 'Nama koleksi tersebut sudah ada',
            ]);

        $koleksi = [
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlahAwal' => $request->jumlah,
            'jumlahSisa' => $request->jumlah,
            'jumlahKeluar' => 0,
        ];

        DB::table('collections')->insert($koleksi);
        return view('koleksi.daftarKoleksi');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        return view('koleksi.infoKoleksi', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $request->validate([
            'nama' => 'required|string',
            'jenis' => 'required|numeric|gt:0',
            'jumlahKeluar' => 'required|gt:0',
        ]);

        $collection->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlahSisa' => $collection->jumlahAwal - $request->jumlahKeluar,
            'jumlahKeluar' => $request->jumlahKeluar,
        ]);

        return to_route("koleksi");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        //
    }

    public function getAllCollections(Request $request)
    {
        if ($request->ajax()) {
            $collection = DB::table('collections')
                ->select(
                    'id as id',
                    'nama as judul',
                    DB::raw('
            (CASE
            WHEN jenis="1" THEN "Buku"
            WHEN jenis="2" THEN "Majalah"
            WHEN jenis="3" THEN "Cakram Digital"
            END) AS jenis
            '),
                    'jumlahAwal as jumlahAwal',
                    'jumlahSisa as jumlahSisa',
                    'jumlahKeluar as jumlahKeluar',
                )
                ->orderBy('judul', 'asc')
                ->get();

            return DataTables::of($collection)
                ->addColumn('action', function ($collection) {
                    $html = '
            <a href ="' . route('koleksiView', $collection->id) . '">
            <i class="fa fa-edit"></i>
            </a>';
                    return $html;
                })
                ->make(true);
        }
    }

}
