<?php

namespace App\Http\Controllers;

use App\Models\Log_Gol;
use Illuminate\Http\Request;

class LogGolController extends Controller
{
    //
    public function index(){
        return Log_Gol::all();
    }

    public function create(Request $request){
        $log_gol = new Log_Gol();
        $log_gol->id_pemain = $request->id_pemain;
        $log_gol->id_pertandingan = $request->id_pertandingan;
        $log_gol->waktu_gol = $request->waktu_gol;
        try {
            $log_gol->save();
            return "Log gol berhasil disimpan";
        } catch (\Throwable $th) {
            return "Log gol gagal disimpan".$th;
        }
    }
}
