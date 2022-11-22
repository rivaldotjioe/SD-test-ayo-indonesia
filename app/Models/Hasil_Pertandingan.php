<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hasil_Pertandingan extends Model
{
    protected $table = 'hasil_pertandingan';
    protected $primaryKey = 'id_hasil_pertandingan';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'id_hasil_pertandingan',
        'id_pertandingan',
        'skor_tuan_rumah',
        'skor_team_tamu',
        'deleted_at'
    ];
    use HasFactory;

    public function getReportAll(): \Illuminate\Support\Collection
    {
        return DB::table('jadwal_pertandingan')
            ->join('hasil_pertandingan', 'jadwal_pertandingan.id_pertandingan', '=', 'hasil_pertandingan.id_pertandingan')
            ->join('bertanding', 'jadwal_pertandingan.id_pertandingan', '=', 'bertanding.id_pertandingan')
            ->select('*')
            ->get();
    }

    public function getAkumulasiKemenanganHome($id_team_tuan_rumah, $current_id_hasil_pertandingan)
    {
        return DB::table('jadwal_pertandingan')
            ->join('hasil_pertandingan', 'jadwal_pertandingan.id_pertandingan', '=', 'hasil_pertandingan.id_pertandingan')
            ->join('bertanding', 'jadwal_pertandingan.id_pertandingan', '=', 'bertanding.id_pertandingan')
            ->where('bertanding.id_team_tuan_rumah', $id_team_tuan_rumah)
            ->where('hasil_pertandingan.skor_tuan_rumah', '>', 'hasil_pertandingan.skor_team_tamu')
            ->where('jadwal_pertandingan.deleted_at', null)
            ->where('hasil_pertandingan.id_hasil_pertandingan', '<', $current_id_hasil_pertandingan)
            ->count();
    }

    public function getAkumulasiKemenanganAway($id_team_tamu, $id_hasil_pertandingan)
    {
        return DB::table('jadwal_pertandingan')
            ->join('hasil_pertandingan', 'jadwal_pertandingan.id_pertandingan', '=', 'hasil_pertandingan.id_pertandingan')
            ->join('bertanding', 'jadwal_pertandingan.id_pertandingan', '=', 'bertanding.id_pertandingan')
            ->where('bertanding.id_team_tamu', $id_team_tamu)
            ->where('hasil_pertandingan.skor_tuan_rumah', '<', 'hasil_pertandingan.skor_team_tamu')
            ->where('jadwal_pertandingan.deleted_at', null)
            ->where('hasil_pertandingan.id_hasil_pertandingan', '<', $id_hasil_pertandingan)
            ->count();
    }
}
