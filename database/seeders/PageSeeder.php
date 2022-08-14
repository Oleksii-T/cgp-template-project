<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageBlock;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds of pages and related blocks.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'page' => [
                    'status' => 'static',
                    'title' => 'Landing',
                    'link' => '/',
                ],
                'blocks' => [
                    [
                        'name' => 'top',
                        'data' => [
                            'title' => [
                                'value' => 'Practice day trading the market, without risking a single penny',
                                'type' => 'text'
                            ],
                            'text' => [
                                'value' => 'Use TradingSim to test strategies, boost confidence, and increase your profitability.',
                                'type' => 'text'
                            ],
                            'signup' => [
                                'value' => 'Sign Up',
                                'type' => 'text'
                            ]
                        ]
                    ],
                    [
                        'name' => 'features',
                        'data' => [
                            'title' => [
                                'value' => 'Our Features',
                                'type' => 'text'
                            ],
                            'text' => [
                                'value' => 'Boost up your work with advance and flexible features',
                                'type' => 'text'
                            ],
                            'items' => [
                                'type' => 'dynamic',
                                'blocks' => [
                                    [
                                        'image' => [
                                            'value' => 'landing-features-meat.svg',
                                            'type' => 'image'
                                        ],
                                        'title' => [
                                            'value' => 'Load Simulation',
                                            'type' => 'text'
                                        ],
                                        'text' => [
                                            'value' => 'Load and simulate personal charts with different data',
                                            'type' => 'text'
                                        ],
                                    ],
                                    [
                                        'image' => [
                                            'value' => 'landing-features-fish.svg',
                                            'type' => 'image'
                                        ],
                                        'title' => [
                                            'value' => 'Charts',
                                            'type' => 'text'
                                        ],
                                        'text' => [
                                            'value' => 'Set up different type of charts on your dashboard',
                                            'type' => 'text'
                                        ],
                                    ],
                                    [
                                        'image' => [
                                            'value' => 'landing-features-donut.svg',
                                            'type' => 'image'
                                        ],
                                        'title' => [
                                            'value' => 'Market Scanner',
                                            'type' => 'text'
                                        ],
                                        'text' => [
                                            'value' => 'Personal market scanner to make your simulation',
                                            'type' => 'text'
                                        ],
                                    ],
                                    [
                                        'image' => [
                                            'value' => 'landing-features-orange.svg',
                                            'type' => 'image'
                                        ],
                                        'title' => [
                                            'value' => 'Analytics',
                                            'type' => 'text'
                                        ],
                                        'text' => [
                                            'value' => 'Best analytic tools for simulated charts',
                                            'type' => 'text'
                                        ],
                                    ],
                                ]
                            ],
                        ]
                    ],
                    [
                        'name' => 'about-us',
                        'data' => [
                            'title' => [
                                'value' => 'About Us',
                                'type' => 'text'
                            ],
                            'text' => [
                                'value' => 'Some information about our company',
                                'type' => 'text'
                            ],
                            'block-1-title' => [
                                'value' => 'What we believe',
                                'type' => 'text'
                            ],
                            'block-1-text' => [
                                'value' => '<p>At Company we believe that traders are made not born. We feel that regardless of your background or financial situation you can achieve consistency in trading.</p>
                                    <p>We do not subscribe to the idea you can follow someone else\'s trades or alerts to profits. We think that trading is more than money and is the ultimate test of oneself.</p>
                                    <p>We are learning from our customers everyday and will not rest until everyone has a fair shot at building sustainable financial freedom.</p>
                                ',
                                'type' => 'editor'
                            ],
                            'block-1-image' => [
                                'value' => 'landing-about-us-block-1.png',
                                'type' => 'image'
                            ],
                            'block-2-title' => [
                                'value' => 'We don\'t create charts, we create freedom',
                                'type' => 'text'
                            ],
                            'block-2-text' => [
                                'value' => '<p>At Company we believe that traders are made not born. We feel that regardless of your background or financial situation you can achieve consistency in trading.</p>
                                    <p>We do not subscribe to the idea you can follow someone else\'s trades or alerts to profits. We think that trading is more than money and is the ultimate test of oneself.</p>
                                    <p>We are learning from our customers everyday and will not rest until everyone has a fair shot at building sustainable financial freedom.</p>
                                ',
                                'type' => 'editor'
                            ],
                            'block-2-image' => [
                                'value' => 'landing-about-us-block-2.png',
                                'type' => 'image'
                            ],
                        ]
                    ],
                    [
                        'name' => 'header',
                        'data' => [
                            'logo' => [
                                'value' => 'logo.svg',
                                'type' => 'image'
                            ],
                            'account' => [
                                'value' => 'Account',
                                'type' => 'text'
                            ],
                            'logout' => [
                                'value' => 'Logout',
                                'type' => 'text'
                            ],
                            'login' => [
                                'value' => 'Log in',
                                'type' => 'text'
                            ]
                        ]
                    ],
                    [
                        'name' => 'footer',
                        'data' => [
                            'logo' => [
                                'value' => 'logo.svg',
                                'type' => 'image'
                            ],
                            'text' => [
                                'value' => 'Best trading simulation app, built for traders by traders.',
                                'type' => 'text'
                            ],
                            'copyright' => [
                                'value' => '© 2021 Company Ltd. All rights reserved.',
                                'type' => 'text'
                            ],
                            'menu-1' => [
                                'value' => 'Product',
                                'type' => 'text'
                            ],
                            'menu-2' => [
                                'value' => 'Company',
                                'type' => 'text'
                            ],
                            'menu-3' => [
                                'value' => 'Contact Us',
                                'type' => 'text'
                            ],
                            'email' => [
                                'value' => 'support@mail.com',
                                'type' => 'text'
                            ],
                        ]
                    ],
                ]
            ],
            [
                'page' => [
                    'status' => 'static',
                    'title' => 'Subscription Plans',
                    'link' => 'subscription-plans',
                ],
                'blocks' => [
                    [
                        'name' => 'top',
                        'data' => [
                            'title' => [
                                'value' => 'Pricing',
                                'type' => 'text'
                            ],
                            'text' => [
                                'value' => 'Here are some screenshots of our product and features',
                                'type' => 'text'
                            ],
                        ]
                    ],
                    [
                        'name' => 'content',
                        'data' => [
                            'subscribed' => [
                                'value' => 'Subscribed',
                                'type' => 'text'
                            ],
                            'subscribe' => [
                                'value' => 'Sign up',
                                'type' => 'text'
                            ],
                        ]
                    ],
                ]
            ],
            [
                'page' => [
                    'status' => 'static',
                    'title' => 'Contact Us',
                    'link' => 'contact-us',
                ],
                'blocks' => [
                    [
                        'name' => 'top',
                        'data' => [
                            'title' => [
                                'value' => 'Contact us',
                                'type' => 'text'
                            ],
                            'text' => [
                                'value' => 'Leave a feedback',
                                'type' => 'text'
                            ],
                        ]
                        ],
                    [
                        'name' => 'content',
                        'data' => [
                            'title' => [
                                'value' => 'Contact us',
                                'type' => 'text'
                            ],
                            'title' => [
                                'value' => 'Title',
                                'type' => 'text'
                            ],
                            'email' => [
                                'value' => 'Email Address',
                                'type' => 'text'
                            ],
                            'content' => [
                                'value' => 'Content',
                                'type' => 'text'
                            ],
                            'send' => [
                                'value' => 'Send',
                                'type' => 'text'
                            ],
                        ]
                    ],
                ]
            ],
            [
                'page' => [
                    'status' => 'static',
                    'title' => 'Profile',
                    'link' => 'profile',
                ],
                'blocks' => [
                    [
                        'name' => 'top',
                        'data' => [
                            'title' => [
                                'value' => 'Account',
                                'type' => 'text'
                            ],
                            'text' => [
                                'value' => 'Change your profile and account setting',
                                'type' => 'text'
                            ],
                        ]
                    ],
                    [
                        'name' => 'sidebar',
                        'data' => [
                            'account-details' => [
                                'value' => 'Account Details',
                                'type' => 'text'
                            ],
                            'subscriptions' => [
                                'value' => 'Subscriptions',
                                'type' => 'text'
                            ],
                            'payment-methods' => [
                                'value' => 'Payment Methods',
                                'type' => 'text'
                            ],
                            'logout' => [
                                'value' => 'Logout',
                                'type' => 'text'
                            ],
                        ]
                    ],
                    [
                        'name' => 'account-details',
                        'data' => [
                            'title' => [
                                'value' => 'Account Details',
                                'type' => 'text'
                            ],
                            'avatar' => [
                                'value' => 'Avatar',
                                'type' => 'text'
                            ],
                            'personal-info' => [
                                'value' => 'Personal Information',
                                'type' => 'text'
                            ],
                            'name' => [
                                'value' => 'Name',
                                'type' => 'text'
                            ],
                            'email' => [
                                'value' => 'Email Address',
                                'type' => 'text'
                            ],
                            'password-change' => [
                                'value' => 'Password Change',
                                'type' => 'text'
                            ],
                            'new-password' => [
                                'value' => 'New Password',
                                'type' => 'text'
                            ],
                            'confirm-new-password' => [
                                'value' => 'Confirm New Password',
                                'type' => 'text'
                            ],
                            'save' => [
                                'value' => 'Save Changes',
                                'type' => 'text'
                            ],
                        ]
                    ],
                    [
                        'name' => 'subscriptions',
                        'data' => [
                            'title' => [
                                'value' => 'Subscriptions',
                                'type' => 'text'
                            ],
                            'canceled' => [
                                'value' => 'Canceled',
                                'type' => 'text'
                            ],
                            'cancel' => [
                                'value' => 'Cancel Subscription',
                                'type' => 'text'
                            ],
                            'plan' => [
                                'value' => 'Your Subscription:',
                                'type' => 'text'
                            ],
                            'start' => [
                                'value' => 'Start Date:',
                                'type' => 'text'
                            ],
                            'end' => [
                                'value' => 'Finish Date:',
                                'type' => 'text'
                            ],
                            'active' => [
                                'value' => 'Active',
                                'type' => 'text'
                            ],
                            'active-canceled' => [
                                'value' => 'Active (canceled)',
                                'type' => 'text'
                            ],
                            'empty' => [
                                'value' => 'No subscription found',
                                'type' => 'text'
                            ],
                            'empty-button' => [
                                'value' => 'Sign Up for Plan',
                                'type' => 'text'
                            ],
                        ]
                    ],
                    [
                        'name' => 'payment-methods',
                        'data' => [
                            'title' => [
                                'value' => 'Payment Methods',
                                'type' => 'text'
                            ],
                            'methods' => [
                                'value' => 'Methods',
                                'type' => 'text'
                            ],
                            'expires' => [
                                'value' => 'Expires',
                                'type' => 'text'
                            ],
                            'actions' => [
                                'value' => 'Actions',
                                'type' => 'text'
                            ],
                            'set-default' => [
                                'value' => 'Set as Default',
                                'type' => 'text'
                            ],
                            'is-default' => [
                                'value' => 'Default',
                                'type' => 'text'
                            ],
                            'delete' => [
                                'value' => 'Delete',
                                'type' => 'text'
                            ],
                            'add-button' => [
                                'value' => '+ Add Payment Method',
                                'type' => 'text'
                            ],
                            'add-title' => [
                                'value' => '+ Add Payment Method',
                                'type' => 'text'
                            ],
                            'card-number' => [
                                'value' => 'Card Number',
                                'type' => 'text'
                            ],
                            'card-expiration' => [
                                'value' => 'Expiration Date',
                                'type' => 'text'
                            ],
                            'card-ccv' => [
                                'value' => 'CVV Code',
                                'type' => 'text'
                            ],
                            'add-cancel' => [
                                'value' => 'Cancel',
                                'type' => 'text'
                            ],
                            'add-save' => [
                                'value' => 'Save Card',
                                'type' => 'text'
                            ],
                            'empty' => [
                                'value' => 'No saved method found',
                                'type' => 'text'
                            ],
                        ]
                    ]
                ]
            ],
            [
                'page' => [
                    'status' => 'published',
                    'title' => 'Terms of Usage',
                    'link' => 'terms',
                    'content' => '<h3>Lorem ipsum dolor</h3>
                        <br>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean malesuada dignissim quam, eu scelerisque quam rhoncus at. Proin bibendum porttitor elit ut posuere. Sed neque velit, fermentum vitae laoreet vitae, dapibus sit amet massa. Integer varius massa ac venenatis malesuada. Nunc vitae nisi metus. Nunc tincidunt sodales nibh lobortis rutrum. Proin cursus, ante id ornare mattis, ante nisl consectetur tortor, et faucibus massa dolor sed justo. Donec mollis viverra velit, quis eleifend nisi ultricies ac. Etiam in sollicitudin eros. Ut quis maximus dui, sit amet commodo orci. Fusce vel maximus nulla. Aliquam erat volutpat. In volutpat nibh vel est dapibus, in blandit mauris ornare.
                        </p>
                        <br>
                        <h3>Phasellus cursus</h3>
                        <br>
                        <p>
                            Phasellus cursus massa et tellus mattis fringilla. Phasellus finibus diam non ante placerat luctus. Quisque et tempor purus, at tincidunt dui. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc ac neque et est efficitur malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut in mollis magna, ac iaculis nunc. Integer sit amet nibh eu magna feugiat faucibus.
                        </p>
                        <br>
                        <h3>Integer vel dui</h3>
                        <br>
                        <p>
                            Integer vel dui vitae ante lacinia sagittis. Mauris vitae ligula a quam egestas aliquet. Nulla congue, ipsum vitae mattis tristique, tellus metus imperdiet massa, non rutrum purus ante a diam. Mauris velit velit, vulputate vel magna nec, cursus dictum sem. Donec quis lorem posuere, tincidunt tortor pulvinar, commodo ipsum. Etiam id quam pharetra, tincidunt dui eu, tincidunt quam. Proin egestas arcu dui, non pharetra est tempor sed.
                        </p>
                    '
                ],
            ],
            [
                'page' => [
                    'status' => 'published',
                    'title' => 'Privacy Policy',
                    'link' => 'privacy',
                    'content' => '<h3>Ut dapibus</h3>
                        <br>
                        <p>
                            Ut dapibus, diam ut imperdiet cursus, urna dolor sodales urna, quis tincidunt dolor orci sed diam. Curabitur eu ex venenatis, tincidunt erat at, lobortis justo. Nullam molestie, leo nec ultricies sodales, leo orci mattis ligula, accumsan mollis massa tortor at lorem. Ut molestie sem mi, nec aliquet tortor accumsan ut. Fusce et arcu sit amet libero scelerisque feugiat a nec sapien. Pellentesque euismod turpis vel tortor convallis semper at non dui. Maecenas imperdiet ornare sem, et tempus metus luctus non. Donec leo arcu, imperdiet non volutpat ac, euismod quis ante.
                        </p>
                        <br>
                        <h3>Curabitur ut</h3>
                        <br>
                        <p>
                            Curabitur ut ipsum condimentum metus faucibus interdum vitae in leo. Quisque id ligula nunc. Phasellus dictum bibendum dignissim. Vestibulum mattis ullamcorper molestie. Vivamus sed nibh in diam tempus feugiat. Sed molestie quam vulputate, euismod quam sed, pellentesque risus. Aliquam eget sem nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla fringilla luctus fermentum. Sed leo ex, cursus varius metus blandit, laoreet ultrices sapien. Aliquam erat volutpat. Donec sit amet erat auctor augue tincidunt lacinia. Sed fringilla metus non purus sollicitudin, quis interdum elit sagittis. Curabitur porta dui nulla, commodo imperdiet urna feugiat ac.
                        </p>
                        <br>
                        <h3>Sed nec interdum</h3>
                        <br>
                        <p>
                            Sed nec interdum ante. Sed finibus tempor tincidunt. In tortor ligula, sodales eu posuere eget, bibendum eget justo. Praesent hendrerit sapien at nunc auctor iaculis. Sed lacinia porttitor tortor, ut sagittis mi scelerisque in. Curabitur varius nisi at aliquet luctus. Proin vehicula risus nec tincidunt posuere. Curabitur condimentum, risus sed ullamcorper dapibus, velit sapien tempor mi, et condimentum turpis lacus sed ligula. Pellentesque metus urna, venenatis sit amet elit quis, scelerisque tempor eros. In in pretium dolor. Sed consequat orci eu nisi placerat aliquam. Nunc et placerat orci. Maecenas cursus dictum commodo. Vestibulum aliquam ligula nec neque posuere viverra.
                        </p>
                    '
                ],
            ],
            [
                'page' => [
                    'status' => 'published',
                    'title' => 'How it Works',
                    'link' => 'how-it-works',
                    'content' => '<h3>Curabitur id</h3>
                        <br>
                        <p>
                            Curabitur id auctor massa. Nam ultricies elit in risus molestie, quis sagittis elit pharetra. Quisque at laoreet eros. Proin malesuada ut purus quis tempus. Nulla finibus, lectus at malesuada ultricies, metus arcu posuere augue, in vehicula neque sem non odio. Proin velit augue, sagittis sed diam in, elementum dictum ante.
                        </p>
                        <br>
                        <h3>Aliquam id metus</h3>
                        <br>
                        <p>
                            Aliquam id metus urna. Nullam accumsan tellus sed erat ultrices, ut elementum ex ultrices. Proin faucibus, metus in vestibulum rhoncus, lectus risus rutrum mauris, eu faucibus ipsum nisl ut tortor. Sed id lectus at dolor auctor bibendum sed in purus. Vestibulum bibendum elit vel iaculis mollis. Nullam luctus lacus vel commodo blandit.
                        </p>
                        <br>
                        <h3>Proin varius</h3>
                        <br>
                        <p>
                            Proin varius ultricies libero. Ut malesuada ac sapien eget commodo. Nunc maximus vitae mauris quis aliquam. Cras iaculis elit non mattis euismod. Curabitur consectetur orci ex. In hac habitasse platea dictumst. Donec aliquam ac mauris ut luctus.
                        </p>
                    '
                ],
            ],
            [
                'page' => [
                    'status' => 'published',
                    'title' => 'About Us',
                    'link' => 'about-us',
                    'content' => '<h3>Donec finibus</h3>
                        <br>
                        <p>
                            Donec finibus lectus nulla, vitae mattis lacus auctor ut. In varius enim eget lectus convallis, et maximus massa luctus. Quisque laoreet odio eget velit sagittis elementum. Vivamus luctus suscipit porttitor. Sed mollis, erat nec dapibus gravida, ante velit venenatis magna, ut sollicitudin massa eros non tellus. Fusce et mi sapien. Suspendisse pretium turpis non lacus volutpat aliquam.
                        </p>
                        <br>
                        <h3>Maecenas euismod</h3>
                        <br>
                        <p>
                            Maecenas euismod nisi iaculis sapien consequat facilisis. Cras iaculis eu velit id viverra. Quisque id augue at justo fringilla rutrum. Curabitur sit amet mauris nulla. Nunc ac hendrerit ipsum. Aenean dictum lacus augue, eget mollis risus interdum nec. Curabitur sed consequat dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer at dignissim velit. Sed a turpis ac nulla vehicula accumsan nec at velit. Duis auctor nunc a risus dignissim sollicitudin. Praesent et aliquet mi. Vestibulum rutrum tempor arcu a imperdiet. Sed et feugiat nibh, eget dictum velit. Nam consectetur luctus leo convallis dapibus. Etiam rhoncus ornare interdum.
                        </p>
                        <br>
                        <h3>Mauris pretium</h3>
                        <br>
                        <p>
                            Mauris pretium est nec eros ultricies, non porttitor mi finibus. Sed dictum est velit, commodo semper felis commodo sed. In libero ante, rhoncus at leo et, volutpat malesuada sapien. Integer efficitur orci dictum ipsum consequat, ut lacinia nulla faucibus. Donec purus nibh, cursus quis varius id, efficitur nec diam. Mauris vel lectus vel ante ultricies commodo id eu ligula. Nullam velit eros, mattis nec cursus eget, gravida id quam. Pellentesque urna neque, pharetra at nulla et, luctus ornare enim. Cras facilisis, magna id iaculis dapibus, velit diam semper leo, in consectetur sem nibh vitae massa.
                        </p>
                    '
                ],
            ],
        ];

        foreach ($pages as $pageAll) {
            $page = $pageAll['page'];
            $page['meta_title'] = $page['title'] . ' | ' . env('APP_NAME');
            $page['meta_description'] = $page['title'] . ' | ' . env('APP_NAME');
            $p = Page::updateOrCreate(
                [
                    'link' => $page['link']
                ],
                $page
            );

            foreach ($pageAll['blocks']??[] as $block){
                PageBlock::updateOrCreate(
                    [
                        'page_id' => $p->id,
                        'name' => $block['name'],
                    ],
                    [
                        'name' => $block['name'],
                        'page_id' => $p->id,
                        'data' => $block['data'],
                    ]);
            }
        }

        //TODO: copy images from 'database/seeders/images/' to 'storage/app/public/pages/'

    }
}
