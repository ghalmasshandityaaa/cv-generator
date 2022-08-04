<?php

namespace App\Http\Controllers;

use App\Models\Trainings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TrainingsController extends Controller
{
    public function __construct()
    {
        $this->Trainings = new Trainings();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'trainings' => $this->Trainings->getAllData()
        );
        return view('users/training', $data);
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
            'training'    => 'required',
            'organizer'   => 'required',
            'start_date'  => 'required',
            'end_date'    => 'required',
        ];
        $messages = [
            'training.required'   => 'please enter the training title first',
            'organizer.required'  => 'please enter the organizer first',
            'start_date.required' => 'please enter the start_date first',
            'end_date.required'   => 'please enter the start_year first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to add training.');
        }

        $data = array(
            'nama_pelatihan' => Request()->training,
            'penyelenggara'  => Request()->organizer,
            'tgl_mulai'      => Request()->start_date,
            'tgl_selesai'    => Request()->end_date,
            'created_at'     => date('Y-m-d N:i:s'),
            'updated_at'     => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Trainings->insert($data);
        return redirect('trainings')->with('message', 'Congratulations! Success to add training.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function show(Trainings $trainings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainings $trainings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'training'    => 'required',
            'organizer'   => 'required',
            'start_date'  => 'required',
            'end_date'    => 'required',
        ];
        $messages = [
            'training.required'   => 'please enter the training title first',
            'organizer.required'  => 'please enter the organizer first',
            'start_date.required' => 'please enter the start_date first',
            'end_date.required'   => 'please enter the start_year first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to update training.');
        }

        $data = array(
            'nama_pelatihan' => Request()->training,
            'penyelenggara'  => Request()->organizer,
            'tgl_mulai'      => Request()->start_date,
            'tgl_selesai'    => Request()->end_date,
            'updated_at'     => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Trainings->updateData($data, $id);
        return redirect('trainings')->with('message', 'Congratulations! Success to update training.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->Trainings->getDataById($id)) {
            abort('404');
        }

        $this->Trainings->deleteData($id);
        return redirect('trainings')->with('message', 'Congratulations! Data deleted successfully.');
    }
}
