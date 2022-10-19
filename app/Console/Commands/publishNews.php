<?php

namespace App\Console\Commands;

use App\Model\News;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class publishNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check publishe time of news and clear the cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        reFlushWebsite();
        DB::table("cache_clear_schedule")->insert([
                                                      'clear_time' => now()
                                                  ]);
    }
}
