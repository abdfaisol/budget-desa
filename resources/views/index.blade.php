@extends('layout.layout')

@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php 
                                            $n = 0;$i=0;$j=0;
                                            $dataset = [];
                                            $datalabel = [];
                                             ?>
                                            @foreach ($data as $main)
                                                <?php 
                                                $n = $n + $main->total;
                                                // array_push($dataset, $main->total);
                                                // $date = $main->date;
                                                // array_push($datalabel, date_format($date,"M"));
                                                // echo date_format(now(),"M");
                                                 ?>
                                            @endforeach
                                            @foreach ($datakeluar as $main)
                                                <?php 
                                                $i = $i + $main->total;
                                                // array_push($dataset, $main->total);
                                                // $date = $main->date;
                                                // array_push($datalabel, date_format($date,"M"));
                                                // echo date_format(now(),"M");
                                                 ?>
                                            @endforeach

                                            <?php 
                                            function numshort($n){
                                                if ($n < 1000000) {
                                                    $n = number_format($n/1000). 'K';
                                                }else if($n < 1000000000){
                                                    $n = number_format($n/1000000, 3). 'K';
                                                }else{
                                                    $n = number_format($n/1000000000, 3). 'M';
                                                }
                                                return $n;
                                            }
                                            
                                             ?>
                                            
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Pemasukan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= numshort($n) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Pengeluaran</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= numshort($i) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Sisa Dana</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= numshort($n-$i) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">API PUBLIC</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ url('/api/dev01') }}/{{ $api->token }}
                                                <a id='api' href="{{ url('/api/dev01') }}/{{ $api->token }}" target="_blank">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            </div>
                                            <br>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nomor Token</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $api->token }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ url('/generateAPI') }}">
                                            <i class="fas fa-undo fa-2x"></i>
                                            </a>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                    Styling for the area chart can be found in the
                                    <code>/js/demo/chart-area-demo.js</code> file.
                                </div>
                            </div>
                            <script type="text/javascript">
                            function Get(url){
                                var http = new XMLHttpRequest();
                                http.open("GET",url,false);
                                http.send(null);
                                return http.responseText;
                            }
                            var url = document.getElementById('api').href;
                            var json = JSON.parse(Get(url));
                            console.log(json.data.total.masuk);
                            var bulan = json.data.total.masuk.bulan;
                            var val = json.data.total.masuk.nilai;
                            function jsonToArr(data){
                                var monthShort = [];
                                data.forEach((entry)=>{
                                    var ms = entry['total'];
                                    monthShort.push(ms);
                            });
                                return monthShort;
                            }
                            val.forEach((entry)=>{
                                    var ms = entry['total'];
                                    console.log(ms);
                            });
                            function monthShort(data){
                                var monthShort = [];
                                data.forEach((entry)=>{
                                    var ms = new Date(entry['date']).toLocaleString('default',{month:'short'});
                                    monthShort.push(ms);
                            });
                                return monthShort;

                            }
                            // console.log(monthShort(bulan));
                            var labelku = monthShort(bulan);
                            var dataSet = jsonToArr(val);
                            console.log(labelku);
                            console.log(dataset);
                            </script>
                    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="shadow">
                                                <td>Date</td>
                                                <td>Alokasi</td>
                                                <td>Jenis Anggaran</td>
                                                <td>Sumber Anggaran</td>
                                                <td>Dokumen</td>
                                                <td>Total Anggaran</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataalokasi as $main)
                                            <tr>
                                                <td>{{ $main->date }}</td>
                                                <td>{{ $main->alokasi }}</td>
                                                <td>{{ $main->sumber }}</td>
                                                <td>{{ $main->jenis }}</td>
                                                <td><a href="{{ url('/d') }}/{{ $main->doc }}">Dokumen</a></td>
                                                <td style='color: {{ $main->color }}'>
                                                    <i class="{{ $main->icon }}"></i>
                                                    {{ $main->total }}
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <!-- Content Row -->
                </div>
                <!-- /.container-fluid -->
@endsection