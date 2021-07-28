@extends('layout.layout')

@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Registrasi</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <form class="card-body uppercase" method="post" action="updatedata" enctype="multipart/form-data">
                                    @csrf
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control @error('nip') is-invalid @enderror" id="" name="nip" placeholder="Contoh : 990xxx"
                                      value="{{ $dataCoba->nip }}" 
                                      >
                                      <div class="invalid-feedback">
                                        @error('nip') 
                                            {{ $message }} 
                                        @enderror
                                    </div>
                                  </div>
                              </div>
                              <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control @error('nama') is-invalid @enderror" id="" name="nama" placeholder="Contoh : Abdxx"
                                      value="{{ $dataCoba->nama }}">
                                      <div class="invalid-feedback">
                                        @error('nip') 
                                            {{ $message }} 
                                        @enderror
                                    </div>
                                  </div>
                              </div>
                              <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Upload File</label>
                                    <div class="col-sm-10 custom-file">
                                      <input type="hidden" name="file" value="{{ $dataCoba->foto }}" id="hiddenvalue">
                                      <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file2" id="inputGroupFile01" onchange="$('#upload-file-info').text(this.files[0].name)" @error('file')  @else disabled @enderror>
                                      <label class="custom-file-label" for="inputGroupFile01" id="upload-file-info">@error('file') Pilih File  @else {{ $dataCoba->foto }} @enderror</label>
                                  </div>
                              </div>
                              @error('file')
                              @else
                              <div class="card row" id="previewFile">
                                <div class="card-body">
                                  <i class="fas fa-file-word"></i> <a href="{{ asset('d') }}/{{ $dataCoba->foto }}">{{ $dataCoba->foto }}</a> <i class="fa fa-trash" onclick="del(this)"></i>
                                </div>
                              </div>
                              @enderror
                              
                              <button type="submit" class="btn btn-primary">Masukkan Data</button>
                          </form>
                            </div>
                        </div>
                    </div>

                </div>
                <script type="text/javascript">
                  function del(e) {
    document.getElementById("previewFile").remove();
    document.getElementById("hiddenvalue").remove();
    document.getElementById("inputGroupFile01").setAttribute("name","file");
    document.getElementById("inputGroupFile01").removeAttribute("disabled");
    document.getElementById('upload-file-info').innerHTML="Pilih File";
}
                </script>
                <!-- /.container-fluid -->
@endsection