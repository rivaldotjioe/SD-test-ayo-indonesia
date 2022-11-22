<?php

namespace App\Http\Controllers;

use App\Models\Bertanding;
use App\Models\Hasil_Pertandingan;
use App\Models\JadwalPertandingan;
use App\Models\Team;
use Illuminate\Http\Request;

class JadwalPertandinganController extends Controller
{
    //
    public function index()
    {
        return JadwalPertandingan::all();
    }

    public function create(Request $request)
    {
        $jadwal = new JadwalPertandingan();
        $jadwal->waktu_pertandingan = $request->waktu_pertandingan;
        $hasil_pertandingan = new Hasil_Pertandingan();
        $detailPertandingan = new Bertanding();
        if (Team::isTeamDeleted($request->id_team_tuan_rumah) || Team::isTeamDeleted($request->id_team_tamu)) {
            return "Team tidak ditemukan / Telah Di Hapus";
        }
        $detailPertandingan->id_team_tuan_rumah = $request->id_team_tuan_rumah;
        $detailPertandingan->id_team_tamu = $request->id_team_tamu;
        try {
            $hasil_pertandingan->save();
            $jadwal->id_hasil_pertandingan = $hasil_pertandingan->id_hasil_pertandingan;
            $jadwal->save();
            $hasil_pertandingan->id_pertandingan = $jadwal->id_pertandingan;
            $hasil_pertandingan->update();
            $detailPertandingan->id_pertandingan = $jadwal->id_pertandingan;
            $detailPertandingan->save();
            return "Data berhasil disimpan";
        } catch (\Throwable $th) {
            //throw $th;
            return "Data gagal disimpan".$th;
        }
    }
}
