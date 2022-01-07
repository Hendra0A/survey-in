<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLampiran extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];

    public function dataSurvey()
    {
        return $this->belongsToMany(DataSurvey::class, 'lampiran_fotos');
    }
    public function lampiranFoto()
    {
        return $this->hasMany(LampiranFoto::class);
    }
}
