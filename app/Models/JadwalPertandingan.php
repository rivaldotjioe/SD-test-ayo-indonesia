<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPertandingan extends Model
{
    protected $table = 'jadwal_pertandingan';
    protected $primaryKey = 'id_pertandingan';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'id_pertandingan',
        'id_hasil_pertandingan',
        'waktu_pertandingan',
        'deleted_at'
    ];
    use HasFactory;
}
