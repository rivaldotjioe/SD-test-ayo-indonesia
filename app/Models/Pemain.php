<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pemain extends Model
{
    protected $table = 'pemain';
    protected $primaryKey = 'id_pemain';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'id_pemain',
        'id_team',
        'nama_pemain',
        'tinggi_badan',
        'berat_badan',
        'nomor_punggung',
        'deleted_at'
    ];
    use HasFactory;

    public function checkIsNomorPunggungExist($nomor_punggung, $id_team): bool
    {
        $pemain = Pemain::where('nomor_punggung', $nomor_punggung)->where('id_team', $id_team)->first();
        if($pemain == null){
            return false;
        } else {
            return true;
        }
    }

    public function getPemainGolTerbanyak($id_pertandingan)
    {
        return Pemain::join('log_gol', 'pemain.id_pemain', '=', 'log_gol.id_pemain')
            ->join('team', 'pemain.id_team', '=', 'team.id_team')
            ->where('log_gol.id_pertandingan', $id_pertandingan)
            ->select('pemain.id_pemain', 'pemain.nama_pemain', 'team.nama_team', 'pemain.nomor_punggung', DB::raw('count(*) as jumlah_gol'))
            ->groupBy('pemain.id_pemain', 'pemain.nama_pemain', 'team.nama_team', 'pemain.nomor_punggung')
            ->orderBy('jumlah_gol', 'desc')
            ->get();
    }
}
