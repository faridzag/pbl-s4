<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, AuthorizesRequests;
    protected $table = 'company_profiles';
    protected $fillable = [
        'description',
        'address',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_company')->withTimestamps();
    }
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
}
