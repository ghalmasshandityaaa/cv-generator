<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->Education = new Education();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'education' => $this->Education->getAllData()
        );
        // dd($data);
        return view('users/education', $data);
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
            'university'    => 'required',
            'qualification' => 'required',
            'major'         => 'required',
            'start_month'   => 'required',
            'start_year'    => 'required',
            'end_month'     => 'required',
            'end_year'      => 'required',
            'description'   => 'required',
            'gpa'           => 'required',
        ];
        $messages = [
            'university.required'    => 'Silahkan isi university terlebih dahulu',
            'qualification.required' => 'Silahkan isi qualification terlebih dahulu',
            'major.required'         => 'Silahkan isi major terlebih dahulu',
            'start_month.required'   => 'Silahkan isi start_month terlebih dahulu',
            'start_year.required'    => 'Silahkan isi start_year terlebih dahulu',
            'end_month.required'     => 'Silahkan isi end_month terlebih dahulu',
            'end_year.required'      => 'Silahkan isi end_year terlebih dahulu',
            'description.required'   => 'Silahkan isi description terlebih dahulu',
            'gpa.required'           => 'Silahkan isi gpa terlebih dahulu',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to add education.');
        }

        $data = array(
            'tingkat'     => Request()->qualification,
            'universitas' => Request()->university,
            'jurusan'     => Request()->major,
            'bln_mulai'   => Request()->start_month,
            'thn_mulai'   => Request()->start_year,
            'bln_selesai' => Request()->end_month,
            'thn_selesai' => Request()->end_year,
            'deskripsi'   => Request()->description,
            'ipk'         => Request()->gpa,
            'created_at'  => date('Y-m-d N:i:s'),
            'updated_at'  => date('Y-m-d N:i:s'),
        );
        $this->Education->insert($data);
        return redirect('education')->with('message', 'Congratulations! Success to add education.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'university'    => 'required',
            'qualification' => 'required',
            'major'         => 'required',
            'start_month'   => 'required',
            'start_year'    => 'required',
            'end_month'     => 'required',
            'end_year'      => 'required',
            'description'   => 'required',
            'gpa'           => 'required',
        ];
        $messages = [
            'university.required'    => 'Silahkan isi university terlebih dahulu',
            'qualification.required' => 'Silahkan isi qualification terlebih dahulu',
            'major.required'         => 'Silahkan isi major terlebih dahulu',
            'start_month.required'   => 'Silahkan isi start_month terlebih dahulu',
            'start_year.required'    => 'Silahkan isi start_year terlebih dahulu',
            'end_month.required'     => 'Silahkan isi end_month terlebih dahulu',
            'end_year.required'      => 'Silahkan isi end_year terlebih dahulu',
            'description.required'   => 'Silahkan isi description terlebih dahulu',
            'gpa.required'           => 'Silahkan isi gpa terlebih dahulu',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to add education.');
        }

        $data = array(
            'tingkat'     => Request()->qualification,
            'universitas' => Request()->university,
            'jurusan'     => Request()->major,
            'bln_mulai'   => Request()->start_month,
            'thn_mulai'   => Request()->start_year,
            'bln_selesai' => Request()->end_month,
            'thn_selesai' => Request()->end_year,
            'deskripsi'   => Request()->description,
            'ipk'         => Request()->gpa,
            'updated_at'  => date('Y-m-d N:i:s'),
        );
        $this->Education->updateData($data, $id);
        return redirect('education')->with('message', 'Congratulations! Success to update data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$this->Education->getDataById($id)) {
            abort('404');
        }

        $this->Education->deleteData($id);
        return redirect('education')->with('message', 'Congratulations! Data deleted successfully.');
    }
}
