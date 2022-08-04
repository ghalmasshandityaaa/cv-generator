@extends('layouts.master')
@section('title','Profile')
@section('page-name','Profile')
@section('content')
<div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" @if (Auth::user()->foto == '') src="{{ asset('assets') }}/dist/img/profile.png" @else src="{{ asset('assets') }}/dist/img/{{ Auth::user()->foto }}" @endif alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">Ghalmas Shanditya Putra Agung</h3>

        {{-- <p class="text-muted text-center">Back End Developer</p> --}}

        <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
            <b>Email</b><br> <a class="text-muted">{{ Auth::user()->email }}</a><br>
            <b>Phone</b><br> <a class="text-muted">{{ Auth::user()->telepon }}</a><br>
            <b>Address</b><br> <a class="text-muted">{{ Auth::user()->alamat }}</a>
        </li>

        </ul>

        {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<!-- /.col -->
<div class="col-md-9">
    <div class="card">

    <div class="card-body">
        <div class="tab-content">
        <div class="active tab-pane" id="profile">
            <form class="form-horizontal" action="/profile/update/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ Auth::user()->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="email" name="email" disabled value="{{ Auth::user()->email }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="Birth" class="col-sm-2 col-form-label">Date of birth</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="Birth" placeholder="Birth" name="birth" value="{{ Auth::user()->ttl }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <select class="form-control select2bs4" style="width: 100%;" name="gender" value="{{ Auth::user()->jk }}">
                        <option selected="selected" disabled>- Chose Gender -</option>
                        <option @if (Auth::user()->jk == 'Men') @endif value="Men">Men</option>
                        <option @if (Auth::user()->jk == 'Women') @endif value="Women">Women</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="phone" placeholder="phone" name="phone" value="{{ Auth::user()->telepon }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="country" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control col-sm-12" id="country" placeholder="Country" name="country" value="{{ Auth::user()->negara }}">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control col-sm-12" id="province" placeholder="Province" name="province" value="{{ Auth::user()->provinsi }}">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control col-sm-12" id="city" placeholder="City" name="city" value="{{ Auth::user()->kota }}"><br>
                </div>
                
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <textarea class="form-control col-sm-12" placeholder="Address"  name="address" id="" rows="5">{{ Auth::user()->alamat }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Summary</label>
                <div class="col-sm-10">
                    <textarea class="form-control col-sm-12" placeholder="Summary"  name="summary" id="" rows="5">{{ Auth::user()->ringkasan }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            </form>
        </div>
        <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection

