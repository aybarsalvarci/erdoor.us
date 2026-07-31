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
                    'link_text' => 'WATCH THE TEST',
                    'page_content' => [
                        'hero' => [
                            'back_link' => 'Resources',
                            'eyebrow' => 'Performance testing',
                            'title' => 'Fire resistance in action.',
                            'description' => 'View controlled test footage demonstrating the performance of an Erdoor door assembly under fire exposure.'
                        ],
                        'video' => [
                            'label' => 'Performance test film',
                            'error_title' => 'Fire test video unavailable',
                            'error_desc' => 'Please try again or contact Erdoor support.',
                            'iframe' => '' // Admin panelinden YouTube Iframe kodu eklenecek
                        ],
                        'notes' => [
                            'eyebrow' => 'Test overview',
                            'title' => 'Evaluated under controlled conditions',
                            'disclaimer' => 'Fire performance varies by tested assembly. Consult the applicable certificate or test report before specification.',
                            'steps' => [
                                [
                                    'title' => 'Complete assembly',
                                    'description' => 'The test evaluates the door leaf, frame, hardware, and installation as a complete system.'
                                ],
                                [
                                    'title' => 'Controlled exposure',
                                    'description' => 'Performance is observed throughout a defined heating and test sequence.'
                                ],
                                [
                                    'title' => 'Documented results',
                                    'description' => 'Applicable classifications and supporting reports should be reviewed for each specified configuration.'
                                ]
                            ]
                        ]
                    ]
                ],
                'es' => [
                    'title' => 'Prueba de Resistencia al Fuego',
                    'slug' => 'prueba-de-resistencia-al-fuego',
                    'description' => 'Observe cómo se comporta un ensamblaje completo de puerta Erdoor durante pruebas controladas de resistencia al fuego.',
                    'link_text' => 'VER LA PRUEBA',
                    'page_content' => [
                        'hero' => [
                            'back_link' => 'Recursos',
                            'eyebrow' => 'Pruebas de rendimiento',
                            'title' => 'Resistencia al fuego en acción.',
                            'description' => 'Vea imágenes de pruebas controladas que demuestran el rendimiento de un ensamblaje de puerta Erdoor bajo exposición al fuego.'
                        ],
                        'video' => [
                            'label' => 'Película de prueba de rendimiento',
                            'error_title' => 'Video de prueba de fuego no disponible',
                            'error_desc' => 'Por favor, inténtelo de nuevo o póngase en contacto con el soporte de Erdoor.',
                            'iframe' => '' // Admin panelinden YouTube Iframe kodu eklenecek
                        ],
                        'notes' => [
                            'eyebrow' => 'Resumen de la prueba',
                            'title' => 'Evaluado bajo condiciones controladas',
                            'disclaimer' => 'El rendimiento ante el fuego varía según el ensamblaje probado. Consulte el certificado o informe de prueba aplicable antes de la especificación.',
                            'steps' => [
                                [
                                    'title' => 'Ensamblaje completo',
                                    'description' => 'La prueba evalúa la hoja de la puerta, el marco, los herrajes y la instalación como un sistema completo.'
                                ],
                                [
                                    'title' => 'Exposición controlada',
                                    'description' => 'El rendimiento se observa a lo largo de una secuencia definida de calentamiento y prueba.'
                                ],
                                [
                                    'title' => 'Resultados documentados',
                                    'description' => 'Se deben revisar las clasificaciones aplicables y los informes de respaldo para cada configuración especificada.'
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            // 3. Warranty & Return Policy (PDF Flipbook)
            [
                'image_id' => 3,
                'icon' => 'fas fa-shield-alt',
                'en' => [
                    'title' => 'Warranty & Return Policy',
                    'slug' => 'warranty-and-return-policy',
                    'description' => 'Read the Erdoor Warranty and Return Policy in an interactive digital flipbook.',
                    'link_text' => 'READ POLICY',
                    'page_content' => [
                        'back_link' => 'Back to Resources',
                        'header_title' => 'WARRANTY & RETURN POLICY',
                        'loading_text' => 'Loading Policy...',
                        'pdf_url' => '',
                    ]
                ],
                'es' => [
                    'title' => 'Garantía y Política de Devolución',
                    'slug' => 'garantia-y-politica-de-devolucion',
                    'description' => 'Lea la Garantía y Política de Devolución de Erdoor en un flipbook digital interactivo.',
                    'link_text' => 'LEER POLÍTICA',
                    'page_content' => [
                        'back_link' => 'Volver a Recursos',
                        'header_title' => 'GARANTÍA Y POLÍTICA DE DEVOLUCIÓN',
                        'loading_text' => 'Cargando Política...',
                        'pdf_url' => '',
                    ]
                ],
            ],
            // 4. Technical & Certificates
            [
                'image_id' => 4, // İlgili kapak görselinin ID'si
                'icon' => 'fas fa-file-contract', // Doküman / Sertifika ikonu
                'en' => [
                    'title' => 'Technical & Certificates',
                    'slug' => 'technical-and-certificates',
                    'description' => 'Certificates, technical specifications, and test reports—organized in one accessible document grid.',
                    'link_text' => 'BROWSE LIBRARY',
                    'page_content' => [
                        'hero' => [
                            'back_link' => 'Resources',
                            'eyebrow' => 'Document library',
                            'title' => 'Technical &<br>Certificates',
                            'description' => 'Certificates, technical specifications, and test reports—organized in one accessible document grid.'
                        ],
                        'library' => [
                            'eyebrow' => 'Available documents',
                            'title' => 'Browse the library',
                            'filter_all' => 'All',
                            'filter_cert' => 'Certificates',
                            'filter_tech' => 'Technical',
                            'search_placeholder' => 'Search documents',
                            'empty_text' => 'No documents match your search.',
                            'view_link' => 'Open document'
                        ],
                        'help' => [
                            'eyebrow' => 'Project support',
                            'title' => 'Need a specific report?',
                            'description' => 'Ask our team for the documentation required for your market, product configuration, or project.',
                            'button_text' => 'Request a document',
                            'button_link' => '#' // İletişim sayfasına veya bir forma yönlendirilebilir
                        ]
                    ]
                ],
                'es' => [
                    'title' => 'Técnicos y Certificados',
                    'slug' => 'tecnicos-y-certificados',
                    'description' => 'Certificados, especificaciones técnicas e informes de pruebas, organizados en una cuadrícula de documentos accesible.',
                    'link_text' => 'EXPLORAR BIBLIOTECA',
                    'page_content' => [
                        'hero' => [
                            'back_link' => 'Recursos',
                            'eyebrow' => 'Biblioteca de documentos',
                            'title' => 'Técnicos y<br>Certificados',
                            'description' => 'Certificados, especificaciones técnicas e informes de pruebas, organizados en una cuadrícula de documentos accesible.'
                        ],
                        'library' => [
                            'eyebrow' => 'Documentos disponibles',
                            'title' => 'Explorar la biblioteca',
                            'filter_all' => 'Todos',
                            'filter_cert' => 'Certificados',
                            'filter_tech' => 'Técnicos',
                            'search_placeholder' => 'Buscar documentos',
                            'empty_text' => 'Ningún documento coincide con su búsqueda.',
                            'view_link' => 'Abrir documento'
                        ],
                        'help' => [
                            'eyebrow' => 'Soporte de proyectos',
                            'title' => '¿Necesita un informe específico?',
                            'description' => 'Solicite a nuestro equipo la documentación requerida para su mercado, configuración de producto o proyecto.',
                            'button_text' => 'Solicitar un documento',
                            'button_link' => '#'
                        ]
                    ]
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
