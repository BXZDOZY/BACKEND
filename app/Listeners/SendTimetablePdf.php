<?php

namespace App\Listeners;

use App\Events\TimetableUpdated;
use Illuminate\Bus\Queueable;              // ⇦ AJOUT
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTimetablePdf implements ShouldQueue
{
    use Queueable, InteractsWithQueue;      // ⇦ Les deux traits

    public function handle(TimetableUpdated $event)
    {
        // … votre logique d’envoi de PDF
    }
}
