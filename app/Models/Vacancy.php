<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $table = 'job_vacancies';
    protected $fillable = [
        'company_id',
        'event_id',
        'position',
        'description',
        'status',
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
