<?php

namespace XTrees\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use XTrees\CMS\Models\Category;
use XTrees\CMS\Models\Collection;
use XTrees\CMS\Models\Content;
use XTrees\CMS\Models\Image;
use XTrees\CMS\Models\Menu;
use XTrees\CMS\Models\Offer;
use XTrees\CMS\Models\Role;
use XTrees\CMS\Models\User;
use Xtrees\LaraSetting\Models\SettingGroup;
use Xtrees\LaraSetting\Models\SettingModel;

class ExampleDataSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:example {--prod}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description ';

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
        $this->defaultSettings();
        $this->createRoles();
        $this->creatOffers();

        if (!$this->option('prod')) {
            Category::factory()->count(3)->create();
            $contents = Content::factory()->count(100)->create();
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
            $this->createUsers();
        }
        $this->createCollections();
        $this->createMenus();
        return 0;
    }

    protected function createUsers()
    {
        User::query()->firstOrCreate([
            'email' => 'admin@admin.com'
        ], [
            'name' => '哈哈',
            'password' => Hash::make('11223344'),
        ]);
        User::factory()->count(20)->create();
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
            $contents = Content::query()->inRandomOrder()->take(12)->get();
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

    protected function defaultSettings()
    {
        SettingGroup::query()->firstOrCreate([
            'title' => '网站设置',
            'key' => 'site',
            'order' => 1
        ]);

        $settings = [
            [
                'title' => '网站名称',
                'group' => 'site',
                'key' => 'name',
                'type' => 'text',
                'value' => 'CMS',
                'eager' => 1
            ],
            [
                'title' => '网站logo',
                'group' => 'site',
                'key' => 'logo',
                'type' => 'text',
                'value' => '',
                'eager' => 1
            ],
        ];

        foreach ($settings as $setting) {
            SettingModel::query()->firstOrCreate($setting);
        }
    }

    protected function createRoles()
    {
        $data = [
            [
                'name' => '普通会员',
                'price' => 0,
                'permission' => 0,
            ], [
                'name' => 'VIP',
                'price' => 0.3,
                'permission' => 1,
            ], [
                'name' => 'SVIP',
                'price' => 1,
                'permission' => 2,
            ]
        ];

        foreach ($data as $datum) {
            Role::query()->firstOrCreate($datum);
        }
    }

    protected function creatOffers()
    {
        $coins = [
            10, 30, 50, 100, 200, 500
        ];
        foreach ($coins as $i => $coin) {
            Offer::query()->firstOrCreate([
                'type' => Offer::COIN,
                'duration' => $coin,
            ], [
                'origin' => $coin,
                'price' => $coin,
                'sort' => $i,
                'display' => true
            ]);
        }

        $vips = [
            [
                'attr' => [
                    'type' => Offer::VIP,
                    'role_id' => 1,
                    'duration' => 30,
                ],
                'val' => [
                    'origin' => 25,
                    'price' => 25,
                    'sort' => 1,
                    'display' => true
                ]
            ],
            [
                'attr' => [
                    'type' => Offer::VIP,
                    'role_id' => 1,
                    'duration' => 180,
                ],
                'val' => [
                    'origin' => 150,
                    'price' => 128,
                    'sort' => 2,
                    'display' => true
                ]
            ],
            [
                'attr' => [
                    'type' => Offer::VIP,
                    'role_id' => 1,
                    'duration' => 360,
                ],
                'val' => [
                    'origin' => 300,
                    'price' => 199,
                    'sort' => 3,
                    'display' => true
                ]
            ],
        ];
        foreach ($vips as $vip) {
            Offer::query()->firstOrCreate($vip['attr'], $vip['val']);
        }

    }
}
