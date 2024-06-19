<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Application extends Model
{ 
    use HasFactory, AuthorizesRequests;
    protected $table = 'job_applications';
    protected $fillable = [
        'applicant_id',
        'user_id',
        'company_id',
        'event_id',
        'vacancy_id'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
