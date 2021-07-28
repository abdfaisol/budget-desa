<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\File;
use App\Http\Controllers\Session;
use Illuminate\Http\Request;
use App\Models\coba;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
class Kontrolku extends Controller
{
    //
    public function __construct()
    {
    	$this-> dataModel = new coba();
    }
    public function rootID(){
        $iduser = 2;
        return redirect('/'.$iduser);

    }
    public function home($id){
        // $token = 'b47f3335502d75cf1f0d49551a8a8178';
        // $iduser = $this->dataModel->api()->select('user')->where('token',$token)->first();
        $iduser = $id;
        $data = [
            "judul" => "E-Budget Desa",
                'pesan' => 'berhasil',
                'data' => $this->dataModel->alokasiDapetinNilai(2,'1001'),
            'datakeluar' => $this->dataModel->alokasiDapetinNilai(2,'1002'),
                'dataalokasi' =>$this->dataModel->alokasiAll()->where('iduser',$iduser)->orderBy('idalokasi','desc')->get(),
                'api' => $this->dataModel->api()->where('user',$iduser)->first()
       ];
        return view('home', $data);
    }
    public function index(){
        if(session()->has('username')){
            $iduser = $this->dataModel->user()->select('level')->where('token',$token)->first();
            if(session('username')=='1'){
                return redirect('/pengajuan');
            }
        }else{
            $data=['judul'=>'login'];
            return view('login', $data);
        }

        
        $user = $this->dataModel->user()->select('iduser')->where('username',session('username'))->get();
        $iduser = $user[0]->iduser;
    	$data = [
    		"halo" => "Halllo",
    		"judul" => "E-Budget Desa",
    		'data' => $this->dataModel->alokasiDapetinNilai(2,'1001'),
            'datakeluar' => $this->dataModel->alokasiDapetinNilai(2,'1002'),
            'dataalokasi' =>$this->dataModel->alokasiAll()->where('iduser',2)->orderBy('idalokasi','desc')->get(),
            'api' => $this->dataModel->api()->where('user',2)->first()
    	];
    	return view('index', $data);
    }
    public function apiGET($token){ 
        $iduser = $this->dataModel->api()->select('user')->where('token',$token)->first();
        if(!isset($iduser->user)){
            $data = [
                'pesan' => 'Error'
            ];
        }else{
          $iduser = $iduser->user;
            $data = [
                'pesan' => 'berhasil',
                'data' => [
                    'api' => $this->dataModel->api()->select('token')->where('token',$token)->first(),
                    'total' => [
                        'masuk' => [
                           'bulan' => $this->dataModel->alokasiDapetinBulan($iduser, 1001),
                           'nilai' => $this->dataModel->alokasiDapetinNilai($iduser,'1001'),
                       ],
                       'keluar' => [
                           'bulan' => $this->dataModel->alokasiDapetinBulan($iduser, 1002),
                           'nilai' => $this->dataModel->alokasiDapetinNilai($iduser,'1002')
                       ]
                   ]
               ],
               'datalengkap' => $this->dataModel->alokasiAll()->select('date','alokasi','kelompok','sumber','doc','total')->where('iduser',$iduser)->orderBy('date','ASC')->get()
           ];
        }
        return $data;
    }
    public function token(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        $user = $this->dataModel->user()->select('iduser')->where('username',session('username'))->get();
        $iduser = $user[0]->iduser;
        $token = md5($iduser. session('username') . microtime());
        $this->dataModel->api()->where('user',$iduser)->update(['token'=>$token]);
        return redirect('/home');
    }

