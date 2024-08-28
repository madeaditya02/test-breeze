<?php

use App\Models\Plan;
use Illuminate\Support\Str;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function() {
    Plan::create([
        'id' => Str::random(5),
        'name' => 'Trip to Papua'
    ]);
})->everySecond();