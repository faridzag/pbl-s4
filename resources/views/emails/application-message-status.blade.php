<!DOCTYPE html>
<html>
<head>
    <title>Status pelamaran anda</title>
</head>
<body>
    <h2>Hai, {{ $user->name ?? 'pelamar' }},</h2>

    <p>Terkait pelamaran anda untuk <strong>{{ $application->vacancy->position ?? 'posisi' }}</strong>
       di lowongan <strong>{{ $application->vacancy->event->name ?? 'event' }}</strong>:</p>

    <div style="margin: 20px 0;">
        {!! $statusMessage ?? 'tidak ada pesan' !!}
    </div>

    <p>Terimakasih,<br>
    {{ $application->company->user->name ?? 'nama perusahaan'}}</p>
</body>
</html>
