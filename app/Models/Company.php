<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company_profiles';
    protected $fillable = [
        'name',
        'description',
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
}
