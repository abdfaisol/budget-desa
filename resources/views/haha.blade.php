@extends('layout.layout')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="{{ asset('sbadmin') }}/img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Selamat datang di portal admin e-motor. Jika ada kritik atau saran, silahkan hubungi admin</p>
                                    <p>WA : 089683744503</p>
                                    @foreach ($dataCoba as $data)
                                    <p>
                                    	{{ $data->id }} | {{ $data->nip }} | {{ $data->nama }} 
                                    </p>
                                    <div class="text-center">
                                        <a href="{{ asset('d') }}/{{ $data->foto }}">{{ $data->foto }}</a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
@endsection