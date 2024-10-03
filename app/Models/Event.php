<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $dates = ['start_date', 'end_date'];
    protected $fillable = [
        'name',
        'image',
        'start_date',
        'event_type',
        'end_date',
        'location',
        'description',
        'status',
        ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'event_company')->withTimestamps();
    }
    public function jobVacancies() {
        return $this->hasMany(Vacancy::class);
    }

    public function jobApplications() {
        return $this->hasMany(Application::class);
    }
}
