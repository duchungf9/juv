<?php

namespace App\Console\Commands;

use App\Model\Category;
use App\Model\News;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ClearCacheAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear_cache_all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all site';

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
        reFlushAdmin();
        reFlushWebsite();
    }
}
