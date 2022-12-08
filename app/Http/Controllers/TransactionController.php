<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaction.daftarTransaksi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        $collections = Collection::where('jumlahSisa', '>', 0)->get();
        return view('transaction.transaksiTambah', compact('collections', 'users'));

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
            'idPeminjam' => 'required|numeric|gt:0',
            'koleksi' => 'array',
            'koleksi.0' => 'required|numeric|gt:0',
            'koleksi.*' => 'numeric',
        ]);

        $transaction = Transaction::create([
            'userIdPetugas' => Auth::user()->id,
            'userIdPeminjam' => $request->idPeminjam,
            'tanggalPinjam' => Carbon::now()->toDateString(),
        ]);

        foreach ($request->koleksi as $koleksi) {
            if ($koleksi > 0) {
                DetailTransaction::create([
                    'transactionId' => $transaction->id,
                    'collectionId' => $koleksi,
                    'status' => 1,
                ]);
                Collection::find($koleksi)->decrement('jumlahSisa');
                Collection::find($koleksi)->increment('jumlahKeluar');
            }
        }

        return to_route('transaksi')->with('status', 'Peminjaman berhasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transactions = DB::table('transactions as t')
            ->select('t.id as id',
                'u1.fullname as fullnamePeminjam',
                'u2.fullname as fullnamePetugas',
                't.tanggalPinjam',
                'tanggalSelesai')
            ->join('users as u1', 't.userIdPeminjam', '=', 'u1.id')
            ->join('users as u2', 't.userIdPetugas', '=', 'u2.id')
            ->where('t.id', $transaction->id)
            ->orderBy('t.tanggalPinjam', 'asc')
            ->first();
        return view('transaction.transaksiView', compact('transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function getAllTransactions()
    {
        $transaction = DB::table('transactions as t')
            ->select(
                't.id as id',
                'u1.fullname as peminjam',
                'u2.fullname as petugas',
                'tanggalPinjam as tanggalPinjam',
                'tanggalSelesai as tanggalSelesai'
            )
            ->join('users as u1', 'userIdPeminjam', '=', 'u1.id')
            ->join('users as u2', 'userIdPetugas', '=', 'u2.id')
            ->orderBy('tanggalPinjam', 'asc')
            ->get();

        return DataTables::of($transaction)
            ->addColumn('action', function ($transaction) {
                $html = '
                <a href="' . route('transactionView', $transaction->id) . '">
                <i class="fas fa-edit"></i>
                </a>';
                return $html;
            })
            ->make(true);
    }
}
