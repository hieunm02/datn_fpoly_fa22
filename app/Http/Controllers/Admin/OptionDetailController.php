<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionDetail;
use Illuminate\Http\Request;

class OptionDetailController extends Controller
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
    public function create(Request $request)
    {
        $option_id = $request->keys()[0];
        $title = 'Thêm danh sách';
        return view('admin.option-details.create', compact('title', 'option_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(array_search(null, $request->value), array_search(null, $request->quantity));
        if (array_search(null, $request->value) == false && array_search(null, $request->price) == false) {
            $obj = new OptionDetail();
            $array = [];
            $option_details = array_combine($request->value, $request->price);
            // dd($option_details);
            foreach ($option_details as $key => $data) {
                $array[] = [
                    'value' => $key,
                    'price' => $data,
                    'option_id' => $request->option_id,
                ];
            }

            $obj->insert($array);
        } else {
            return redirect()->back()->with('message', 'Vui lòng nhập đúng và đủ các trường thông tin !!!');
        }

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