    public function login(){

        $data = [
            "halo" => "Halllo",
            "judul" => "Login",
            // 'dataCoba' => $this->dataModel->allData()
        ];
        return view('login', $data);
    }
    public function ceklogin(){
        Request()->validate([
        'username' => [
            'required',
            'exists:user,username'
        ],
        'password' => [
            'required',
            Rule::exists('user')->where(function($query){
                return $query->where('username',Request()->username);
            }),
        ],
         ]);
        $data1 = $this->dataModel->user()->where('username',Request()->username)->where('password',Request()->password)->first();
        $level = $data1->levelmikro;
        // Session::set('username',Request()->username);
        session()->put('level',$level);
        session()->put('username',Request()->username);
        // $_SESSION['username'] = Request()->username;
        return redirect()->route('home');
    }
    public function logout(){
        // Session::set('username',Request()->username);
        session()->flush();
        // $_SESSION['username'] = Request()->username;
        return redirect()->route('home');
    }
    public function pengajuan(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        $data = [
            "halo" => "Halllo",
            "judul" => "Pengajuan Alokasi Dana",
            'data' => $this->dataModel->pengajuanStatus()->where('to','1001')->orderBy('create_at','desc')->get()
        ];
        return view('request', $data);
    }
    public function pengajuanku(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
         $user = $this->dataModel->user()->select('iduser')->where('username',session('username'))->get();
        $data = [
            "halo" => "Halllo",
            "judul" => "Pengajuan Alokasi Dana",
            'data' => $this->dataModel->pengajuanStatus()->where('send',$user[0]->iduser)->orderBy('create_at','desc')->get()
        ];
        return view('requestku', $data);
    }
    public function createPengajuan(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }

