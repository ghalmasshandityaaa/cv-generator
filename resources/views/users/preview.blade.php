@extends('layouts.master')
@section('title','Preview')
@section('page-name','Preview Profile')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="text-center">
                            <img style="width: 150px" class="profile-user-img img-fluid img-circle" @if (Auth::user()->foto == '') src="{{ asset('assets') }}/dist/img/profile.png" @else src="{{ asset('assets') }}/dist/img/{{ Auth::user()->foto }}" @endif alt="User profile picture">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <a href="/export" target="_blank" style="text-decoration: none; float:right; color:grey;"><i class="nav-icon fas fa-file-import"></i> Print</a>
                    <div class="form-group mt-3">
                        <h3>{{ Auth::user()->name }}</h3>
                        <table border="0">
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-phone text-green mt-1"></i></td>
                                    <td> : </td>
                                    <td> {{ Auth::user()->telepon }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-envelope text-info mt-1"></i></td>
                                    <td> : </td>
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-map-marker-alt text-danger mt-1"></i></td>
                                    <td> : </td>
                                    <td>{{ Auth::user()->alamat }}, {{ Auth::user()->city }}, {{ Auth::user()->province }}, {{ Auth::user()->country }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <strong>Summary</strong><br>
            {{ Auth::user()->ringkasan }}
            <hr>
            <Strong>Work History</Strong><br>
            <table class="table table-bordered table-striped mt-2">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Position Level</th>
                        <th>Start</th>
                        <th>Finish</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($experience as $data)
                    <tr>
                        <td>
                            <strong>{{ $data->perusahaan }}</strong> | <span class="">{{ $data->negara }}</span><br>
                            <span class="text-muted">{{ $data->jabatan }}</span><br>
                            Salary : <span>{{ $data->gaji }}</span><br>
                            <span>{{ $data->deskripsi }}</span>
                        </td>
                        <td>{{ $data->jns_karyawan }}</td>
                        <td>{{ $data->bln_mulai }} - {{ $data->thn_mulai }}</td>
                        <td>{{ $data->bln_selesai }} - {{ $data->thn_selesai }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <Strong>Education</Strong><br>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>University</th>
                        <th>Start</th>
                        <th>Finish</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($education as $data)
                    <tr>
                        <td>
                            <strong>{{ $data->universitas }}</strong><br>
                            <strong class="text-muted">{{ $data->tingkat }} {{ $data->jurusan }}</strong> | GPA : {{ $data->ipk }}
                        </td>
                        <td>{{ $data->bln_mulai }} - {{ $data->thn_mulai }}</td>
                        <td>{{ $data->bln_selesai }} - {{ $data->thn_selesai }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <Strong>Skills</Strong><br>
            <table class="table table-bordered table-striped mt-2">
                <thead>
                    <tr>
                        <th>Skill</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($skills as $data)
                    <tr>
                        <td>{{ $data->keterampilan }}</td>
                        <td>
                            @if ($data->tingkat == 1)
                                Basic
                            @elseif ($data->tingkat == 2)
                                Novice
                            @elseif ($data->tingkat == 3)
                                Intermediate
                            @elseif ($data->tingkat == 4)
                                Advanced
                            @elseif ($data->tingkat == 5)
                                Expert
                            @endif
                            <br>
                            @if ($data->tingkat < 5)
                                @for ($i = 0; $i < $data->tingkat; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = 0; $i < 5-$data->tingkat; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            @else
                                @for ($i = 0; $i < $data->tingkat; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach
                    <tr>
                    </tr>
                </tbody>
                
            </table>
            <hr>
            <Strong>Activities</Strong><br>
            <table class="table table-bordered table-striped mt-2">
                <thead>
                    <tr>
                        <th>Organization</th>
                        <th>Start Date</th>
                        <th>Finish Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activity as $data)
                    <tr>
                        <td>
                            <strong>{{ $data->organisasi }}</strong><br>
                            <span>{{ $data->peran }}</span><br>
                            <span class="text-muted">{{ $data->deskripsi }}</span>
                        </td>
                        <td>{{ $data->bln_mulai }} - {{ $data->thn_mulai }}</td>
                        <td>{{ $data->bln_selesai }} - {{ $data->thn_selesai }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <Strong>Trainings</Strong><br>
            <table class="table table-bordered table-striped mt-2">
                <thead>
                    <tr>
                        <th>Trainings</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainings as $data)
                    <tr>
                        <td>
                            <strong>{{ $data->penyelenggara }}</strong><br>
                            <span class="text-muted"><strong>{{ $data->nama_pelatihan }}</strong></span><br>
                        </td>
                        <td>@php echo date('d F Y', strtotime($data->tgl_mulai)).' - '.date('d F Y', strtotime($data->tgl_selesai)); @endphp</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <Strong>Language</Strong><br>
            <table class="table table-bordered table-striped mt-2">
                <thead>
                    <tr>
                        <th>language</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>
                   
                    @foreach ($language as $data)
                    <tr>
                        <td>{{ $data->bahasa }}</td>
                        <td>
                            @if ($data->tingkat == 1)
                                Basic
                            @elseif ($data->tingkat == 2)
                                Novice
                            @elseif ($data->tingkat == 3)
                                Intermediate
                            @elseif ($data->tingkat == 4)
                                Advanced
                            @elseif ($data->tingkat == 5)
                                Expert
                            @endif
                            <br>
                            @if ($data->tingkat < 5)
                                @for ($i = 0; $i < $data->tingkat; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = 0; $i < 5-$data->tingkat; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            @else
                                @for ($i = 0; $i < $data->tingkat; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            <hr>
        </div>
    </div>
</div>

@endsection

