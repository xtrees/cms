<?php

namespace XTrees\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use XTrees\CMS\Models\Category;
use XTrees\CMS\Models\Collection;
use XTrees\CMS\Models\Content;
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
        Category::factory()->count(5)->create();
        Content::factory()->count(200)->create();

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
        $contents = range(1, 200);
        //创建默认的文章分组
        foreach ($collections as $collection) {
            /** @var Collection $co */
            $co = Collection::query()->firstOrCreate($collection);
            $co->contents()->sync(Arr::random($contents, 20));
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
