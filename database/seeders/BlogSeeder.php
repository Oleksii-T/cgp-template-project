<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Attachment;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs = [
            [
                'blog' => [

                ],
                'translations' => [
                    'title' => [
                        'en' => 'Laravel Template Project released!',
                        'es' => '¡Laravel Template Project lanzado!'
                    ],
                    'slug' => [
                        'en' => 'laravel-template-project-released',
                        'es' => 'laravel-template-project-lanzado'
                    ],
                    'content' => [
                        'en' => '
                            <p>Laravel Template Project is live, so you do not need to implement basic functionality by yourself anymore!</p>
                            <p>Features:</p>
                            <ul>
                                <li>Authentication</li>
                                <li>Admin panel</li>
                                <li>Subscription management (based on Stripe)</li>
                                <li>File uploads\attachments management</li>
                                <li>Model translations</li>
                            </ul>
                            <p>And some more! Additional information can be found in <a href="https://github.com/Oleksii-T/laravel-template-project">git repository</a>.</p>
                            <p>Happy coding!</p>
                        ',
                        'es' => '
                            <p>¡Laravel Template Project está activo, por lo que ya no necesita implementar la funcionalidad básica por su cuenta!</p>
                            <p>Características:</p>
                            <ul>
                                <li>Autenticación</li>
                                <li>Panel de administrador</li>
                                <li>gestión de suscripciones (basado en Stripe)</li>
                                <li>Carga de archivos\Administración de archivos adjuntos</li>
                                <li>Traducciones modelo</li>
                            </ul>
                            <p>¡Y algo más! Se puede encontrar información adicional en <a href="https://github.com/Oleksii-T/laravel-template-project">el repositorio de git</a>.</p>
                            <p>¡Feliz codificación!</p>
                        '
                    ]
                ],
                'attachments' => [
                    'thumbnail' => [
                        [
                            'name' => 'blog-1-thumbnail-IkScYXATk5hFwz.jpeg',
                            'original_name' => 'blog-1-thumbnail.jpeg',
                            'type' => 'image',
                            'size' => '270711'
                        ]
                    ],
                    'images' => [
                        [
                            'name' => 'blog-1-image-1-zpOOOz918q.png',
                            'original_name' => 'blog-1-image-1.png',
                            'type' => 'image',
                            'size' => '7567'
                        ],
                        [
                            'name' => 'blog-1-image-2-JuLo5yCTFW.webp',
                            'original_name' => 'blog-1-image-2.webp',
                            'type' => 'image',
                            'size' => '7708'
                        ],
                    ]
                ]
            ],
        ];

        foreach ($blogs as $blogAll) {
            $blog = Blog::create($blogAll['blog']);
            $blog->saveTranslations($blogAll['translations']);
            foreach ($blogAll['attachments'] as $group => $attachments) {
                foreach ($attachments as $attachment) {
                    Attachment::create($attachment + [
                        'group' => $group,
                        'attachmentable_id' => $blog->id,
                        'attachmentable_type' => Blog::class
                    ]);
                }
            }
        }
    }
}
