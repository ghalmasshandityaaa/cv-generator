<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function __construct()
    {
        $this->Experience = new Experience();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'experience' => $this->Experience->getAllData()
        );
        return view('users/experience', $data);
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
            'position'       => 'required',
            'company_name'   => 'required',
            'position_level' => 'required',
            'salary'         => 'required',
            'country'        => 'required',
            'start_month'    => 'required',
            'start_year'     => 'required',
            'end_month'      => 'required',
            'end_year'       => 'required',
            'description'    => 'required',
        ];
        $messages = [
            'position.required'       => 'please enter the position first',
            'company_name.required'   => 'please enter the company_name first',
            'position_level.required' => 'please enter the position_level first',
            'salary.required'         => 'please enter the salary first',
            'country.required'        => 'please enter the country first',
            'start_month.required'    => 'please enter the start_month first',
            'start_year.required'     => 'please enter the start_year first',
            'end_month.required'      => 'please enter the end_month first',
            'end_year.required'       => 'please enter the end_year first',
            'description.required'    => 'please enter the description first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to add experience.');
        }

        $data = array(
            'jabatan'      => Request()->position,
            'perusahaan'   => Request()->company_name,
            'gaji'         => Request()->salary,
            'negara'       => Request()->country,
            'jns_karyawan' => Request()->position_level,
            'gaji'         => Request()->salary,
            'bln_mulai'    => Request()->start_month,
            'thn_mulai'    => Request()->start_year,
            'bln_selesai'  => Request()->end_month,
            'thn_selesai'  => Request()->end_year,
            'deskripsi'    => Request()->description,
            'created_at'   => date('Y-m-d N:i:s'),
            'updated_at'   => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Experience->insert($data);
        return redirect('experience')->with('message', 'Congratulations! Success to add experience.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function edit(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'position'       => 'required',
            'company_name'   => 'required',
            'position_level' => 'required',
            'salary'         => 'required',
            'country'        => 'required',
            'start_month'    => 'required',
            'start_year'     => 'required',
            'end_month'      => 'required',
            'end_year'       => 'required',
            'description'    => 'required',
        ];
        $messages = [
            'position.required'       => 'please enter the position first',
            'company_name.required'   => 'please enter the company_name first',
            'position_level.required' => 'please enter the position_level first',
            'salary.required'         => 'please enter the salary first',
            'country.required'        => 'please enter the country first',
            'start_month.required'    => 'please enter the start_month first',
            'start_year.required'     => 'please enter the start_year first',
            'end_month.required'      => 'please enter the end_month first',
            'end_year.required'       => 'please enter the end_year first',
            'description.required'    => 'please enter the description first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to update experience.');
        }

        $data = array(
            'jabatan'      => Request()->position,
            'perusahaan'   => Request()->company_name,
            'gaji'         => Request()->salary,
            'negara'       => Request()->country,
            'jns_karyawan' => Request()->position_level,
            'gaji'         => Request()->salary,
            'bln_mulai'    => Request()->start_month,
            'thn_mulai'    => Request()->start_year,
            'bln_selesai'  => Request()->end_month,
            'thn_selesai'  => Request()->end_year,
            'deskripsi'    => Request()->description,
            'updated_at'   => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Experience->updateData($data, $id);
        return redirect('experience')->with('message', 'Congratulations! Success to update experience.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$this->Experience->getDataById($id)) {
            abort('404');
        }

        $this->Experience->deleteData($id);
        return redirect('experience')->with('message', 'Congratulations! Data deleted successfully.');
    }
}
