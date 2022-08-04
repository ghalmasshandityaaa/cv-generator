<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets')}}/dist/img/favicon.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets')}}/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/toastr/toastr.min.css"><!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" onload="window.print();">
    <div class="wrapper">
<div class="col-12 mt-2">
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
                    {{-- <a href="/export" style="text-decoration: none; float:right; color:grey;"><i class="nav-icon fas fa-file-import"></i> Print</a> --}}
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
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('assets')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets')}}/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('assets')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{asset('assets')}}/plugins/raphael/raphael.min.js"></script>
<script src="{{asset('assets')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{asset('assets')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('assets')}}/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets')}}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets')}}/dist/js/pages/dashboard2.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('assets')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('assets')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('assets')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="{{asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{asset('assets')}}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{asset('assets')}}/plugins/toastr/toastr.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>
</html>