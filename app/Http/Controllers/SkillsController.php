<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SkillsController extends Controller
{
    public function __construct()
    {
        $this->Skills = new Skills();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'skills' => $this->Skills->getAllData()
        );
        return view('users/skill', $data);
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
            'skill' => 'required',
            'level' => 'required',
        ];
        $messages = [
            'skill.required' => 'please enter the skill first',
            'level.required' => 'please enter the level first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to add skill.');
        }

        $data = array(
            'keterampilan' => Request()->skill,
            'tingkat'      => Request()->level,
            'created_at'   => date('Y-m-d N:i:s'),
            'updated_at'   => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Skills->insert($data);
        return redirect('skills')->with('message', 'Congratulations! Success to add skill.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skills  $skills
     * @return \Illuminate\Http\Response
     */
    public function show(Skills $skills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skills  $skills
     * @return \Illuminate\Http\Response
     */
    public function edit(Skills $skills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skills  $skills
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'skill' => 'required',
            'level' => 'required',
        ];
        $messages = [
            'skill.required' => 'please enter the skill first',
            'level.required' => 'please enter the level first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to update skill.');
        }

        $data = array(
            'keterampilan' => Request()->skill,
            'tingkat'      => Request()->level,
            'created_at'   => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Skills->updateData($data, $id);
        return redirect('skills')->with('message', 'Congratulations! Success to update skill.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skills  $skills
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->Skills->getDataById($id)) {
            abort('404');
        }

        $this->Skills->deleteData($id);
        return redirect('skills')->with('message', 'Congratulations! Data deleted successfully.');
    }
}
