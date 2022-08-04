@extends('layouts.master')
@section('title','Resume')
@section('page-name','Resume')
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title" style="float: left;"><i class="fas fa-print"> </i> Resume </h3>
        <br><small>Please enter your Resume</small>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            
            @if (count($resume)>0)
            <table border="0">
                <tbody>
                @foreach ($resume as $data)
                    <tr>
                        <td>File Name </td>
                        <td> : </td>
                        <td> <i class="fas fa-print"></i> <a href="assets/resume/{{ $data->cv }}">{{ $data->cv }}</a></td>
                    </tr>
                    <tr>
                        <td>Uploaded </td>
                        <td> : </td>
                        <td> @php echo date('d F Y H:i:s', strtotime($data->updated_at)); @endphp</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-outline-warning btn-sm mt-1" data-toggle="modal" data-target="#edit{{ $data->id }}"><i class="fas fa-edit"> </i> Edit</button>
            <button type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="modal" data-target="#delete{{ $data->id }}"><i class="fas fa-trash"> </i> Delete</button>
            @else
            <form class="form-horizontal" method="POST" action="/resume/add" enctype="multipart/form-data">
                @csrf
                <input type="file" class="form-control" id="resume" name="resume" placeholder="Resume title" value="{{ old('resume') }}">
                <button type="submit" class="btn btn-primary mt-2">Upload</button>
            </form>
            @endif
            <br><small>Acceptable file types are <strong>DOC, DOCX, PDF, and RTF</strong>.</small>
            <br>
            <small>Max file size is <strong>10 MB</strong>.</small>
        </div>
        <!-- /.card-body -->
    </div>
</div>

{{-- Edit Resume --}}
@foreach ($resume as $data)
<div class="modal fade" id="edit{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/resume/edit/{{ $data->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-warning text-white">
                    <h4 class="modal-title">Edit Resume</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="university">CV / Resume</label>                        
                            <input type="file" class="form-control" id="resume" name="resume" placeholder="Resume title" value="{{ $data->cv }}">
                            <small>Acceptable file types are <strong>DOC, DOCX, PDF, and RTF</strong>.</small>
                            <br>
                            <small>Max file size is <strong>10 MB</strong>.</small>
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

<!-- Delete Resume -->
@foreach ($resume as $data)
<div class="modal fade" id="delete{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/resume/delete/{{ $data->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title">Delete Resume</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to continue delete resume ?</p>
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

