<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Thumb\UploadServices;
use Illuminate\Http\Request;

class UploadThumbController extends Controller
{
    protected $upload;

    public function __construct(UploadServices $upload){
        $this->upload = $upload;
    }

    public function store(Request $request){
        $url = $this->upload->store($request);
        if($url != false){
            return response()->json([
                'error' => false,
                'url' => $url
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
