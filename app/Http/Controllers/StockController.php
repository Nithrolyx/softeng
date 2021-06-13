<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all();
        return Inertia::render('Stock/Index',
            ['stock' => $stocks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Stock/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate(

            [
                'id' => 'required|numeric|unique:stocks',
                'stock_category_id' => 'required',
                'description' => 'required',
                'uom' => 'required',
                'barcode' => 'required',
                'discontinued' => 'required',
                

            ]

        );

        $model = new Stock();
        $model->id = $request->id;
        $model->stock_category_id = $request->stock_category_id;
        $model->description = $request->description;
        $model->uom = $request->uom;
        $model->barcode = $request->barcode;
        $model->discontinued = $request->discontinued;

        $model->save();

        return redirect()->back()->with('success', 'New Stock Added!');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model =Stock::find($id);

        return Inertia::render('Stock/View',['model'=>$model]);
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
        $validate = $request->validate(

            [
               
                'stock_category_id' => 'required',
                'description' => 'required',
                'uom' => 'required',
                'barcode' => 'required',
                'discontinued' => 'required',

            ]

        );


        $model = Stock::find($id);

        $model->update($validate);
    
        return redirect()->back()->with('success', 'Stock Updated');
      //return Redirect::route('stock.index')->with("Success", "Stock Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //use try since an error migth occur
       try{
        Stock::find($id)->delete();
        return Redirect::route('stock.index')->with('success', 'Stocks deleted.');
       }catch (\Exception$e) {
     
        return Redirect::route('stock.index')->with('error', $e->getMessage());

    }
    }
}
