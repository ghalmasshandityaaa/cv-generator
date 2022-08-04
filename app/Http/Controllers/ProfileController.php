<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Profile;
use App\Models\Resume;
use App\Models\Skills;
use App\Models\Trainings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->Activity   = new Activity();
        $this->Education  = new Education();
        $this->Experience = new Experience();
        $this->Language   = new Language();
        $this->Resume     = new Resume();
        $this->Skills     = new Skills();
        $this->Trainings  = new Trainings();
        $this->Profile    = new Profile();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users/profile');
    }

    public function profile()
    {
        return view('users/profile');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = array(
            'activity' => $this->Activity->getAllData(),
            'education' => $this->Education->getAllData(),
            'experience' => $this->Experience->getAllData(),
            'language' => $this->Language->getAllData(),
            'resume' => $this->Resume->getAllData(),
            'skills' => $this->Skills->getAllData(),
            'trainings' => $this->Trainings->getAllData(),
            'profile' => $this->Profile->getAllData()
        );

        return view('users/preview', $data);
    }

    public function export()
    {
        $data = array(
            'activity' => $this->Activity->getAllData(),
            'education' => $this->Education->getAllData(),
            'experience' => $this->Experience->getAllData(),
            'language' => $this->Language->getAllData(),
            'resume' => $this->Resume->getAllData(),
            'skills' => $this->Skills->getAllData(),
            'trainings' => $this->Trainings->getAllData(),
            'profile' => $this->Profile->getAllData()
        );

        return view('users/export', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'     => 'required',
            'country'  => 'required',
            'province' => 'required',
            'city'     => 'required',
            'address'  => 'required',
            'birth'    => 'required',
            'gender'   => 'required',
            'phone'    => 'required',
            'summary'  => 'required',
        ];
        $messages = [
            'name.required'     => 'please enter the name first',
            'country.required'  => 'please enter the country first',
            'province.required' => 'please enter the province first',
            'city.required'     => 'please enter the city first',
            'address.required'  => 'please enter the address first',
            'birth.required'    => 'please enter the birth first',
            'gender.required'   => 'please enter the gender first',
            'phone.required'    => 'please enter the phone first',
            'summary.required'  => 'please enter the summary first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to add experience.');
        }

        $data = array(
            'name'       => Request()->name,
            'negara'     => Request()->country,
            'provinsi'   => Request()->province,
            'kota'       => Request()->city,
            'alamat'     => Request()->address,
            'ttl'        => Request()->birth,
            'jk'         => Request()->gender,
            'telepon'    => Request()->phone,
            'ringkasan'  => Request()->summary,
            'updated_at' => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->Profile->updateData($data, $id);
        return redirect('profile')->with('message', 'Congratulations! Success to add experience.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
