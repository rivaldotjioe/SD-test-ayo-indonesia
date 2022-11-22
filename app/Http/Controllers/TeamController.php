<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //

    public function index(){
        return Team::all();
    }

    public function update(Request $request, $id){
        $team = Team::find($id);
        try {
            $team->update($request->all());
            return "Team updated";
        } catch (\Throwable $th) {
            return "Error updating team";
        }
    }

    public function create(Request $request)
    {
        $team = new Team();
        $team->nama_team = $request->nama_team;
        $team->tahun_berdiri = $request->tahun_berdiri;
        $team->alamat_markas = $request->alamat_markas;
        $team->kota_markas = $request->kota_markas;
        if (!empty($request->image)) {
            $file =$request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/'), $filename);
            $data['image']= 'public/uploads/'.$filename;
        }
        $team->logo_team = $filename;
        try {
            $team->save();
            return "Data berhasil disimpan";
        } catch (\Throwable $th) {
            //throw $th;
            return "Data gagal disimpan".$th;
        }
    }

    public function delete($id) {
        $team = Team::find($id);
        try {
            $team->delete();
            return "Data berhasil dihapus";
        } catch (\Throwable $th) {
            //throw $th;
            return "Data gagal disimpan";
        }
    }
}
