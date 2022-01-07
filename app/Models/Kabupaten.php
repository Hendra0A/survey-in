<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'kabupatens';
    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'kabupaten_id');
    }
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
