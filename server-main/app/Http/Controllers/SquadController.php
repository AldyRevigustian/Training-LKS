<?php

namespace App\Http\Controllers;

use App\Models\Squad;
use HttpHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SquadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $squads = Squad::all();
        return HttpHelper::responseJson(200, "Success get squad", $squads);
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
            'logo' => 'required',
            'name' => 'required',
            'description' => 'required',
            'achievements' => 'required',
        ]);

        if ($validator->fails())
            return HttpHelper::validationError($validator->errors(), "Validation error");

        $image = $request->file('logo');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $data = $request->all();
        $data['logo'] = $filename;
        $image->move(public_path("squads"), $filename);

        $squad = Squad::create($data);
        return HttpHelper::responseJson(201, "Success create squad", $squad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Squad  $squad
     * @return \Illuminate\Http\Response
     */
    public function show($squadId)
    {
        $squad = Squad::with('members')->where('id', $squadId)->first();
        return HttpHelper::responseJson(200, "Success get squad", $squad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Squad  $squad
     * @return \Illuminate\Http\Response
     */
    public function edit(Squad $squad)
    {
        return HttpHelper::responseJson(200, "Success get squad data", $squad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Squad  $squad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Squad $squad)
    {
        $validator = Validator::make($request->all(), [
        ]);

        if ($validator->fails())
            return HttpHelper::validationError($validator->errors(), "Validation error");

        $image = $request->file('logo');
        $data = $request->all();
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $data['logo'] = $filename;
            $image->move(public_path("squads"), $filename);
        }

        $squad->update($data);
        return HttpHelper::responseJson(201, "Success update squad", $squad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Squad  $squad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Squad $squad)
    {
        $squad->delete();

        return response('', 204);
    }
}
