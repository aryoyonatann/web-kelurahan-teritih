<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Auto-cancel permohonan yang tidak ditindaklanjuti admin dalam 72 jam
Schedule::command('permohonan:auto-cancel')->hourly();
