<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->Activity = new Activity();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'activity' => $this->Activity->getAllData()
        );
        return view('users/activity', $data);
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
        $rules = [
            'organization' => 'required',
            'role'         => 'required',
            'start_month'  => 'required',
            'start_year'   => 'required',
            'description'  => 'required',
        ];
        $messages = [
            'organization.required' => 'please enter the organization first',
            'role.required'         => 'please enter the role first',
            'start_month.required'  => 'please enter the start_month first',
            'start_year.required'   => 'please enter the start_year first',
            'description.required'  => 'please enter the description first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to add activity.');
        }

        $data = array(
            'organisasi'  => Request()->organization,
            'peran'       => Request()->role,
            'bln_mulai'   => Request()->start_month,
            'thn_mulai'   => Request()->start_year,
            'bln_selesai' => Request()->end_month,
            'thn_selesai' => Request()->end_year,
            'deskripsi'   => Request()->description,
            'created_at'  => date('Y-m-d N:i:s'),
            'updated_at'  => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Activity->insert($data);
        return redirect('activity')->with('message', 'Congratulations! Success to add activity.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'organization' => 'required',
            'role'         => 'required',
            'start_month'  => 'required',
            'start_year'   => 'required',
            'description'  => 'required',
        ];
        $messages = [
            'organization.required' => 'please enter the organization first',
            'role.required'         => 'please enter the role first',
            'start_month.required'  => 'please enter the start_month first',
            'start_year.required'   => 'please enter the start_year first',
            'description.required'  => 'please enter the description first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to update activity.');
        }

        $data = array(
            'organisasi'  => Request()->organization,
            'peran'       => Request()->role,
            'bln_mulai'   => Request()->start_month,
            'thn_mulai'   => Request()->start_year,
            'bln_selesai' => Request()->end_month,
            'thn_selesai' => Request()->end_year,
            'deskripsi'   => Request()->description,
            'updated_at'  => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Activity->updateData($data, $id);
        return redirect('activity')->with('message', 'Congratulations! Success to update activity.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->Activity->getDataById($id)) {
            abort('404');
        }

        $this->Activity->deleteData($id);
        return redirect('activity')->with('message', 'Congratulations! Data deleted successfully.');
    }
}
