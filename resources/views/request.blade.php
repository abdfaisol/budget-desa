@extends('layout.layout')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Tables</h1>
            <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>Status</td> 
                                    <td>ID Pengajuan</td>                                    
                                    <td>Tujuan Dana</td>
                                    <td>Penanggung Jawab</td>
                                    
                                    <td>Dokumen</td>
                                    <td>Total Anggaran</td>
                                    <td><i class="fa fa-cog"></i></td>
                                </tr>
                            </thead>
                            <tbody>
                               
                        @foreach ($data as $main)
                        <tr>
                            <td class="text-center">
                                <a href="#" class="btn btn-{{ $main->color }} btn-circle btn-sm">
                                    <i class="{{ $main->icon }}"></i>
                                </a>
                            </td>
                            <td>{{ $main->idpengajuan }}</td>    
                            <td>{{ $main->pengajuan }}</td>
                            <td>{{ $main->pj }}</td>

                            <td><a href="{{ url('/d') }}/{{ $main->doc }}">Dokumen</a></td>
                            <td>{{ $main->total }}</td>
                            <td>
                                <a href="pengajuan/detail/{{ $main->idpengajuan }}"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
@extends('layout.konfirmasi')
