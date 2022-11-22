<?php

namespace App\Http\Controllers;

use App\Models\Pemain;
use Illuminate\Http\Request;

class PemainController extends Controller
{
    public function index()
    {
        return Pemain::all();
    }

    public function update(Request $request, $id)
    {
        $pemain = Pemain::find($id);
        try {
            $pemain->update($request->all());
            return "Pemain updated";
        } catch (\Throwable $th) {
            return "Error updating pemain";
        }
    }

    public function create(Request $request)
    {
        $pemain = new Pemain();
        $pemain->nama_pemain = $request->nama_pemain;
        $pemain->tinggi_badan = $request->tinggi_badan;
        $pemain->id_team = $request->id_team;
        $pemain->berat_badan = $request->berat_badan;
        //Todo check nomor punggung apakah ada yang sama dalam satu tim atau tidak
        if ($pemain->checkIsNomorPunggungExist($request->nomor_punggung, $request->id_team)) {
            return "Nomor punggung sudah ada";
        } else {
            $pemain->nomor_punggung = $request->nomor_punggung;
        }

        try {
            $pemain->save();
            return "Data berhasil disimpan";
        } catch (\Throwable $th) {
            //throw $th;
            return "Data gagal disimpan" . $th;
        }
    }

    public function delete($id)
    {
        $pemain = Pemain::find($id);
        try {
            $pemain->delete();
            return "Data berhasil dihapus";
        } catch (\Throwable $th) {
            //throw $th;
            return "Data gagal dihapus";
        }
    }
}