        $data = [
            "halo" => "Halllo",
            "judul" => "Budget Baru",
            'sendto' => $this->dataModel->view_level()->where('idlevel','1')->orWhere('idlevel','3')->get()
            // $this->dataModel->tipeAll()->get()
        ];
        return view('createPengajuan', $data);
    }
    public function insertPengajuan(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        Request()->validate([
        'judul' => 'required',
        'pj' => 'required',
        'rekening' => 'required',
        'dana' => 'required|gte:1',
        'sendto' => 'required',
        'file' => 'required'
         ]);
        // Generate File
        $file = Request()->file;
        $filename = $file->getClientOriginalName();
        $generator = md5($filename . microtime()).'.'.$file->extension();
        

        // Get ID USER
        $user = $this->dataModel->user()->select('iduser')->where('username',session('username'))->get();
        $iduser = $user[0]->iduser;

        // Susunan Data
        $data = [
        'to' => Request()->sendto,
        'pengajuan' => Request()->judul,
        'pj' => Request()->pj,
        'rekening' => Request()->rekening,
        'doc' => $generator,
        'detail' => Request()->detail,
        'send' => $iduser,
        'status' => 4,
        'total' => Request()->dana,
        'create_at' => now()
    ];
    // // Insert Database
    $this->dataModel->pengajuan()->insert($data);
    $file->move(public_path('d'),$generator);
    //     return view('createPengajuan', $data);
    return redirect()->route('pengajuanku');
    }
    public function updatePengajuan(){
if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        $data = [
            "halo" => "Halllo",
            "judul" => "Budget Baru",
        ];
        return view('updatePengajuan', $data);
    }
    public function periksa($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        $this->dataModel->pengajuan()->where('idpengajuan',$id)->update(['status'=>'1']);
        return redirect('/pengajuan/detail/'.$id);
    }
    public function tolak($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        $this->dataModel->pengajuan()->where('idpengajuan',$id)->update(['status'=>'2']);
        return redirect('/pengajuan/detail/'.$id);
    }
    public function accept(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        Request()->validate([
        'dana' => 'required|gte:1',
        'idpengajuan' => 'required',
        'iduser' => 'required'
         ]);
        $pengajuan = $this->dataModel->pengajuan()->where('idpengajuan',Request()->idpengajuan)->first();
        $date = date('Y-m-d');
        $data = [
            'alokasi' => 'Dana '.$pengajuan->pengajuan,
            'idjenis' => '1006',
            'idsumber' => '1001',
            'idkelompok' => '1001',
            'doc' => null,
            'deskripsi' => 'Dana ini dikirim untuk '.$pengajuan->pengajuan,
            'iduser' => Request()->iduser,
            'date' => $date
        ];
        
    // Insert Database
    // $this->dataModel->detailAlokasi()->insert($data);
        $this->dataModel->pengajuan()->where('idpengajuan',Request()->idpengajuan)->update(['status'=>'3']);
        $this->dataModel->alokasi()->insert($data);

        $idalokasi = $this->dataModel->alokasi()->select('idalokasi')->where('iduser',Request()->iduser)->where('date',$date)->where('alokasi','Dana '.$pengajuan->pengajuan)->first();
        // return dd($idalokasi);
        $idalokasi = $idalokasi->idalokasi;
        $data2=[
            'idalokasi' => $idalokasi,
            'detailAlokasi' => 'Dana '.$pengajuan->pengajuan,
            'anggaran' =>  Request()->dana,
            'deskripsi' => 'Dana ini dikirim untuk '.$pengajuan->pengajuan
        ];
        $this->dataModel->detailAlokasi()->insert($data2);
        return redirect('/list/detail/'.$idalokasi);
        // return redirect('/pengajuan/detail/'.$id);
    }
    public function detailPengajuan($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }

        $data = [
            "halo" => "Halllo",
            "judul" => "Detail Pengajuan $id",
            'data' => $this->dataModel->pengajuanStatus()->where('idpengajuan',$id)->first()
        ];
        return view('detailPengajuan', $data);
    }
    public function insertDataAlokasi(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        Request()->validate([
        'alokasi' => 'required',
        'tipe' => 'required',
        'sumber' => 'required',
        'kelompok' => 'required',
        'file' => 'required',
        'date' => 'required'
         ]);
        $file = Request()->file;
        $filename = $file->getClientOriginalName();
        $generator = md5($filename . microtime()).'.'.$file->extension();
        $file->move(public_path('d'),$generator);
        $user = $this->dataModel->user()->select('iduser')->where('username',session('username'))->get();
        $iduser = $user[0]->iduser;

        // Susunan Data
        $data = [
        'alokasi' => Request()->alokasi,
        'idjenis' => Request()->tipe,
        'idsumber' => Request()->sumber,
        'idkelompok' => Request()->kelompok,
        'doc' => $generator,
        'deskripsi' => Request()->detail,
        'iduser' => $iduser,
        'date' => Request()->date
    ];
    // Insert Database
    $this->dataModel->alokasi()->insert($data);
    $idalokasi = $this->dataModel->alokasi()->select('idalokasi')->where('iduser',$iduser)->where('date',Request()->date)->where('doc',$generator)->first();
    $idalokasi = $idalokasi->idalokasi;
        return redirect('/list/detail/'.$idalokasi);
    }

    public function updateAlokasi(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        Request()->validate([
        'alokasi' => 'required',
        'tipe' => 'required',
        'sumber' => 'required',
        'kelompok' => 'required',
        'date' => 'required'
         ]);

        // Data File Lama
        $dataOld = $this->dataModel->alokasi()->select('doc')->where('idalokasi',Request()->idalokasi)->get();
        
        // Apabila Ada File Masuk
        if(isset(Request()->file)){
            // Hapus Fila Lama
            @unlink(public_path('/d/').$dataOld[0]->doc);

            // Generate File Baru
            $file = Request()->file;
            $filename = $file->getClientOriginalName();
            $generator = md5($filename . microtime()).'.'.$file->extension();
            $file->move(public_path('d'),$generator);
        }else{
            $generator = $dataOld[0]->doc;
        }
        

        // Susunan Data
        $data = [
        'alokasi' => Request()->alokasi,
        'idjenis' => Request()->tipe,
        'idsumber' => Request()->sumber,
        'idkelompok' => Request()->kelompok,
        'doc' => $generator,
        'deskripsi' => Request()->detail,
        'date' => Request()->date
    ];
    // Insert Database
    $this->dataModel->alokasi()->where('idalokasi',Request()->idalokasi)->update($data);
        return redirect('/list/detail/'.Request()->idalokasi);
    }
    public function updateList(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        Request()->validate([
        'name' => 'required',
        'dana' => 'required|gte:1'
         ]);

        // Data File Lama
        $dataOld = $this->dataModel->detailAlokasi()->select('doc')->where('iddetailAlokasi',Request()->iddetailAlokasi)->get();
        
        // Apabila Ada File Masuk
        if(isset(Request()->file)){
            // Hapus Fila Lama
            @unlink(public_path('/d/').$dataOld[0]->doc);

            // Generate File Baru
            $file = Request()->file;
            $filename = $file->getClientOriginalName();
            $generator = md5($filename . microtime()).'.'.$file->extension();
            $file->move(public_path('d'),$generator);
        }else{
            $generator = $dataOld[0]->doc;
        }
        

        // Susunan Data
        $data = [
        'detailAlokasi' => Request()->name,
        'anggaran' => Request()->dana,
        'doc' => $generator
    ];
    // Insert Database
    $this->dataModel->detailAlokasi()->where('iddetailAlokasi',Request()->iddetailAlokasi)->update($data);
        return redirect('/list/detail/'.Request()->idalokasi);
    }
    // Update Alokasi
    public function editAlokasi($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        $data = [
            "judul" => "Edit Data ".$id,
            "jenis" => $this->dataModel->jenis()->get(),
            "kelompok" => $this->dataModel->kelompok()->get(),
            "sumber" => $this->dataModel->sumber()->get(),
            'data1' => $this->dataModel->alokasiAll()->where('idalokasi',$id)->first()
            // $this->dataModel->tipeAll()->get()
        ];
        return view('editAlokasi', $data);
    }
    public function editList($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        $data = [
            "judul" => "Edit Data ".$id,
            'data' => $this->dataModel->detailAlokasi()->where('iddetailAlokasi',$id)->first()
            // $this->dataModel->tipeAll()->get()
        ];
        return view('updateList ', $data);
    }
    public function insertList($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        Request()->validate([
        'judul' => 'required',
        'dana' => 'required',
        'file' => 'required'
         ]);
        $file = Request()->file;
        $filename = $file->getClientOriginalName();
        $generator = md5($filename . microtime()).'.'.$file->extension();
        $file->move(public_path('d'),$generator);

        // Susunan Data
        $data = [
        'idalokasi' => $id,
        'detailAlokasi' => Request()->judul,
        'anggaran' =>  Request()->dana,
        'doc' => $generator,
        'deskripsi' => Request()->detail
    ];
    // Insert Database
    $this->dataModel->detailAlokasi()->insert($data);
    $data = [
        'judul' => 'hahaha'
    ];
    return redirect('/list/detail/'.$id);
    }
    public function insertAlokasi(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        $data = [
            "halo" => "Halllo",
            "judul" => "Budget Baru",
            "jenis" => $this->dataModel->jenis()->get(),
                "kelompok" => $this->dataModel->kelompok()->get(),
                "sumber" => $this->dataModel->sumber()->get()
            // $this->dataModel->tipeAll()->get()
        ];
        return view('register', $data);
    }

    public function detailAlokasi($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }

        $data = [
            "halo" => "Halllo",
            "judul" => "Detail Alokasi $id",
            'data' => $this->dataModel->alokasiAll()->where('idalokasi',$id)->get(),
            'dataDetail' => $this->dataModel->detailAlokasi()->where('idalokasi',$id)->get()
        ];
        return view('detailList', $data);
    }
    public function createList($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }

        $data = [
            "halo" => "Halllo",
            "judul" => "Nambah Data $id",
            // 'dataCoba' => $this->dataModel->allData()
        ];
        return view('createList', $data);
    }

    public function list(){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        $user = $this->dataModel->user()->select('iduser')->where('username',session('username'))->get();
        $iduser = $user[0]->iduser;
    	$data = [
    		"halo" => "Data AL",
    		"judul" => "Data Alokasi",
    		'data' => $this->dataModel->alokasiAll()->where('iduser',$iduser)->orderBy('date','desc')->get(),
    	];
    	return view('list', $data);
    }
    public function update($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }

    	$data = [
    		"halo" => "Data Motor",
    		"judul" => "Coba coba",
    		'dataCoba' => $this->dataModel->bigData()->find($id)
    	];
    	return view('update', $data);
    }
    public function delAlokasi($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }
        #hapus file
        $data = $this->dataModel->alokasi()->select('doc')->where('idalokasi', $id)->get();
        $data1 = $this->dataModel->detailAlokasi()->select('doc')->where('idalokasi', $id)->get();

        if(Storage::exists(public_path('d/$data[0]->doc'))){
            unlink(public_path('/d/').$data[0]->doc);
        }
        if(Storage::exists(public_path('d/$data1[0]->doc'))){
            unlink(public_path('/d/').$data1[0]->doc);
        }
        #hapus data tabel
        $this->dataModel->detailAlokasi()->where('idalokasi', $id)->delete();
        $this->dataModel->alokasi()->where('idalokasi', $id)->delete();

        #kembali
        return redirect('/list');
    }
    public function delDetailALokasi($id){
        if(session()->has('username')){
        }else{
            $data=['judul'=>'login'];
            return view('index', $data);
        }

        #hapus file
        $data = $this->dataModel->detailAlokasi()->select('doc','idalokasi')->where('iddetailAlokasi', $id)->get();
        $idalokasi = $data[0]->idalokasi;
        if(Storage::exists(public_path('d/$data[0]->doc'))){
            unlink(public_path('/d/').$data[0]->doc);
        }

        #hapus data tabel
        $this->dataModel->detailAlokasi()->where('iddetailAlokasi', $id)->delete();

        #kembali
        return redirect('/list/detail/'.$idalokasi);
    }
    public function del($id){

    	#hapus file
    	$data = $this->dataModel->bigData()->select('foto')->where('id', $id)->get();
    	@unlink(public_path('/d/').$data[0]->foto);

    	#hapus data tabel
    	$this->dataModel->bigData()->where('id', $id)->delete();

    	#kembali
    	return redirect()->route('list');
    }
    public function updateData(){
    	Request()->validate([
        'nip' => 'required',
        'nama' => 'required',
        'file' => 'required'
    ]);
    	$file = Request()->file;
    	$nameFileNew = '';
    	$dataOld = $this->dataModel->bigData()->select('foto', 'nip')->where('nip', Request()->nip)->get();
    	// echo $nameFileOld[0]->nip;
    	// dd($nameFileOld);
    	if($dataOld[0]->foto == $file){
    		$nameFileNew = $dataOld[0]->foto;
    	}else{
    		@unlink(public_path('/d/').$dataOld[0]->foto);
    		$filename = $file->getClientOriginalName();
    		$nameFileNew = md5($filename . microtime()).'.'.$file->extension();
    		// echo Request()->nip. "|| $file || $nameFileOld";
    		$file->move(public_path('d'),$nameFileNew);
    	}
    	$data = [
    	'nip' => Request()->nip,
    	'nama' => Request()->nama,
    	'foto' => $nameFileNew
    ];
    $this->dataModel->bigData()->where('nip', $dataOld[0]->nip)->update($data);
    return redirect()->route('aku pusing');
    }
    public function insert(Request $request){
    	$validated = $request->validate([
        'nip' => 'required',
        'nama' => 'required',
        'file' => 'required'
    ]);

    	$file = Request()->file;
    	$filename = $file->getClientOriginalName();
    	$generator = md5($filename . microtime()).'.'.$file->extension();
    	$file->move(public_path('d'),$generator);
    	$data = [
    	'nip' => Request()->nip,
    	'nama' => Request()->nama,
    	'foto' => $generator
    ];
    $this->dataModel->addData($data);
    return redirect()->route('aku pusing');
    }

    
}
