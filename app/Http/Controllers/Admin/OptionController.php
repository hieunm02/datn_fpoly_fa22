<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Option;
use App\Models\OptionDetail;
use App\Models\ProductOptionDetail;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::all();
        $data = [];
        foreach ($options as $item) {
            $option_details = OptionDetail::where('option_id', '=', $item->id)->get();
            $data[] = [
                'options' => $item,
                'option_details' => $option_details
            ];
        }
        // dd($data);
        $title = "Danh sách thuộc tính";
        $obj_name = "thuộc tính";

        return view('admin.options.index', compact('title', 'data', 'obj_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm mới thuộc tính";
        return view('admin.options.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionRequest $request)
    {
        $option = new Option();
        $option->fill($request->all());
        // dd($option);
        $option->save();
        return redirect()->route('options.index');
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
        $option = Option::find($id);
        // dd($option);
        $option->name = $request->name;
        $option->save();
        return redirect()->route('options.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $option = Option::find($id);
        $option->delete();
        $option_details = OptionDetail::select('id')->where('option_id', $id)->get();
        $obj_op_details = new OptionDetail();
        $obj_op_details->destroy($option_details);

        $product_option_details = ProductOptionDetail::select('id')->where('option_id', $id)->get();
        $obj_prd_op_details = new ProductOptionDetail();
        $obj_prd_op_details->destroy($product_option_details);

        return response()->json(['model' => $option]);
    }
}
