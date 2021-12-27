<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('cashier.index', [
            'products' => $products
        ]);
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
        $transaction = $request->validate([
            'customer' => 'required',
        ]);

        $item = $request->validate([
            'product_id' => 'required|numeric',
            'product_quantity' => 'required|numeric',
            'customer' => 'required'
        ]);

        $date = new Carbon;

        $price = $request->product_price;
        $quantity = $request->product_quantity;
        $total = $price * $quantity;
        $total_price = null;

        if ($total >= 50000) {
            $diskon = $total * 10 / 100;
            $total_price = $total - $diskon;
        }

        // $transaction['total_price'] = $total_price;
        // $transaction['customer'] = $request->customer;
        // $transaction['id_admin'] = auth()->user()->id;
        // $transaction['created_at'] = $date->now();

        $transaction = Transaction::create([
            'total_price' => $total_price,
            'customer' => $request->customer,
            'id_admin' => auth()->user()->id,
            'created_at' => $date->now()
        ]);

        $item['id_transaction'] = $transaction->id;
        $item['id_product'] = $request->product_id;
        $item['quantity'] = $quantity;
        $item['subtotal_price'] = $total;
        $item['created_at'] = $date->now();

        TransactionDetail::create($item);

        return redirect()->route('cashier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
