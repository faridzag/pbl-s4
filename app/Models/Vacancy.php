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
        'company_id',
        'event_id',
        'position',
        'description',
        'status',
        'user_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }    
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public static function scopeCurrentCompany($query, int $companyId)
    {
        $query->whereHas('company', function ($query) use ($companyId) {
            $query->where('id', $companyId);
        });
    }
}
