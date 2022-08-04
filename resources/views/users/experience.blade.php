@extends('layouts.master')
@section('title','Experience')
@section('page-name','Work Experience')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title" style="float: left;"><i class="fas fa-briefcase"> </i> Work Experience </h3>
        <button type="button" class="btn btn-outline-primary btn-sm mt-0" data-toggle="modal" data-target="#add" style="float: right; top:0"><i class="fas fa-plus"></i> Add Experience</button><br>
        <small>Please enter your work experience</small>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Company</th>
                    <th>Position Level</th>
                    <th>Start</th>
                    <th>Finish</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($experience) == 0)
                <tr class="text-center">
                    <td colspan="7" class="text-center">- No Data -</td>
                </tr>
                @endif

                @php
                    $no=1;
                @endphp
                @foreach ($experience as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        <strong>{{ $data->perusahaan }}</strong> | <span class="">{{ $data->negara }}</span><br>
                        <span class="text-muted">{{ $data->jabatan }}</span><br>
                        Salary : <span>{{ $data->gaji }}</span><br>
                        <span>{{ $data->deskripsi }}</span>
                    </td>
                    <td>{{ $data->jns_karyawan }}</td>
                    <td>{{ $data->bln_mulai }} - {{ $data->thn_mulai }}</td>
                    <td>{{ $data->bln_selesai }} - {{ $data->thn_selesai }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#read{{ $data->id }}" style="width:100%"><i class="fas fa-eye"> </i> Detail</button><br>
                        <button type="button" class="btn btn-outline-warning btn-sm mt-1" data-toggle="modal" data-target="#edit{{ $data->id }}" style="width:100%"><i class="fas fa-edit"> </i> Edit</button><br>
                        <button type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="modal" data-target="#delete{{ $data->id }}" style="width:100%"><i class="fas fa-trash"> </i> Delete</button>
                    </td>
                </tr>
                @endforeach
                <tr>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Company</th>
                    <th>Position Level</th>
                    <th>Start</th>
                    <th>Finish</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Add Data -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/experience/add" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add Experience</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position" placeholder="Position" value="{{ old('position') }}">
                        </div>
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company_name" value="{{ old('company_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="qualification">Position Level</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="position_level" value="{{ old('position_level') }}">
                                <option selected="selected" disabled>- Chose Position -</option>
                                <option value="Internship / OJT">Internship / OJT</option>
                                <option value="Entry Level / Junior, Aprentice">Entry Level / Junior, Aprentice</option>
                                <option value="Associate / Supervisor">Associate / Supervisor</option>
                                <option value="Mid-Senior Level / Manager">Mid-Senior Level / Manager</option>
                                <option value="Directior / Executive">Directior / Executive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="salary">Monthly Salary</label>
                            <input type="number" min="0" class="form-control" id="salary" name="salary" placeholder="Salary" value="{{ old('salary') }}">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{ old('country') }}">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="start_month" value="{{ old('start_month') }}">
                                        <option selected="selected" disabled>- Month -</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                    <input type="text" class="form-control mt-1" placeholder="Year" name="start_year" value="{{ old('start_year') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="end_month" value="{{ old('end_month') }}">
                                        <option selected="selected" disabled>- Month -</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                    <input type="text" class="form-control mt-1" placeholder="Year" name="end_year" value="{{ old('end_year') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>

            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit Data -->
@foreach ($experience as $data)
<div class="modal fade" id="edit{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/experience/edit/{{ $data->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-warning text-white">
                    <h4 class="modal-title">Edit Experience</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position" placeholder="Position" value="{{ $data->jabatan }}">
                        </div>
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company_name" value={{ $data->perusahaan }}">
                        </div>
                        <div class="form-group">
                            <label for="qualification">Position Level</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="position_level" value="{{ $data->jns_karyawan }}">
                                <option selected="selected" disabled>- Chose Position -</option>
                                <option @if ($data->jns_karyawan == 'Internship / OJT') selected @endif value="Internship / OJT">Internship / OJT</option>
                                <option @if ($data->jns_karyawan == 'Entry Level / Junior, Aprentice') selected @endif value="Entry Level / Junior, Aprentice">Entry Level / Junior, Aprentice</option>
                                <option @if ($data->jns_karyawan == 'Associate / Supervisor') selected @endif value="Associate / Supervisor">Associate / Supervisor</option>
                                <option @if ($data->jns_karyawan == 'Mid-Senior Level / Manager') selected @endif value="Mid-Senior Level / Manager">Mid-Senior Level / Manager</option>
                                <option @if ($data->jns_karyawan == 'Director / Executive') selected @endif value="Director / Executive">Directior / Executive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="salary">Monthly Salary</label>
                            <input type="number" min="0" class="form-control" id="salary" name="salary" placeholder="Salary" value="{{ $data->gaji }}">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{ $data->negara }}">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="start_month" value="{{ old('start_month') }}">
                                        <option selected="selected" disabled>- Month -</option>
                                        <option @if ($data->bln_mulai == 'January') selected @endif value="January">January</option>
                                        <option @if ($data->bln_mulai == 'February') selected @endif value="February">February</option>
                                        <option @if ($data->bln_mulai == 'March') selected @endif value="March">March</option>
                                        <option @if ($data->bln_mulai == 'April') selected @endif value="April">April</option>
                                        <option @if ($data->bln_mulai == 'May') selected @endif value="May">May</option>
                                        <option @if ($data->bln_mulai == 'June') selected @endif value="June">June</option>
                                        <option @if ($data->bln_mulai == 'July') selected @endif value="July">July</option>
                                        <option @if ($data->bln_mulai == 'August') selected @endif value="August">August</option>
                                        <option @if ($data->bln_mulai == 'September') selected @endif value="September">September</option>
                                        <option @if ($data->bln_mulai == 'October') selected @endif value="October">October</option>
                                        <option @if ($data->bln_mulai == 'November') selected @endif value="November">November</option>
                                        <option @if ($data->bln_mulai == 'December') selected @endif value="December">December</option>
                                    </select>
                                    <input type="text" class="form-control mt-1" placeholder="Year" name="start_year" value="{{ $data->thn_mulai }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="end_month" value="{{ old('end_month') }}">
                                        <option selected="selected" disabled>- Month -</option>
                                        <option @if ($data->bln_selesai == 'January') selected @endif value="January">January</option>
                                        <option @if ($data->bln_selesai == 'February') selected @endif value="February">February</option>
                                        <option @if ($data->bln_selesai == 'March') selected @endif value="March">March</option>
                                        <option @if ($data->bln_selesai == 'April') selected @endif value="April">April</option>
                                        <option @if ($data->bln_selesai == 'May') selected @endif value="May">May</option>
                                        <option @if ($data->bln_selesai == 'June') selected @endif value="June">June</option>
                                        <option @if ($data->bln_selesai == 'July') selected @endif value="July">July</option>
                                        <option @if ($data->bln_selesai == 'August') selected @endif value="August">August</option>
                                        <option @if ($data->bln_selesai == 'September') selected @endif value="September">September</option>
                                        <option @if ($data->bln_selesai == 'October') selected @endif value="October">October</option>
                                        <option @if ($data->bln_selesai == 'November') selected @endif value="November">November</option>
                                        <option @if ($data->bln_selesai == 'December') selected @endif value="December">December</option>
                                    </select>
                                    <input type="text" class="form-control mt-1" placeholder="Year" name="end_year" value="{{ $data->thn_selesai }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Description"> {{ $data->deskripsi }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </div>

            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach

<!-- Read Data -->
@foreach ($experience as $data)
<div class="modal fade" id="read{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title">Your Experience</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group row">
                            <span class="col-sm-4"><Strong>{{ $data->bln_mulai }} {{ $data->thn_mulai }} - {{ $data->bln_selesai }} {{ $data->thn_selesai }}</Strong></span>
                            <div class="col-sm-8">
                                <span><strong>{{ $data->jabatan }}</strong></span><br>
                                <span>{{ $data->perusahaan }} | {{ $data->negara }}</span><br>
                                <span class="text-muted">Position Level : </span>{{ $data->jns_karyawan }}<br>
                                <span class="text-muted">Monthly Salary : </span>{{ $data->gaji }}<br>
                                <span>{{ $data->deskripsi }}</span>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach

<!-- Delete Data -->
@foreach ($experience as $data)
<div class="modal fade" id="delete{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/experience/delete/{{ $data->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title">Delete Experience</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to continue delete data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>

            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach
@endsection

