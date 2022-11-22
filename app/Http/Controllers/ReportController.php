<?php

namespace App\Http\Controllers;

use App\Models\Hasil_Pertandingan;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function reportHasilPertandingan()
    {
        $hasil_pertandingan = (new \App\Models\Hasil_Pertandingan)->getReportAll();

        foreach ($hasil_pertandingan as $key => $value) {
            $value->nama_team_tuan_rumah = (new \App\Models\Team)->getTeamName($value->id_team_tuan_rumah);
            $value->nama_team_tamu = (new \App\Models\Team)->getTeamName($value->id_team_tamu);
            $value->status_akhir_pertandingan = $this->getStatusAkhirPertandingan($value->skor_tuan_rumah, $value->skor_team_tamu);
            $value->pemain_gol_terbanyak = (new \App\Models\Pemain)->getPemainGolTerbanyak($value->id_pertandingan)->first();
            $value->akumulasi_kemenangan_home = (new \App\Models\Hasil_Pertandingan())->getAkumulasiKemenanganHome($value->id_team_tuan_rumah, $value->id_hasil_pertandingan);
            $value->akumulasi_kemenangan_away = (new \App\Models\Hasil_Pertandingan())->getAkumulasiKemenanganAway($value->id_team_tamu, $value->id_hasil_pertandingan);
        }
//        dd($hasil_pertandingan);
        return $hasil_pertandingan;
    }

    public function getStatusAkhirPertandingan($skor_tuan_rumah, $skor_team_tamu)
    {
        if ($skor_tuan_rumah > $skor_team_tamu) {
            return "Team Home Menang";
        } else if ($skor_tuan_rumah < $skor_team_tamu) {
            return "Team Away Menang";
        } else {
            return "Draw";
        }
    }


}
