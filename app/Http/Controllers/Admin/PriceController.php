<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRequest;
use App\Models\Price;
use App\Services\Prices\PriceServices;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    protected $priceService;

    public function __construct(PriceServices $priceService)
    {
        $this->priceService = $priceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = $this->priceService->getAll();
        return view('admin.prices.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prices = $this->priceService->getPrice();
        return view('admin.prices.create', compact('prices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PriceRequest $request)
    {
        $this->priceService->create($request);
        return redirect()->route('prices.index');
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
        $prices = Price::find($id);
        return view('admin.prices.edit', compact('prices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PriceRequest $request, $id)
    {
        $prices = Price::find($id);
        $this->priceService->update($request, $id);
        return redirect()->route('prices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::find($id);
        $this->priceService->destroyId($id);
        return response()->json(['model' => $price]);
    }
}
