<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class coba extends Model
{
    use HasFactory;
    public function user(){
        return DB::table('user');
    }
    public function api(){
        return DB::table('api');
    }
    public function level(){
        return DB::table('level');
    }
    public function pengajuan(){
        return DB::table('pengajuan');
    }
    public function status(){
        return DB::table('status');
    }
    public function alokasi(){
        return DB::table('alokasi');
    }
    public function alokasiDapetin($iduser, $tipe){
        // group by year(date),month(date) order by date DESC limit 6
        return DB::select("CALL getAlokasiData(".$iduser.",".$tipe.")");
    }
    public function alokasiDapetinNilai($iduser, $tipe){
        // group by year(date),month(date) order by date DESC limit 6
        return DB::select("CALL getAlokasiData(".$iduser.",".$tipe.")");
    }
    public function alokasiDapetinBulan($iduser, $tipe){
        // group by year(date),month(date) order by date DESC limit 6
        return DB::select("CALL getAlokasiData(".$iduser.",".$tipe.")");
    }
    public function pengajuanStatus(){
        return DB::table('pengajuan')->leftJoin('status','pengajuan.status','=','status.idstatus');
    }
    public function alokasiAll(){
        return DB::table('view_alokasi');
    }
    public function view_level(){
        return DB::table('view_level');
    }
    public function detailAlokasi(){
        return DB::table('detailalokasi');
    }
    public function jenis(){
        return DB::table('jenis');
    }
    public function kelompok(){
        return DB::table('kelompok');
    }
    public function sumber(){
        return DB::table('sumber');
    }
    public function alltipe(){
        return DB::table('view_tipe');
    }

    public function bigData(){
    	return DB::table('cobatabel');
    }
    public function allData(){
    	return DB::table('cobatabel')->get();
    }
    public function addData($data){
    	DB::table('cobatabel')->insertGetId($data);
    }
}
