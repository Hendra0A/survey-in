<?php

namespace App\Models;

use App\Models\DataSurvey;
use App\Models\DetailSurveys;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'users';
    protected $dates = ['deleted_at'];

    public function dataSurvey()
    {
        return $this->hasMany(DataSurvey::class, 'user_id');
    }
    public function detailSurvey()
    {
        return $this->hasMany(DetailSurveys::class, 'user_id');
    }
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
}
