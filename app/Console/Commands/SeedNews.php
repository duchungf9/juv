<?php

namespace App\Console\Commands;

use App\Model\Category;
use App\Model\News;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SeedNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:seed {--categoryId=} {--number=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed News by categoryID';

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
        $cat = Category::find($this->option("categoryId"));
        if ($cat == null) {
            echo "Không tìm thấy danh mục này.";
            die;
        }
        if ($this->confirm("Bạn có muốn seed dữ liệu cho Danh mục : " . $cat->title)) {
            $faker = Factory::create();
            $sort  = News::where("sort", "!=", null)->max("sort") + 1;
            $bar   = $this->output->createProgressBar($this->option("number"));

            $bar->start();
            $homeCount = 1;
            $pinCount  = 1;
            for ($i = 1; $i <= $this->option("number"); $i++) {
                $bar->advance();
                $sort                 = $sort + 1;
                $newNews              = new News();
                $title                = $faker->realText(random_int(25, 90));
                $newNews->category_id = $this->option("categoryId");
                $newNews->title       = $title;
                $newNews->slug        = Str::slug($title);
                $newNews->sort        = $sort;
                $newNews->description = $faker->realText(random_int(300, 800));
                $newNews->date_start  = now()->subDay()->setTime(rand(0, 23), random_int(0, 59), random_int(0, 59));
                $newNews->date        = \Faker\Provider\cs_CZ\DateTime::dateTime();
                $newNews->created_at  = \Faker\Provider\cs_CZ\DateTime::dateTime();
                $newNews->updated_at  = $newNews->created_at;
                if ($homeCount === 1){
                    $newNews->is_home = 1;
                    $homeCount++;
                }
                if ($pinCount ===1) {
                    $newNews->is_pin = 1;
                    $pinCount++;
                }
                $newNews->pub             = 1;
                $newNews->created_by      = 3;
                $newNews->updated_by      = 3;
                $newNews->seo_title       = $faker->realText(random_int(25, 65));
                $newNews->seo_description = $faker->realText(random_int(25, 160));
                $newNews->save();
            }
        }
        $this->info("\n Đã seed xong dữ liệu! \n");
        $bar->finish();
        return "Đã hoàn thành seed !";
        die;

    }
}
