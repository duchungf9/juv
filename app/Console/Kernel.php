<?php

namespace App\Console;

use App\Console\Commands\crawlICODrop;
use App\Console\Commands\publishNews;
use App\Model\News;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\SetupRedis::class,
        \App\Console\Commands\Support\Model\CreateModel::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        slogConsole('start');
        $schedule->command('telescope:clear')->everySixHours();
        $this->publishNews($schedule);
        $schedule->command(crawlICODrop::class)->everyMinute();
        $schedule->command('sitemap:generate')->daily();
        slogConsole('end');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    private function publishNews($schedule){
        $news = News::orderBy("date_start","DESC")->where("date_start",">=",now())->get();
        foreach($news as $new){
//            $schedule->call(function () use ($schedule, $new) {
                if(now()->format("d-m-Y") === (Carbon::parse($new->date_start)->format("d-m-Y"))){
                    $schedule->command(publishNews::class)->dailyAt(Carbon::parse($new->date_start)->format("H:i"));
                    echo "Đã flush !!";
                }
//            })->dailyAt(Carbon::parse($new->date_start)->format("H:i"));
        }
    }
}
