<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKonstruksiJalan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];
    public function dataSurvey()
    {
        return $this->hasMany(DataSurvey::class);
    }
}
