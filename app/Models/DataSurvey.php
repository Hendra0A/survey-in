<?php

namespace App\Models;

use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        return $this->belongsTo(User::class,);
    }

    public function fasosTable()
    {
        return $this->hasMany(Fasos::class, 'data_survey_id');
    }
    public function lampiranFoto()
    {
        return $this->hasMany(LampiranFoto::class, 'data_survey_id');
    }
    public function konstruksiJalan()
    {
        return $this->belongsTo(JenisKonstruksiJalan::class, 'jenis_konstruksi_jalan_id');
    }
    public function konstruksiSaluran()
    {
        return $this->belongsTo(JenisKonstruksiSaluran::class, 'jenis_konstruksi_saluran_id');
    }
}
