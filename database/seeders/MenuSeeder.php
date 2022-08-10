<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuBlock;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'menu' => [
                    'name' => 'Header',
                    'code' => 'header'
                ],
                'items' => [
                    [
                        'title' => 'Pricing',
                        'link' => 'subscription-plans'
                    ],
                    [
                        'title' => 'About Us',
                        'link' => 'about-us'
                    ],
                    [
                        'title' => 'How It Works',
                        'link' => 'how-it-works'
                    ],
                    [
                        'title' => 'FAQ',
                        'link' => 'faq'
                    ],
                    [
                        'title' => 'Contact Us',
                        'link' => 'contact-us'
                    ],
                ]
            ],
            [
                'menu' => [
                    'name' => 'Footer 1',
                    'code' => 'footer-1'
                ],
                'items' => [
                    [
                        'title' => 'How It Works',
                        'link' => 'how-it-works'
                    ],
                    [
                        'title' => 'Pricing',
                        'link' => 'subscription-plans'
                    ],
                    [
                        'title' => 'FAQ',
                        'link' => 'faq'
                    ],
                ]
            ],
            [
                'menu' => [
                    'name' => 'Footer 2',
                    'code' => 'footer-2'
                ],
                'items' => [
                    [
                        'title' => 'About Us',
                        'link' => 'about-us'
                    ],
                ]
            ],
            [
                'menu' => [
                    'name' => 'Footer 3',
                    'code' => 'footer-3'
                ],
                'items' => [

                ]
            ],
            [
                'menu' => [
                    'name' => 'Footer Bottom',
                    'code' => 'footer-bottom'
                ],
                'items' => [
                    [
                        'title' => 'Terms',
                        'link' => 'terms'
                    ],
                    [
                        'title' => 'Privacy',
                        'link' => 'privacy'
                    ],
                ]
            ],
        ];

        foreach ($menus as $menu) {
            $m = Menu::updateOrCreate(
                [
                    'code' => $menu['menu']['code']
                ],
                $menu['menu']
            );

            foreach ($menu['items'] as $i => $item) {
                $item['sort'] = $i;
                $iObj = $m->items()->updateOrCreate(
                    [
                        'title' => $item['title'],
                        'link' => $item['link']??null,
                    ],
                    [
                        'title' => $item['title'],
                        'link' => $item['link']??null,
                        'icon' => $item['icon']??null,
                        'sort' => $i,
                    ]
                );

                foreach ($item['items']??[] as $ii => $child) {
                    $m->items()->updateOrCreate(
                        [
                            'title' => $child['title'],
                            'link' => $child['link']??null,
                            'parent_id' => $iObj->id
                        ],
                        [
                            'title' => $child['title'],
                            'link' => $child['link']??null,
                            'sort' => $ii,
                            'parent_id' => $iObj->id
                        ]
                    );
                }
            }
        }

    }
}
