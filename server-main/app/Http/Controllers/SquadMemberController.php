<?php

namespace App\Http\Controllers;

use App\Models\Squad;
use App\Models\SquadMember;
use HttpHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SquadMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store(Request $request, $squadId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'dob' => 'required',
            'phone' => 'required',
            'picture' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails())
            return HttpHelper::validationError($validator->errors(), "Validation error");

        $squad = Squad::find($squadId);
        $data = $request->all();
        $image = $request->file('picture');
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("squad-members"), $filename);
            $data['picture'] = $filename;
        }
        $data['squad_id'] = $squadId;
        $squad = SquadMember::create($data);
        return HttpHelper::responseJson(200, "Success insert squad member", $squad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SquadMember  $squadMember
     * @return \Illuminate\Http\Response
     */
    public function show(SquadMember $squadMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SquadMember  $squadMember
     * @return \Illuminate\Http\Response
     */
    public function edit(SquadMember $squadMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SquadMember  $squadMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $squadId, $squadMemberId)
    {
        $validator = Validator::make($request->all(), [
        ]);

        if ($validator->fails())
            return HttpHelper::validationError($validator->errors(), "Validation error");
        $squadMember = SquadMember::find($squadMemberId);
        $data = $request->all();
        $image = $request->file('picture');
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("squad-members"), $filename);
            $data['picture'] = $filename;
        }
        $update = $squadMember->update($data);
        return HttpHelper::responseJson(200, "Success update squad member", $update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SquadMember  $squadMember
     * @return \Illuminate\Http\Response
     */
    public function destroy($squadId, $squadMemberId)
    {
        SquadMember::find($squadMemberId)->delete();
    }
}
