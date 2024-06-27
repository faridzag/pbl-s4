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
        'start_date', 
        'end_date',
        'location',
        'description',
        'status',
        ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'event_company')->withTimestamps();
    }
}
