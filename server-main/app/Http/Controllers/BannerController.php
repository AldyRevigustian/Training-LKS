<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use HttpHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();

        return HttpHelper::responseJson(200, "Success get banners", $banners);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails())
            return HttpHelper::validationError($validator->errors(), "Validation error");

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $data = $request->all();
        $data['image'] = $filename;
        $image->move(public_path("banners"), $filename);

        $banner = Banner::create($data);
        return HttpHelper::responseJson(201, "Success create banners", $banner);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return HttpHelper::responseJson(200, "Success get banner to edit", $banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails())
            return HttpHelper::validationError($validator->errors(), "Validation error");

        $image = $request->file('image');
        $data = $request->all();
        if($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $data['image'] = $filename;
            $image->move(public_path("banners"), $filename);
        }

        $banner->update($data);
        return HttpHelper::responseJson(200, "Success update banners", $banner);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return response('', 204);
    }
}
