<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    protected $table = 'team';
    protected $primaryKey = 'id_team';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'id_team',
        'nama_team',
        'tahun_berdiri',
        'alamat_markas',
        'kota_markas',
        'deleted_at'
    ];
    use HasFactory;
    use SoftDeletes;

    public static function isTeamDeleted($id): bool
    {
        $team = Team::withTrashed()
            ->where('id_team', $id)->first();
        if (is_null($team->deleted_at)) {
            return false;
        } else {
            return true;
        }
    }

    public static function getTeamName($id): string
    {
        $team = Team::where('id_team', $id)->first();
        return $team->nama_team;
    }
}
