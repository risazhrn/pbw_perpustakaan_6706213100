<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DetailTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        if($request->status == 1){

        } else {
            $affected = DB::table('detail_transactions')
            ->where('id', $request->idDetailTransactions)
            ->update([
                'status' => $request->status,
                'tanggalKembali' => Carbon::now()->toDateString(),
            ]);

            if ($request->status == 2) {
                DB::table('collections')->where('id', $request->idKoleksi)->increment('jumlahSisa');
                DB::table('collections')->where('id', $request->idKoleksi)->decrement('jumlahKeluar');
            } else {
                DB::table('collections')->where('id', $request->idKoleksi)->increment('jumlahSisa');
            }
        }
        $transaction = Transaction::where('id', '=', $request->idTransaksi)->first();
        return redirect('transaksiView/'.$request->idTransaksi)->with('transaction', $transaction);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailTransaction $detailTransaction)
    {
        //
    }

    public function getAllDetailTransactions(Transaction $transaction)
    {
        $detailTransaction = DB::table('detail_transactions as dt')
            ->select('dt.id',
                'dt.tanggalKembali',
                't.tanggalPinjam',
                'dt.status as statusType',
                DB::raw('(CASE WHEN dt.status = 1 THEN "Pinjam"
                WHEN dt.status = 2 THEN "Kembali"
                WHEN dt.status = 3 THEN "Hilang"
                END) as status',
                )
                , 'c.nama as koleksi')
            ->join('collections as c', 'dt.collectionId', '=', 'c.id')
            ->join('transactions as t', 'dt.transactionId', '=', 't.id')
            ->where('dt.transactionId', $transaction->id)->get();

        return DataTables::of($detailTransaction)->addColumn('action', function ($detail_transaction) {
            $html = '';
            if ($detail_transaction->statusType == '1') {
                $html = '<a href="' . route('detailTransactionKembalikan', $detail_transaction->id) . '"><i class="fas fa-edit"></i></a>';
            }
            return $html;
        })->make(true);
    }

    public function detailTransactionKembalikan(DetailTransaction $detailTransaction)
    {
        $detailTransactions = DB::table('detail_transactions as dt')
            ->select('t.id as idTransaksi',
                'dt.id',
                'dt.tanggalKembali',
                't.tanggalPinjam',
                'dt.status',
                'uPinjam.fullname as namaPeminjam',
                'uPetugas.fullname as namaPetugas',
                'c.id as idKoleksi' ,
                'c.nama as koleksi'
            )
            ->join('collections as c', 'dt.collectionId', '=', 'c.id')
            ->join('transactions as t', 'dt.transactionId', '=', 't.id')
            ->join('users as uPinjam', 't.userIdPeminjam', '=', 'uPinjam.id')
            ->join('users as uPetugas', 't.userIdPetugas', '=', 'uPetugas.id')
            ->where('dt.id', '=', $detailTransaction->id)->first();

        return view('detailTransaction.detailTransactionKembalikan', compact('detailTransactions'));
    }
}
