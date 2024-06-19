<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
        return (new MailMessage)
            ->greeting("Halo $notifiable->username!")
            ->subject('Verifikasi Alamat Email')
            ->line('Klik tombol dibawah untuk verifikasi email.')
            ->action('Verifikasi Alamat Email', $url)
            ->line("Hormat Kami,")
            ->salutation('Tim, ' . config('app.name'));
        });
        
        Gate::define('update-job', function (User $user, Vacancy $job) {
            return $job->user_id === $user->id;
        });
    }
}
