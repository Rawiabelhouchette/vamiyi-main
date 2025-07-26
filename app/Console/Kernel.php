<?php

namespace App\Console;

use App\Models\Abonnement;
use App\Models\Annonce;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        try {
            $schedule->call(function () {
                $this->clearLivewireTmp();
            })->hourly();

            $schedule->call(function () {
                $this->deactivateSubscription();
            })->daily();

            $schedule->call(function () {
                $this->deactivateAnnonce();
            })->daily();

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

    }

    // After subscription date is expired, deactivate the subscription
    public function deactivateSubscription()
    {
        $abonnements = Abonnement::where('date_fin', '<', now())->get();
        foreach ($abonnements as $annonce) {
            $annonce->update(['is_active' => false]);
        }
    }

    // After annonce date is expired, deactivate the annonce
    public function deactivateAnnonce()
    {
        Annonce::where('date_validite', '<', now())->update(['is_active' => false]);
    }

    public function setDefaultImage()
    {
        $annonce = Annonce::whereNotNull('image')->first();
        Annonce::whereNull('image')->update(['image' => $annonce->image]);
    }

    public function clearLivewireTmp()
    {
        $files = File::files(storage_path('app/livewire-tmp'));

        foreach ($files as $file) {
            // Get the last modified time of the file
            $lastModified = Carbon::createFromTimestamp(filemtime($file));

            // If the file was last modified more than 1 hours ago, delete it
            if ($lastModified->diffInHours(Carbon::now()) > 1) {
                File::delete($file);
            }
        }
    }


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
