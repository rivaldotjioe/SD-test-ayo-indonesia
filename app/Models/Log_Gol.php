<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_Gol extends Model
{
    protected $table = 'log_gol';
    protected $primaryKey = 'id_log_gol';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'id_log_gol',
        'id_pemain',
        'id_pertandingan',
        'waktu_gol',
        'deleted_at'
    ];
    use HasFactory;
}
