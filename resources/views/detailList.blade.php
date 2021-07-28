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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Data {{ $data[0]->idalokasi }}</h6>
                                    <div>
                                    <a href="/alokasi/edit/{{ $data[0]->idalokasi }}" class=" btn-sm btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pen text"></i>
                                        </span>
                                        <span class="text">
                                                Edit Data
                                            </span>
                                    </a>
                                    <a data-toggle="modal" data-target="#conDel" data-href="/del/alokasi/{{ $data[0]->idalokasi }}" class=" btn-sm btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash text"></i>
                                        </span>
                                        <span class="text">
                                                Hapus Data
                                            </span>
                                    </a>

                                    </div>
                                                                    </div>
                <div class="card-body">
                    <table class="table" width="100%" cellspacing="0">
                        <tr>
                            <td  width="150px">Id Alokasi</td>
                            <td>{{ $data[0]->idalokasi }}</td>
                        </tr>
                        <tr>
                            <td  width="150px">Sumber Dana</td>
                            <td>{{ $data[0]->sumber }}</td>
                        </tr>
                        <tr>
                            <td  width="150px">Tipe Alokasi</td>
                            <td>{{ $data[0]->kelompok }}</td>
                        </tr>
                        <tr>
                            <td  width="150px">Jenis Alokasi</td>
                            <td>{{ $data[0]->jenis }}</td>
                        </tr>
                        <tr>
                            <td  width="150px">Total Anggaran</td>
                            <td>{{ $data[0]->total }}</td>
                        </tr>
                        <tr>
                            <td  width="150px">Catatan</td>
                            <td>{{ $data[0]->deskripsi }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Rincian</h6>
                                    <a href="{{ $data[0]->idalokasi }}/create" class=" btn-sm btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Data</span>
                                    </a>
                                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="shadow">
                                    <td>Name</td>
                                    <td>Deskripsi</td>
                                    <td>Dokumen</td>
                                    <td>Total Anggaran</td>
                                    <td><i class="fa fa-cog"></i></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataDetail as $main)
                                <tr>
                                    <td>{{ $main->detailAlokasi }}</td>
                                    <td>{{ $main->deskripsi }}</td>
                                    <td><a href="{{ url('/d') }}/{{ $main->doc }}">Dokumen</a></td>
                                    <td>{{ $main->anggaran }}</td>
                                    <td>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cog fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Pengaturan:</div>
                                        <a href="{{ $main->iddetailAlokasi }}/edit" class="dropdown-item"><i class="fa fa-pen"></i> Edit Data</a>
                                        <div class="dropdown-divider"></div>
                                        <a style="color: #e74a3b" class="dropdown-item" data-toggle="modal" data-target="#conDel" data-href="/del/detailalokasi/{{ $main->iddetailAlokasi }}"><i class="fa fa-trash"></i>Hapus Data</a>
                                    </div>
                                </div>

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
