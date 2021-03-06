<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Product::all();

        return view('product.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $item = $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric'
        ]);

        $date = new Carbon;
        $item['product_name'] = $product_name = $request->product_name;
        $item['product_price'] = $request->product_price;
        $item['product_code'] = str_replace(':', '', $date->setTimezone('Asia/Jakarta')->toTimeString()) . '-' . Str::slug($product_name);
        $item['created_at'] = $date->now();

        Product::create($item);
        return redirect()->route('product.index');
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
        $item = $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric'
        ]);

        $date = new Carbon;
        $item['product_name'] = $product_name = $request->product_name;
        $item['product_price'] = $request->product_price;
        $item['product_code'] = str_replace(':', '', $date->setTimezone('Asia/Jakarta')->toTimeString()) . '-' . Str::slug($product_name);
        $item['created_at'] = $date->now();

        dd($item);

        Product::where('id', $id)->update($item);
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
