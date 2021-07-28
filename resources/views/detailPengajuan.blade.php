@extends('layout.layout')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->

    <div class="row">

        <div class="col-lg-6">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">ID Pengajuan : {{ $data->idpengajuan }}</h6>
                                    <div>
                                        <div class=" btn-sm btn btn-{{ $data->color }} btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="{{ $data->icon }} text"></i>
                                            </span>
                                            <span class="text">
                                                {{ $data->namestatus }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>Tujuan Pengajuan Dana : <code>{{ $data->pengajuan }}</code></p>
                                    <p>Penanggung Jawab : <code>{{ $data->pj }}</code></p>
                                    <p>Rekening : <code>{{ $data->rekening }}</code></p>
                                    <p>Dana Yang Di Ajukan : Rp. <code>{{ $data->total }}</code></p>
                                    <p>Detail : <code>{{ $data->detail }}</code></p>
                                    <p>Rincian Pengajuan/Dokumen/Proposal : </p>
                                    <a href="{{ url('/d') }}/{{ $data->doc }}" class="btn btn-light btn-icon-split">
                                        <span class="icon text-gray-600">
                                            <i class="fas fa-arrow-down text"></i>
                                        </span>
                                        <span class="text">Unduh Dokumen</span>
                                    </a>
                                    <br>
                                    <form class="card-body uppercase" method="post" action="accept" enctype="multipart/form-data">
                                        @csrf
                                        <p>Dana yang telah disetujui dan akan dikirim ke rekening</p>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Dana</label>
                                        <div class="col-sm-10">
                                          <input type="number" class="form-control @error('nip') is-invalid @enderror" id="" name="dana" placeholder="" value="{{ $data->total }}">
                                      </div>
                                      </div>
                                    <div class="my-2"></div>
                                    <!-- <div class="my-2"></div> -->
                                    <div class="elmargin">
                                        <a href="periksa/{{ $data->idpengajuan }}" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-exclamation-triangle text"></i>
                                        </span>
                                        <span class="text">Diperiksa</span>
                                    </a>
                                    <!-- <div class="my-2"></div> -->
                                    <a href="tolak/{{ $data->idpengajuan }}" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-times text"></i>
                                        </span>
                                        <span class="text">Ditolak</span>
                                    </a>
                                    <button type='submit' class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check text"></i>
                                        </span>
                                        <span class="text">Diterima</span>
                                    </button>
                                    <input type="hidden" name="idpengajuan" value="{{ $data->idpengajuan }}">
                                    <input type="hidden" name="iduser" value="{{ $data->send }}">
                                    </div>
                                    
                                    </form>
                                </div>
                            </div>

                        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
@extends('layout.konfirmasi')
