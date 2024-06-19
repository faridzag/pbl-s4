<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $table = 'applicant_profiles';
    protected $primaryKey = 'id_number';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_number',
        'birth_date',
        'gender',
        'phone_number',
        'profile_picture_path',
        'description',
        'cv_path',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
