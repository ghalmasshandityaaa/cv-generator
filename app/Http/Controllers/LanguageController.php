<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->Language = new Language();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'language' => $this->Language->getAllData()
        );
        return view('users/language', $data);
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
            'language' => 'required',
            'level' => 'required',
        ];
        $messages = [
            'language.required' => 'please enter the language first',
            'level.required' => 'please enter the level first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to add language.');
        }

        $data = array(
            'bahasa' => Request()->language,
            'tingkat'      => Request()->level,
            'created_at'   => date('Y-m-d N:i:s'),
            'updated_at'   => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Language->insert($data);
        return redirect('language')->with('message', 'Congratulations! Success to add language.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'language' => 'required',
            'level' => 'required',
        ];
        $messages = [
            'language.required' => 'please enter the language first',
            'level.required' => 'please enter the level first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to update language.');
        }

        $data = array(
            'bahasa'     => Request()->language,
            'tingkat'    => Request()->level,
            'updated_at' => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Language->updateData($data, $id);
        return redirect('language')->with('message', 'Congratulations! Success to update language.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->Language->getDataById($id)) {
            abort('404');
        }

        $this->Language->deleteData($id);
        return redirect('language')->with('message', 'Congratulations! Data deleted successfully.');
    }
}
