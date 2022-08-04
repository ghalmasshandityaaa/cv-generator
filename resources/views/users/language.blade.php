@extends('layouts.master')
@section('title','Language')
@section('page-name','Language')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title" style="float: left;"><i class="fas fa-basketball-ball"> </i> Language </h3>
        <button type="button" class="btn btn-outline-primary btn-sm mt-0" data-toggle="modal" data-target="#add" style="float: right; top:0"><i class="fas fa-plus"></i> Add Language</button><br>
        <small>Please enter your language</small>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>language</th>
                    <th>Level</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($language) == 0)
                <tr class="text-center">
                    <td colspan="4" class="text-center">- No Data -</td>
                </tr>
                @endif

                @php
                    $no=1;
                @endphp
                @foreach ($language as $data)
                <tr>
                    <td>{{ $no++ }}</td>
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
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-warning btn-sm mt-1" data-toggle="modal" data-target="#edit{{ $data->id }}"><i class="fas fa-edit"> </i> Edit</button>
                        <button type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="modal" data-target="#delete{{ $data->id }}"><i class="fas fa-trash"> </i> Delete</button>
                    </td>
                </tr>
                @endforeach
                <tr>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Language</th>
                    <th>Level</th>
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
            <form class="form-horizontal" method="POST" action="/language/add" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add Language</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="language">language Name</label>
                            <input type="text" class="form-control" id="language" name="language" placeholder="Language" value="{{ old('language') }}">
                        </div>
                        <div class="form-group">
                            <label for="qualification">Position Level</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="level" value="{{ old('level') }}">
                                <option selected="selected" disabled>- Chose Position -</option>
                                <option value="1">Basic</option>
                                <option value="2">Novice</option>
                                <option value="3">Intermediate</option>
                                <option value="4">Advanced</option>
                                <option value="5">Expert</option>
                            </select>
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
@foreach ($language as $data)
<div class="modal fade" id="edit{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/language/edit/{{ $data->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-warning text-white">
                    <h4 class="modal-title">Edit Language</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="language">Language</label>
                            <input type="text" class="form-control" id="language" name="language" placeholder="Language" value="{{ $data->bahasa }}">
                        </div>
                        <div class="form-group">
                            <label for="qualification">Position Level</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="level" value="{{ $data->tingkat }}">
                                <option selected="selected" disabled>- Chose Position -</option>
                                <option @if ($data->tingkat == 1) selected @endif value="1">Basic</option>
                                <option @if ($data->tingkat == 2) selected @endif value="2">Novice</option>
                                <option @if ($data->tingkat == 3) selected @endif value="3">Intermediate</option>
                                <option @if ($data->tingkat == 4) selected @endif value="4">Advanced</option>
                                <option @if ($data->tingkat == 5) selected @endif value="5">Expert</option>
                            </select>
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


<!-- Delete Data -->
@foreach ($language as $data)
<div class="modal fade" id="delete{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/language/delete/{{ $data->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title">Delete Language</h4>
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

