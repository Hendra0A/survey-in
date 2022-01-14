<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fasos extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function dataSurvey()
    {
        return $this->belongsTo(DataSurvey::class);
    }
    public function jenisFasos()
    {
        return $this->belongsTo(JenisFasos::class);
    }
}
