<?php

namespace App\Models;

use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataSurvey extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fasosTable()
    {
        return $this->hasMany(Fasos::class, 'data_survey_id');
    }

    public function jenisFasos()
    {
        return $this->belongsToMany(JenisFasos::class, 'fasos');
    }

    public function lampiranFoto()
    {
        return $this->hasMany(LampiranFoto::class, 'data_survey_id');
    }

    public function jenisLampiran()
    {
        return $this->belongsToMany(JenisLampiran::class, 'lampiran_fotos');
    }
}
