<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Önce 'pages' tablosuna ana sayfa kaydını ekleyelim
        $pageId = DB::table('pages')->insertGetId([
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // 2. İngilizce (EN) Çeviri ve JSON İçeriği
        $enContent = [
            'intro_section' => [
                'title' => 'Solid Core Composite Interior Doors Built to Last',
                'paragraph_1' => 'ERDOOR manufactures <strong>Solid Core Composite Interior Doors</strong> that combine the natural beauty of wood with the durability of advanced WPC technology. Our <strong>Solid Core WPC Interior Doors</strong> feature realistic <strong>wood-look finishes</strong>, superior sound insulation, and exceptional resistance to moisture, humidity, termites, warping, and cracking.',
                'paragraph_2' => 'Made with recycled materials, our <strong>Composite Interior Doors</strong> provide a sustainable, low-maintenance solution for modern residential and commercial spaces—delivering lasting performance, timeless design, and premium quality.',
                'quote' => '“Elegance Born From Recycling”'
            ],
            'benefits_section' => [
                ['title' => 'Flame Retardant', 'icon' => 'Flame-retardent.jpg', 'is_featured' => '0'],
                ['title' => 'Humidity Proof', 'icon' => 'humidity-proof.jpg', 'is_featured' => '0'],
                ['title' => 'Eco Friendly', 'icon' => 'Eco-Friendly.jpg', 'is_featured' => '0'],
                ['title' => 'Maintenance Free', 'icon' => 'maintenance-free.jpg', 'is_featured' => '0'],
                ['title' => '25 Years of Limited Warranty', 'icon' => 'warranty.jpg', 'is_featured' => '1'], // Öne çıkan özellik
                ['title' => 'Noise Reduction', 'icon' => 'noise-reduction.jpg', 'is_featured' => '0'],
                ['title' => 'Termite & Insect Proof', 'icon' => 'Insect-proof.jpg', 'is_featured' => '0'],
                ['title' => 'Thermal Insulation', 'icon' => 'thermal-insulation.jpg', 'is_featured' => '0'],
                ['title' => 'Water Proof', 'icon' => 'water-proof.jpg', 'is_featured' => '0']
            ],
            'comparison_section' => [
                'label_1' => 'Erdoor',
                'title' => 'Same Look,<br>Big Difference',
                'features' => [
                    'Water proof', 'Moisture resistance', 'Termite & insect resistant',
                    'Noise Reduction', 'Thermal Insulation', 'Eco-Friendly',
                    'B1 Fire Retardant', 'Maintenance-Free', 'Anti-Bacterial', '25 years of warranty'
                ],
                'label_2' => 'Traditional Wooden Door'
            ],
            'cta_section' => [
                'title' => 'Our Interior Doors',
                'button_text' => 'Explore The Catalog',
                'button_link' => 'catalog.html'
            ]
        ];

        DB::table('page_translations')->insert([
            'page_id' => $pageId,
            'title' => 'Home',
            'slug' => 'home',
            'description' => 'ERDOOR manufactures Solid Core Composite Interior Doors built to last.',
            'content' => json_encode($enContent),
            'locale' => 'en',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // 3. İspanyolca (ES) Çeviri ve JSON İçeriği
        $esContent = [
            'intro_section' => [
                'title' => 'Puertas de Interior de Compuesto con Núcleo Sólido Diseñadas para Durar',
                'paragraph_1' => 'ERDOOR fabrica <strong>Puertas de Interior de Compuesto con Núcleo Sólido</strong> que combinan la belleza natural de la madera con la durabilidad de la tecnología avanzada WPC. Nuestras <strong>Puertas de Interior WPC con Núcleo Sólido</strong> cuentan con realistas <strong>acabados aspecto madera</strong>, aislamiento acústico superior y una resistencia excepcional a la humedad, termitas, deformaciones y agrietamientos.',
                'paragraph_2' => 'Fabricadas con materiales reciclados, nuestras <strong>Puertas de Interior de Compuesto</strong> ofrecen una solución sostenible y de bajo mantenimiento para espacios residenciales y comerciales modernos, ofreciendo un rendimiento duradero, un diseño atemporal y calidad superior.',
                'quote' => '“Elegancia Nacida del Reciclaje”'
            ],
            'benefits_section' => [
                ['title' => 'Retardante de llama', 'icon' => 'Flame-retardent.jpg', 'is_featured' => '0'],
                ['title' => 'A prueba de humedad', 'icon' => 'humidity-proof.jpg', 'is_featured' => '0'],
                ['title' => 'Ecológico', 'icon' => 'Eco-Friendly.jpg', 'is_featured' => '0'],
                ['title' => 'Libre de mantenimiento', 'icon' => 'maintenance-free.jpg', 'is_featured' => '0'],
                ['title' => '25 años de garantía limitada', 'icon' => 'warranty.jpg', 'is_featured' => '1'], // Öne çıkan özellik
                ['title' => 'Reducción de ruido', 'icon' => 'noise-reduction.jpg', 'is_featured' => '0'],
                ['title' => 'A prueba de termitas e insectos', 'icon' => 'Insect-proof.jpg', 'is_featured' => '0'],
                ['title' => 'Aislamiento térmico', 'icon' => 'thermal-insulation.jpg', 'is_featured' => '0'],
                ['title' => 'Impermeable', 'icon' => 'water-proof.jpg', 'is_featured' => '0']
            ],
            'comparison_section' => [
                'label_1' => 'Erdoor',
                'title' => 'Misma Apariencia,<br>Gran Diferencia',
                'features' => [
                    'Impermeable', 'Resistencia a la humedad', 'Resistente a termitas e insectos',
                    'Reducción de ruido', 'Aislamiento térmico', 'Ecológico',
                    'Retardante de fuego B1', 'Libre de mantenimiento', 'Antibacterial', '25 años de garantía'
                ],
                'label_2' => 'Puerta de Madera Tradicional'
            ],
            'cta_section' => [
                'title' => 'Nuestras Puertas de Interior',
                'button_text' => 'Explorar el Catálogo',
                'button_link' => 'catalog.html'
            ]
        ];

        DB::table('page_translations')->insert([
            'page_id' => $pageId,
            'title' => 'Inicio',
            'slug' => 'inicio',
            'description' => 'ERDOOR fabrica puertas de interior de compuesto con núcleo sólido diseñadas para durar.',
            'content' => json_encode($esContent),
            'locale' => 'es',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
