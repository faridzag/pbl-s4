<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Vacancy extends Model
{
    use HasFactory, AuthorizesRequests;
    protected $table = 'job_vacancies';
    protected $fillable = [
        'user_id',
        'company_id',
        'event_id',
        'position',
        'description',
        'accept_message',
        'reject_message',
        'status'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isApplied()
    {
        // Access the currently logged-in user's applicant ID
        $applicantId = auth()->user()->applicant->id_number;

        // Check for existing application with applicant ID and vacancy ID
        return Application::where('applicant_id', $applicantId)
            ->where('vacancy_id', $this->id)
            ->exists();
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'vacancy_id');
    }
}
