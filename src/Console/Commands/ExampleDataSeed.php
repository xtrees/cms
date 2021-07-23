<?php

namespace XTrees\CMS\Console\Commands;

use Illuminate\Console\Command;
use XTrees\CMS\Models\Category;
use XTrees\CMS\Models\Collection;
use XTrees\CMS\Models\Content;
use XTrees\CMS\Models\Image;
use XTrees\CMS\Models\Menu;

class ExampleDataSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:example';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Category::factory()->count(3)->create();
        $contents = Content::factory()->count(1000)->create();
        /** @var Content $content */
        foreach ($contents as $content) {
            Image::factory()->state([
                'cover' => 1,
                'content_id' => $content->id,
            ])->count(1)->create();

            if ($content->isGallery()) {
                //generate gallery images
                $total = mt_rand(5, 15);
                Image::factory()->state([
                    'content_id' => $content->id,
                ])->count($total)->create();
            }
        }

        $this->createCollections();
        $this->createMenus();
        return 0;
    }

    protected function createCollections()
    {
        $collections = [
            [
                'name' => '推荐位-1',
                'slug' => 'rem1',
            ],
            [
                'name' => '推荐位-2',
                'slug' => 'rem2',
            ],
            [
                'name' => '推荐位-3',
                'slug' => 'rem3',
            ],
            [
                'name' => '推荐位-4',
                'slug' => 'rem4',
            ]
        ];
        //创建默认的文章分组
        foreach ($collections as $collection) {
            /** @var Collection $co */
            $co = Collection::query()->firstOrCreate($collection);
            $contents =Content::query()->inRandomOrder()->take(12)->get();
            $co->contents()->sync($contents);
        }
    }

    protected function createMenus()
    {
        $data = [
            [
                'name' => '顶部导航栏',
                'slug' => 'navbar',
                'items' => [
                    [
                        'title' => '首页',
                        'icon' => '',
                        'url' => '/',
                        'target' => '_self',
                        'sort' => 1
                    ]
                ]
            ],
            [
                'name' => '底部导航',
                'slug' => 'footer',
                'items' => [
                    [
                        'title' => '关于我们',
                        'icon' => '',
                        'url' => '/about-us.html',
                        'target' => '_self',
                        'sort' => 1
                    ],
                    [
                        'title' => '联系我们',
                        'icon' => '',
                        'url' => '/contact-us.html',
                        'target' => '_self',
                        'sort' => 2
                    ]
                ]
            ],
            [
                'name' => '导航1',
                'slug' => 'nav-1',
                'items' => [
                    [
                        'title' => '关于我们',
                        'icon' => '',
                        'url' => '/about-us.html',
                        'target' => '_self',
                        'sort' => 1
                    ],
                    [
                        'title' => '联系我们',
                        'icon' => '',
                        'url' => '/contact-us.html',
                        'target' => '_self',
                        'sort' => 2
                    ]
                ]
            ]
        ];

        foreach ($data as $datum) {
            $items = $datum['items'];
            unset($datum['items']);
            /** @var Menu $menu */
            $menu = Menu::query()->firstOrCreate($datum);
            if ($menu->wasRecentlyCreated) {
                $menu->parentItems()->createMany($items);
            }
        }
    }
}
