<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->menus() as $data):
            $menu =  \Chicorycom\Cigaformation\Models\Menu::create([
                'name' => $data['name'],
                'type' => 'ADMIN',
                'slug' =>  $data['slug'],
                'icon' => isset($data['icon']) ? $data['icon'] : '',
                //'order' => $data['order'],
                'created_at' => now()
            ]);

            if(!empty($data['submenu'])){
                foreach ($data['submenu'] as $submenu):
                    $menu->children()->create([
                        'name' => $submenu['name'],
                        'type' => 'ADMIN',
                        'slug' =>  $submenu['slug'],
                        'icon' => $submenu['icon'],
                        'order' => $submenu['order'],
                        'created_at' => now()
                    ]);
                endforeach;
            }
        endforeach;
        $i = 1; $j = 1;
        foreach ($this->publicmenu() as $data):
            $menu =  \Chicorycom\Cigaformation\Models\Menu::create([
                'name' => $data['name'],
                'type' => 'PUBLIC',
                'slug' =>  $data['slug'],
                'order' => $i,
            ]);

            if(!empty($data['submenu'])){
                foreach ($data['submenu'] as $submenu):
                    $menu->children()->create([
                        'name' => $submenu['name'],
                        'type' => 'PUBLIC',
                        'slug' =>  $submenu['slug'],
                        'order' => $j,
                    ]);
                $j++;
                endforeach;
            }
            $i++;
        endforeach;

    }

    private function menus(){
        return [
            [
                'name'=> 'Dashboard',
                'slug'=> '/dashboard',
                'icon'=> 'fas fa-fw fa-tachometer-alt',
                'order'=> 1
            ],
            [
                'name'=> 'Interface',
                'slug'=> '/interface',
                'submenu' => [
                    [
                        'name' => 'Slide',
                        'slug' => '/slide',
                        'icon' => 'fab fa-slideshare',
                        'order'=> 1,
                    ],
                    [
                        'name' => 'Actualités',
                        'slug' => '/actualites',
                        'icon' => 'fas fa-calendar-day',
                        'order'=> 2,
                    ],
                    [
                        'name' => 'Pré-inscription',
                        'slug' => '/pre-registrations',
                        'icon' => 'fad fa-folder',
                        'order'=> 3,
                    ],
                    [
                        'name' => 'Pages',
                        'slug' => '/pages',
                        'icon' => 'fas fa-pager',
                        'order'=> 4,
                    ],
                    [
                        'name' => 'Formations',
                        'slug' => '/formations',
                        'icon' => 'fas fa-window-maximize',
                        'order'=> 5,
                    ],
                    [
                        'name' => 'Catégories',
                        'slug' => '/category',
                        'icon' => 'fas fa-window-maximize',
                        'order'=> 6,
                    ]
                ]
            ],
            [
                'name'=> 'Settings',
                'slug'=> '/settings',
                'submenu' => [
                    [
                        'name' => 'Menus',
                        'slug' => '/menus',
                        'icon' => 'fas fa-bars',
                        'order'=> 1,
                    ],
                    [
                        'name' => 'Users',
                        'slug' => '/users',
                        'icon' => 'fas fa-users',
                        'order'=> 2,
                    ],
                    [
                        'name' => 'Settings',
                        'slug' => '/submenu-settings',
                        'icon' => 'fas fa-cogs',
                        'order'=> 3,
                    ]
                ]
            ],
        ];
    }

    private function publicmenu(){
        return [
            [
                'name'=> 'Acceil',
                'slug'=> 'home',
            ],
            [
                'name'=> 'A Propos',
                'slug'=> 'about',
            ],
            [
                'name'=> 'Campus',
                'slug'=> 'campus',
                'submenu' => [
                    [
                        'name' => 'Campus Guediaway',
                        'slug' => 'campus-guediaway',
                    ],
                    [
                        'name' => 'Campus Malika',
                        'slug' => 'campus-malika',
                    ],
                ]
            ],
            [
                'name'=> 'Formations',
                'slug'=> 'public-formations',
                'submenu' => [
                    [
                        'name' => 'Formation Initiale',
                        'slug' => 'formation-initiale',
                    ],
                    [
                        'name' => 'Formation Continue',
                        'slug' => 'formation-continue',
                    ],
                    [
                        'name' => 'Formation Modulaire',
                        'slug' => 'formation-modulaire',
                    ],
                ]
            ],
            [
                'name' => 'Labs',
                'slug' => 'labs',
                'submenu' => [
                    [
                        'name' => 'Rech & Innov',
                        'slug' => 'rech-innov',
                    ],
                ]
            ],
            [
                'name' => 'Cdoc',
                'slug' => 'cdoc',
            ],
            [
                'name' => 'Opportunites',
                'slug' => 'opportunites',
            ],

        ];
    }

}
