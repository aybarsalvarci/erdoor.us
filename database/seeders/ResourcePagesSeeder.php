<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResourcePage;

class ResourcePagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            // 1. Installation
            [
                'image_id' => 1,
                'icon' => 'fas fa-tools',
                'en' => [
                    'title' => 'Installation',
                    'slug' => 'installation',
                    'description' => 'See the recommended process for preparing, fitting, aligning, and completing an Erdoor interior door installation.',
                    'link_text' => 'WATCH INSTALLATION',
                    'page_content' => [
                        'hero' => [
                            'back_link' => 'Resources',
                            'eyebrow' => 'Installation guide',
                            'title' => 'Install with confidence.',
                            'description' => 'Watch the complete Erdoor door installation process for guidance on preparation, alignment, hardware, and final adjustments.'
                        ],
                        'video' => [
                            'label' => 'Installation film',
                            'error_title' => 'Installation video unavailable',
                            'error_desc' => 'Please try again or contact Erdoor support.',
                            'url' => 'assets/videos/instillation.mp4',
                            'poster' => 'assets/gallery/4.jpg'
                        ],
                        'notes' => [
                            'eyebrow' => 'Before you begin',
                            'title' => 'Prepare for a precise fit',
                            'disclaimer' => 'Always follow project requirements, local building codes, and the instructions supplied with your Erdoor system.',
                            'steps' => [
                                [
                                    'title' => 'Inspect the opening',
                                    'description' => 'Confirm the opening is clean, level, plumb, and sized for the selected door system.'
                                ],
                                [
                                    'title' => 'Review components',
                                    'description' => 'Verify the frame, leaf, hardware, fasteners, and accessories before installation.'
                                ],
                                [
                                    'title' => 'Make final adjustments',
                                    'description' => 'Check clearances, alignment, latch operation, and smooth movement before completion.'
                                ]
                            ]
                        ]
                    ]
                ],
                'es' => [
                    'title' => 'Instalación',
                    'slug' => 'instalacion',
                    'description' => 'Vea el proceso recomendado para preparar, ajustar, alinear y completar la instalación de una puerta de interior Erdoor.',
                    'link_text' => 'VER INSTALACIÓN',
                    'page_content' => [
                        'hero' => [
                            'back_link' => 'Recursos',
                            'eyebrow' => 'Guía de instalación',
                            'title' => 'Instale con confianza.',
                            'description' => 'Vea el proceso completo de instalación de puertas Erdoor para obtener orientación sobre preparación, alineación, herrajes y ajustes finales.'
                        ],
                        'video' => [
                            'label' => 'Video de instalación',
                            'error_title' => 'Video de instalación no disponible',
                            'error_desc' => 'Por favor, inténtelo de nuevo o póngase en contacto con el soporte de Erdoor.',
                            'url' => 'assets/videos/instillation.mp4',
                            'poster' => 'assets/gallery/4.jpg'
                        ],
                        'notes' => [
                            'eyebrow' => 'Antes de empezar',
                            'title' => 'Prepárese para un ajuste preciso',
                            'disclaimer' => 'Siga siempre los requisitos del proyecto, los códigos de construcción locales y las instrucciones suministradas con su sistema Erdoor.',
                            'steps' => [
                                [
                                    'title' => 'Inspeccione la abertura',
                                    'description' => 'Confirme que la abertura esté limpia, nivelada, aplomada y tenga el tamaño adecuado para el sistema de puerta seleccionado.'
                                ],
                                [
                                    'title' => 'Revise los componentes',
                                    'description' => 'Verifique el marco, la hoja, los herrajes, los sujetadores y los accesorios antes de la instalación.'
                                ],
                                [
                                    'title' => 'Realice los ajustes finales',
                                    'description' => 'Compruebe los espacios libres, la alineación, el funcionamiento del pestillo y el movimiento suave antes de finalizar.'
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            // 2. Fire Resistance Test
            [
                'image_id' => 2,
                'icon' => 'fas fa-fire',
                'en' => [
                    'title' => 'Fire Resistance Test',
                    'slug' => 'fire-resistance-test',
                    'description' => 'Observe how a complete Erdoor door assembly performs during controlled fire-resistance testing.',
                    'link_text' => 'WATCH THE TEST'
                ],
                'es' => [
                    'title' => 'Prueba de Resistencia al Fuego',
                    'slug' => 'prueba-de-resistencia-al-fuego',
                    'description' => 'Observe cómo se comporta un ensamblaje completo de puerta Erdoor durante pruebas controladas de resistencia al fuego.',
                    'link_text' => 'VER LA PRUEBA'
                ],
            ],
            // 3. Warranty
            [
                'image_id' => 3,
                'icon' => 'fas fa-shield-alt',
                'en' => [
                    'title' => 'Warranty',
                    'slug' => 'warranty',
                    'description' => 'Understand warranty coverage, eligibility, exclusions, claims, and return conditions in our interactive document.',
                    'link_text' => 'READ WARRANTY'
                ],
                'es' => [
                    'title' => 'Garantía',
                    'slug' => 'garantia',
                    'description' => 'Comprenda la cobertura de la garantía, elegibilidad, exclusiones, reclamaciones y condiciones de devolución en nuestro documento interactivo.',
                    'link_text' => 'LEER GARANTÍA'
                ],
            ],
            // 4. Technical & Certificates
            [
                'image_id' => 4,
                'icon' => 'fas fa-file-contract',
                'en' => [
                    'title' => 'Technical & Certificates',
                    'slug' => 'technical-and-certificates',
                    'description' => 'Access organized product literature, technical information, performance reports, and supporting certificates.',
                    'link_text' => 'VIEW DOCUMENTS'
                ],
                'es' => [
                    'title' => 'Técnicos y Certificados',
                    'slug' => 'tecnicos-y-certificados',
                    'description' => 'Acceda a literatura de productos organizada, información técnica, informes de rendimiento y certificados de respaldo.',
                    'link_text' => 'VER DOCUMENTOS'
                ],
            ],
            // 5. Gallery
            [
                'image_id' => 5,
                'icon' => 'fas fa-images',
                'en' => [
                    'title' => 'Gallery',
                    'slug' => 'gallery',
                    'description' => 'Explore Erdoor designs, natural-looking finishes, coordinated details, and ideas for considered interiors.',
                    'link_text' => 'VISIT GALLERY'
                ],
                'es' => [
                    'title' => 'Galería',
                    'slug' => 'galeria',
                    'description' => 'Explore los diseños de Erdoor, acabados de aspecto natural, detalles coordinados e ideas para interiores considerados.',
                    'link_text' => 'VISITAR GALERÍA'
                ],
            ],
            // 6. Digital Catalog
            [
                'image_id' => 6,
                'icon' => 'fas fa-book-open',
                'en' => [
                    'title' => 'Digital Catalog',
                    'slug' => 'digital-catalog',
                    'description' => 'Browse the complete Erdoor collection, profiles, finishes, and product details in an interactive flipbook.',
                    'link_text' => 'VIEW CATALOG'
                ],
                'es' => [
                    'title' => 'Catálogo Digital',
                    'slug' => 'catalogo-digital',
                    'description' => 'Explore la colección completa de Erdoor, perfiles, acabados y detalles de productos en un flipbook interactivo.',
                    'link_text' => 'VER CATÁLOGO'
                ],
            ],
        ];

        foreach ($pages as $pageData) {
            $enSlug = $pageData['en']['slug'];

            $page = ResourcePage::whereTranslation('slug', $enSlug, 'en')->first();

            $mainAttributes = [
                'image_id' => $pageData['image_id'],
                'icon' => $pageData['icon'],
            ];

            if ($page) {
                $page->update($mainAttributes);
            } else {
                $page = ResourcePage::create($mainAttributes);
            }

            $locales = ['en', 'es'];

            foreach ($locales as $locale) {
                if (isset($pageData[$locale])) {
                    $page->translations()->updateOrCreate(
                        ['locale' => $locale],
                        $pageData[$locale]
                    );
                }
            }
        }
    }
}
