<?php

namespace App\Http\Controllers;

use App\Models\Hasil_Pertandingan;
use Illuminate\Http\Request;

class HasilPertandinganController extends Controller
{
    //

    public function update(Request $request, $id)
    {
        $hasil_pertandingan = Hasil_Pertandingan::find($id);
        try {
            $hasil_pertandingan->update($request->all());
            return "Hasil pertandingan updated";
        } catch (\Throwable $th) {
            return "Error updating hasil pertandingan";
        }
    }
}
