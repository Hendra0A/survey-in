<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LampiranFoto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function dataSurvey()
    {
        return $this->belongsTo(DataSurvey::class, 'data_survey_id');
    }
    public function jenisLampiran()
    {
        return $this->belongsTo(JenisLampiran::class, 'jenis_lampiran_id');
    }
}
