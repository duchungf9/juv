<?php

namespace App\Console\Commands;

use App\Model\News;
use Illuminate\Console\Command;

class NewsRemoveNull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean News all';

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
        if (!$this->confirm('Bạn muốn clean dữ liệu không ?')) {
            echo 'Stop tiến trình';

            return false;
        }

        //
        $count = News::count();
        $bar   = $this->output->createProgressBar($count);
        $bar->start();
        $news = News::all();
        foreach ($news as  $new) {
            $bar->advance();
            if(empty($new->title)){
                $new->delete();
            }
        }

        return 'Đã hoàn thành seed !';
        die;
    }
}
