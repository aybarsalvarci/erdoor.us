<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pageId = DB::table('pages')->insertGetId([
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $enContent = [
            'hero_section' => [
                'eyebrow' => 'Our story',
                'title' => 'Built on experience.<br>Designed for what’s next.',
                'description' => 'For more than three decades, Erdoor has been dedicated to designing and manufacturing premium composite interior door systems that combine modern aesthetics, durability, and long-lasting performance. As a brand of Ergunbas Group, our story began in 1989 with a vision to deliver innovative building solutions through advanced manufacturing and uncompromising quality.'
            ],
            'intro_section' => [
                'label' => 'Since 1989',
                'title' => 'Manufacturing strength with a global outlook',
                'paragraph_1' => 'Over the years, Ergunbas Group has continuously evolved alongside the construction industry. In the early 2000s, the company expanded its manufacturing capabilities by investing in PVC production, followed by significant advancements in composite technology. This strategic transformation positioned the company among Turkey\'s leading composite manufacturers, enabling us to develop high-performance interior door solutions that meet the changing needs of architects, builders, distributors, and homeowners around the world.',
                'paragraph_2' => 'Today, Erdoor operates with a strong international manufacturing network supported by production facilities in Turkey and Algeria. Together, these facilities cover more than 1,000,000 square feet of manufacturing space, equipped with advanced production technologies and modern quality control systems. With a workforce of over 500 skilled professionals, our operations are capable of producing more than 2,000 interior doors every day, allowing us to serve projects of every scale with efficiency, consistency, and reliability.',
                'factories' => [
                    [
                        'image' => 'assets/about-us/Turkiye-fabrika.JPG',
                        'country' => 'Turkey',
                        'type' => 'Manufacturing facility'
                    ],
                    [
                        'image' => 'assets/about-us/cezayir-fabrika.JPG',
                        'country' => 'Algeria',
                        'type' => 'Manufacturing facility'
                    ]
                ]
            ],
            'global_section' => [
                'label' => 'Global reach',
                'title' => 'Quality, service<br>and partnership',
                'logos' => [
                    'assets/logo/ergunbas.png',
                    'assets/logo/logo_erdoor.png'
                ],
                'paragraphs' => [
                    'Our commitment to growth extends far beyond manufacturing. Through strategically located distribution centers in Morocco, Ivory Coast, and Bulgaria, Erdoor has built a reliable logistics network serving customers across Europe, the Middle East, and Africa. Continuing our global expansion, we have recently established our newest distribution warehouse in Florida, USA, enabling faster delivery, improved inventory availability, and dedicated support for customers throughout the North American market.',
                    'Every Erdoor interior door is developed with a focus on quality, performance, and design flexibility. Our composite door systems are engineered to provide exceptional resistance to moisture, everyday wear, and environmental changes while maintaining their elegant appearance over time. Combining innovative materials with precision manufacturing, our products offer an ideal solution for residential, commercial, hospitality, healthcare, educational, and multi-family construction projects.',
                    'At Erdoor, quality is more than a manufacturing standard—it is the foundation of everything we do. From carefully selected raw materials to rigorous inspection procedures throughout every stage of production, we maintain strict quality control processes to ensure every product meets the highest expectations of durability, consistency, and craftsmanship. Our commitment to continuous improvement drives us to invest in new technologies, sustainable production methods, and innovative product development.',
                    'We believe strong partnerships are built on trust, reliability, and exceptional service. Whether working with distributors, contractors, architects, developers, or retailers, our team is dedicated to providing responsive support, dependable supply, and tailored solutions that help our partners succeed. Our global manufacturing strength combined with regional distribution capabilities allows us to deliver products efficiently while maintaining the personalized service our customers expect.',
                    'As Erdoor continues to expand into new international markets, our mission remains unchanged: to deliver innovative composite interior door solutions that combine superior quality, modern design, and dependable performance. Backed by over 35 years of manufacturing experience and the strength of Ergunbas Group, we remain committed to shaping the future of interior building products while creating lasting value for customers across the world.'
                ],
                'button_text' => 'Start a conversation',
                'button_link' => 'contact.html'
            ]
        ];

        DB::table('page_translations')->insert([
            'page_id' => $pageId,
            'title' => 'About Us',
            'slug' => 'about-us',
            'description' => 'Discover the story of Erdoor, built on experience and designed for the future with premium composite doors.',
            'content' => json_encode($enContent),
            'locale' => 'en',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $esContent = [
            'hero_section' => [
                'eyebrow' => 'Nuestra historia',
                'title' => 'Construido sobre experiencia.<br>Diseñado para el futuro.',
                'description' => 'Durante más de tres décadas, Erdoor se ha dedicado a diseñar y fabricar sistemas de puertas interiores compuestas premium que combinan estética moderna, durabilidad y rendimiento a largo plazo. Como marca de Ergunbas Group, nuestra historia comenzó en 1989 con la visión de ofrecer soluciones de construcción innovadoras a través de fabricación avanzada y calidad sin concesiones.'
            ],
            'intro_section' => [
                'label' => 'Desde 1989',
                'title' => 'Fuerza de fabricación con perspectiva global',
                'paragraph_1' => 'A lo largo de los años, Ergunbas Group ha evolucionado continuamente junto con la industria de la construcción. A principios de la década de 2000, la empresa amplió sus capacidades de fabricación invirtiendo en producción de PVC, seguido de avances significativos en tecnología de compuestos. Esta transformación estratégica posicionó a la empresa entre los principales fabricantes de compuestos de Turquía.',
                'paragraph_2' => 'Hoy en día, Erdoor opera con una sólida red de fabricación internacional respaldada por instalaciones de producción en Turquía y Argelia. Juntas, estas instalaciones cubren más de 1,000,000 de pies cuadrados de espacio de fabricación, equipadas con tecnologías de producción avanzadas y sistemas modernos de control de calidad. Con una fuerza laboral de más de 500 profesionales capacitados, nuestras operaciones son capaces de producir más de 2,000 puertas interiores cada día.',
                'factories' => [
                    [
                        'image' => 'assets/about-us/Turkiye-fabrika.JPG',
                        'country' => 'Turquía',
                        'type' => 'Instalación de fabricación'
                    ],
                    [
                        'image' => 'assets/about-us/cezayir-fabrika.JPG',
                        'country' => 'Argelia',
                        'type' => 'Instalación de fabricación'
                    ]
                ]
            ],
            'global_section' => [
                'label' => 'Alcance global',
                'title' => 'Calidad, servicio<br>y asociación',
                'logos' => [
                    'assets/logo/ergunbas.png',
                    'assets/logo/logo_erdoor.png'
                ],
                'paragraphs' => [
                    'Nuestro compromiso con el crecimiento se extiende mucho más allá de la fabricación. A través de centros de distribución estratégicamente ubicados en Marruecos, Costa de Marfil y Bulgaria, Erdoor ha construido una red logística confiable que atiende a clientes en Europa, Medio Oriente y África. Continuando nuestra expansión global, recientemente hemos establecido un almacén en Florida, EE. UU.',
                    'Cada puerta interior de Erdoor se desarrolla con un enfoque en la calidad, el rendimiento y la flexibilidad del diseño. Nuestros sistemas de puertas compuestas están diseñados para proporcionar una resistencia excepcional a la humedad, el desgaste diario y los cambios ambientales mientras mantienen su aspecto elegante.',
                    'En Erdoor, la calidad es más que un estándar de fabricación: es la base de todo lo que hacemos. Desde materias primas cuidadosamente seleccionadas hasta rigurosos procedimientos de inspección a lo largo de cada etapa de producción.',
                    'Creemos que las asociaciones sólidas se basan en la confianza, la confiabilidad y un servicio excepcional. Ya sea trabajando con distribuidores, contratistas, arquitectos o minoristas, nuestro equipo está dedicado a brindar un soporte receptivo y soluciones personalizadas.',
                    'A medida que Erdoor continúa expandiéndose a nuevos mercados internacionales, nuestra misión permanece intacta: ofrecer soluciones innovadoras de puertas interiores compuestas que combinen calidad superior, diseño moderno y rendimiento confiable.'
                ],
                'button_text' => 'Inicia una conversación',
                'button_link' => 'contact.html'
            ]
        ];

        DB::table('page_translations')->insert([
            'page_id' => $pageId,
            'title' => 'Sobre Nosotros',
            'slug' => 'sobre-nosotros',
            'description' => 'Descubre la historia de Erdoor, construida sobre experiencia y diseñada para el futuro con puertas compuestas premium.',
            'content' => json_encode($esContent),
            'locale' => 'es',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
