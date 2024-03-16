<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionsDetail;
use App\Models\Transactions;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transactions = Transactions::with('details')->get();
        // dd($transactions);
        return view('transaksi.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('transaksi.transaksi-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make(request()->all(), [
            'no_transaksi' => 'required|unique:transactions,no_transaction',
            'date_transaksi' => 'required|date',
            'item.*' => 'required',
            'quantity.*' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        } else {
            // Simpan data transaksi
            $transaction = Transactions::create([
                'no_transaction' => $request->input('no_transaksi'),
                'transaction_date' => $request->input('date_transaksi'),
            ]);

            // Simpan detail item transaksi
            $items = $request->input('item');
            $quantities = $request->input('quantity');
            foreach ($items as $index => $item) {
                $transaction->details()->create([
                    'item' => $item,
                    'quantity' => $quantities[$index],
                ]);
            }
            return redirect()->route('transaksi.index')->with('msg', "Data Berhasil Disimpan");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $transaksi = Transactions::with('details')->findOrFail($id);
        return view('transaksi.transaksi-update', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make(request()->all(), [
            'no_transaksi' => 'required|unique:transactions,no_transaction,' . $id,
            'date_transaksi' => 'required|date',
            'item.*' => 'required',
            'quantity.*' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        } else {

            // Cari transaksi berdasarkan ID
            $transaction = Transactions::findOrFail($id);

            // Perbarui data transaksi
            $transaction->update([
                'no_transaction' => $request->input('no_transaksi'),
                'transaction_date' => $request->input('date_transaksi'),
            ]);

            // Perbarui detail item transaksi
            $items = $request->input('item');
            $quantities = $request->input('quantity');
            $transaction->details()->delete(); // Hapus detail transaksi yang sudah ada
            foreach ($items as $index => $item) {
                $transaction->details()->create([
                    'item' => $item,
                    'quantity' => $quantities[$index],
                ]);
            }

            return redirect()->route('transaksi.index')->with('msg', "Data Berhasil Diubah");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // dd($id);
        $transaction = Transactions::findOrFail($id);
        // Hapus detail item transaksi terlebih dahulu
        $transaction->details()->delete();
        // Hapus transaksi itu sendiri
        $transaction->delete();
        return redirect()->route('transaksi.index')->with('msg', "Data Berhasil Dih");
    }
}
