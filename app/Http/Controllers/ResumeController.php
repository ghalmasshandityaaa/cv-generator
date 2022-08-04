<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->Resume = new Resume();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'resume' => $this->Resume->getAllData()
        );
        // dd($data);
        return view('users/resume', $data);
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
            'resume' => 'required|max:10120|mimes:pdf,doc,docx,rtf',
        ];
        $messages = [
            'resume.required' => 'please enter the resume first',
            'resume.max'      => 'Maximum file upload 10MB',
            'resume.mimes'    => 'Acceptable file types are DOC, DOCX, PDF, and RTF',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to add resume.');
        }

        $file     = Request()->resume;
        $fileName = $file->getClientOriginalName() . '.' . $file->extension();
        $file->move(public_path('assets/resume/'), $fileName);

        $data = array(
            'cv'         => $fileName,
            'created_at' => date('Y-m-d N:i:s'),
            'updated_at' => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Resume->insert($data);
        return redirect('resume')->with('message', 'Congratulations! Success to add resume.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function show(Resume $resume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit(Resume $resume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'resume' => 'required|max:10120|mimes:pdf,doc,docx,rtf',
        ];
        $messages = [
            'resume.required' => 'please enter the resume first',
            'resume.max'      => 'Maximum file upload 10MB',
            'resume.mimes'    => 'Acceptable file types are DOC, DOCX, PDF, and RTF',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to update resume.');
        }

        $file     = Request()->resume;
        $fileName = $file->getClientOriginalName() . '.' . $file->extension();
        $file->move(public_path('assets/resume/'), $fileName);

        $data = array(
            'cv'         => $fileName,
            'updated_at' => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Resume->updateData($data, $id);
        return redirect('resume')->with('message', 'Congratulations! Success to update resume.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->Resume->getDataById($id)) {
            abort('404');
        }

        $this->Resume->deleteData($id);
        return redirect('resume')->with('message', 'Congratulations! Resume deleted successfully.');
    }
}
