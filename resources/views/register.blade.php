@extends('layout.layout')

@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Baru</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <form class="card-body uppercase" method="post" action="/insert/alokasi" enctype="multipart/form-data">
                                    @csrf
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Alokasi</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control @error('alokasi') is-invalid @enderror" id="" name="alokasi" placeholder="Contoh : Pembangunan Masjid"
                                      value="" 
                                      >
                                      <div class="invalid-feedback">
                                        @error('alokasi') 
                                            {{ $message }} 
                                        @enderror
                                    </div>
                                  </div>
                              </div>
                              <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Tipe Alokasi</label>
                                    <div class="col-sm-10">
                                     <select id="inputState" name="tipe" class="form-control">
                                      @foreach ($jenis as $data)
                                      <option value="{{ $data->idjenis }}">{{ $data->jenisAnggaran }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Sumber Dana</label>
                                    
                                    <div class="col-sm-10">
                                     <select id="inputState" name="sumber" class="form-control">
                                      @foreach ($sumber as $data)
                                      <option value="{{ $data->idsumber }}">{{ $data->name }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Kelompok Alokasi</label>
                                    
                                    <div class="col-sm-10">
                                     <select id="inputState" name="kelompok" class="form-control">
                                      @foreach ($kelompok as $data)
                                      <option value="{{ $data->idkelompok }}">{{ $data->kelompok }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-10">
                                      <input type="date" class="form-control @error('date') is-invalid @enderror" id="" name="date" 
                                      value="<?= date('Y-m-d') ?>" 
                                      >
                                      <div class="invalid-feedback">
                                        @error('date') 
                                            {{ $message }} 
                                        @enderror
                                    </div>
                                  </div>
                              </div>
                              <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Upload File</label>
                                    <div class="col-sm-10 custom-file">
                                      <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="inputGroupFile01" onchange="$('#upload-file-info').text(this.files[0].name)">
                                      <label class="custom-file-label" for="inputGroupFile01" id="upload-file-info">Pilih File</label>
                                  </div>
                              </div>
                              <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Detail</label>
                                    <textarea name='detail' class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="255"></textarea>

                              </div>
                              <button type="submit" class="btn btn-primary">Masukkan Data</button>
                          </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
@endsection