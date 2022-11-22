<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bertanding extends Model
{
    protected $table = 'bertanding';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_team_tuan_rumah',
        'id_pertandingan',
        'id_team_tamu',
        'deleted_at'
    ];
    use HasFactory;
}
