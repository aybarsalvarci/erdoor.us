<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WhyWpcPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. 'pages' tablosuna "Why WPC" sayfası için kayıt ekleyelim
        $pageId = DB::table('pages')->insertGetId([
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // ==========================================
        // 2. İNGİLİZCE (EN) İÇERİK
        // ==========================================
        $enContent = [
            'hero_section' => [
                'eyebrow' => 'Why WPC doors?',
                'title' => 'Natural wood beauty.<br><span>Engineered to endure.</span>',
                'description' => 'Choosing the right interior door is about more than appearance—it\'s about investing in long-term performance, durability, and value. While traditional wooden doors have been widely used for decades, modern construction demands materials that can withstand moisture, daily wear, and changing environmental conditions without compromising their appearance or structural integrity. This is where Erdoor WPC Composite Doors offer a superior solution.',
                'link_text' => 'Explore the advantages',
                'image' => 'assets/products/CompositFillingDoor.jpg',
                'note_1' => 'WPC',
                'note_2' => 'Composite technology'
            ],
            'intro_section' => [
                'label' => 'Built differently',
                'title' => 'Superior by design',
                'paragraph_1' => 'Manufactured using advanced Wood Plastic Composite (WPC) technology, Erdoor doors are engineered to outperform conventional wood doors in nearly every aspect. Unlike traditional wooden doors that can absorb moisture, swell, warp, crack, or become vulnerable to insects over time, WPC doors maintain their strength, stability, and appearance for years with minimal care.',
                'paragraph_2' => 'One of the unique advantages of Erdoor WPC doors is that they replicate the rich, elegant appearance of natural wood while delivering the superior performance of advanced composite materials. You can enjoy the timeless beauty of a wood-grain finish without the common drawbacks associated with traditional timber doors.'
            ],
            'benefits_section' => [
                'label' => 'Performance advantages',
                'title' => 'Made for real life',
                'description' => 'Thoughtful material engineering delivers lasting benefits across residential and commercial spaces.',
                'cards' => [
                    ['icon' => 'water-proof.jpg', 'title' => 'Moisture resistant', 'description' => 'One of the greatest advantages of WPC is its exceptional moisture resistance. Erdoor doors are designed for humid environments such as bathrooms, kitchens, laundry rooms, hospitals, hotels, and commercial buildings where conventional wood products often deteriorate. Because they do not absorb water like natural wood, they remain dimensionally stable even in demanding conditions.'],
                    ['icon' => 'Insect-proof.jpg', 'title' => 'Termite & insect resistant', 'description' => 'Erdoor WPC doors are also termite and insect resistant, eliminating one of the most common problems associated with traditional wooden doors. Since the composite material is not an attractive food source for insects, it provides long-lasting protection without requiring chemical treatments or ongoing maintenance.'],
                    ['icon' => 'Eco-Friendly.jpg', 'title' => 'Sustainable choice', 'description' => 'Sustainability is another key benefit. Our doors are manufactured using materials that contain up to 95% recycled content, helping reduce environmental impact while supporting responsible manufacturing practices. Choosing Erdoor means selecting a product that contributes to greener construction without sacrificing quality or performance.'],
                    ['icon' => 'noise-reduction.jpg', 'title' => 'Noise reduction', 'description' => 'Comfort inside a building depends on more than aesthetics. Our WPC composite doors are designed with excellent noise reduction properties, helping create quieter, more comfortable living and working environments by minimizing sound transmission between rooms.'],
                    ['icon' => 'Flame-retardent.jpg', 'title' => 'Flame retardant', 'description' => 'Safety is equally important. Erdoor doors feature flame-retardant properties, providing an additional level of protection for residential and commercial applications.'],
                    ['icon' => 'thermal-insulation.jpg', 'title' => 'Thermal insulation', 'description' => 'The composite core also provides excellent thermal insulation, helping improve indoor comfort and contribute to better energy efficiency.'],
                    ['icon' => 'maintenance-free.jpg', 'title' => 'Virtually maintenance-free', 'description' => 'Unlike traditional wooden doors, Erdoor WPC doors require virtually no maintenance. They never need sanding, staining, sealing, or repainting, allowing them to retain their beautiful wood-look finish with only simple cleaning.'],
                    ['icon' => 'warranty.jpg', 'title' => 'Up to 25 years', 'description' => 'Because of these advanced performance characteristics, Erdoor proudly backs its WPC interior doors with a warranty of up to 25 years, giving customers long-term confidence and peace of mind.']
                ]
            ],
            'comparison_section' => [
                'label' => 'The smarter investment',
                'title' => 'WPC Doors vs.<br>Traditional Wooden Doors',
                'description' => 'Traditional wooden doors offer a beautiful appearance but often require continuous maintenance and are susceptible to moisture, warping, termites, and surface deterioration. Erdoor WPC Composite Doors combine the natural beauty of wood with the strength, durability, and low-maintenance benefits of modern composite technology, making them a smarter long-term investment for both residential and commercial projects.',
                'quote' => 'Natural Wood Appearance. Advanced Composite Performance. Built to Last',
                'button_text' => 'Talk to our team',
                'button_link' => 'contact.html'
            ]
        ];

        DB::table('page_translations')->insert([
            'page_id' => $pageId,
            'title' => 'Why WPC',
            'slug' => 'why-wpc',
            'description' => 'Discover the natural wood beauty and advanced composite performance of Erdoor WPC doors.',
            'content' => json_encode($enContent),
            'locale' => 'en',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // ==========================================
        // 3. İSPANYOLCA (ES) İÇERİK
        // ==========================================
        $esContent = [
            'hero_section' => [
                'eyebrow' => '¿Por qué puertas WPC?',
                'title' => 'Belleza de madera natural.<br><span>Diseñadas para perdurar.</span>',
                'description' => 'Elegir la puerta interior adecuada es mucho más que apariencia: se trata de invertir en rendimiento, durabilidad y valor a largo plazo. Mientras que las puertas de madera tradicionales se han utilizado durante décadas, la construcción moderna exige materiales que puedan soportar la humedad, el desgaste diario y las condiciones ambientales sin comprometer su integridad estructural. Aquí es donde las puertas Erdoor WPC ofrecen una solución superior.',
                'link_text' => 'Explora las ventajas',
                'image' => 'assets/products/CompositFillingDoor.jpg',
                'note_1' => 'WPC',
                'note_2' => 'Tecnología compuesta'
            ],
            'intro_section' => [
                'label' => 'Construidas de manera diferente',
                'title' => 'Superiores por diseño',
                'paragraph_1' => 'Fabricadas utilizando tecnología avanzada de Compuesto de Madera y Plástico (WPC), las puertas Erdoor están diseñadas para superar a las puertas de madera convencionales en casi todos los aspectos. A diferencia de las puertas tradicionales que pueden absorber humedad, hincharse, deformarse o ser vulnerables a los insectos, las puertas WPC mantienen su resistencia y apariencia durante años con un cuidado mínimo.',
                'paragraph_2' => 'Una de las ventajas únicas de las puertas Erdoor WPC es que replican la apariencia rica y elegante de la madera natural al tiempo que ofrecen el rendimiento superior de los materiales compuestos. Puede disfrutar de la belleza atemporal de un acabado de vetas de madera sin los inconvenientes comunes asociados con las puertas de madera tradicionales.'
            ],
            'benefits_section' => [
                'label' => 'Ventajas de rendimiento',
                'title' => 'Hechas para la vida real',
                'description' => 'La ingeniería cuidadosa de materiales ofrece beneficios duraderos en espacios residenciales y comerciales.',
                'cards' => [
                    ['icon' => 'water-proof.jpg', 'title' => 'Resistente a la humedad', 'description' => 'Una de las mayores ventajas del WPC es su excepcional resistencia a la humedad. Están diseñadas para ambientes húmedos como baños, cocinas, hospitales y hoteles, donde los productos de madera convencionales suelen deteriorarse.'],
                    ['icon' => 'Insect-proof.jpg', 'title' => 'A prueba de termitas e insectos', 'description' => 'Las puertas Erdoor WPC son resistentes a termitas e insectos, eliminando uno de los problemas más comunes asociados con las puertas de madera tradicionales. Proporciona protección a largo plazo sin requerir tratamientos químicos.'],
                    ['icon' => 'Eco-Friendly.jpg', 'title' => 'Elección sostenible', 'description' => 'La sostenibilidad es otro beneficio clave. Nuestras puertas se fabrican con materiales que contienen hasta un 95% de contenido reciclado, ayudando a reducir el impacto ambiental y apoyando prácticas de fabricación responsables.'],
                    ['icon' => 'noise-reduction.jpg', 'title' => 'Reducción de ruido', 'description' => 'La comodidad dentro de un edificio depende de algo más que la estética. Nuestras puertas compuestas están diseñadas con excelentes propiedades de reducción de ruido, creando ambientes más tranquilos al minimizar la transmisión de sonido.'],
                    ['icon' => 'Flame-retardent.jpg', 'title' => 'Retardante de llama', 'description' => 'La seguridad es igualmente importante. Las puertas Erdoor cuentan con propiedades retardantes de llama, proporcionando un nivel adicional de protección para aplicaciones residenciales y comerciales.'],
                    ['icon' => 'thermal-insulation.jpg', 'title' => 'Aislamiento térmico', 'description' => 'El núcleo compuesto también proporciona un excelente aislamiento térmico, lo que ayuda a mejorar el confort interior y contribuye a una mejor eficiencia energética.'],
                    ['icon' => 'maintenance-free.jpg', 'title' => 'Libre de mantenimiento', 'description' => 'A diferencia de las puertas tradicionales, las puertas WPC no requieren mantenimiento. Nunca necesitan lijado, barnizado, sellado o pintura, conservando su hermoso acabado de madera con solo una limpieza sencilla.'],
                    ['icon' => 'warranty.jpg', 'title' => 'Hasta 25 años', 'description' => 'Debido a estas características avanzadas de rendimiento, Erdoor respalda con orgullo sus puertas interiores WPC con una garantía de hasta 25 años, brindando a los clientes confianza a largo plazo.']
                ]
            ],
            'comparison_section' => [
                'label' => 'La inversión más inteligente',
                'title' => 'Puertas WPC vs.<br>Puertas de Madera Tradicional',
                'description' => 'Las puertas de madera ofrecen una apariencia hermosa pero a menudo requieren mantenimiento continuo y son susceptibles a la humedad. Las puertas Erdoor WPC combinan la belleza natural de la madera con la durabilidad de la tecnología compuesta moderna, convirtiéndolas en una inversión más inteligente.',
                'quote' => 'Apariencia de Madera Natural. Rendimiento Compuesto Avanzado. Construidas para Durar',
                'button_text' => 'Habla con nuestro equipo',
                'button_link' => 'contact.html'
            ]
        ];

        DB::table('page_translations')->insert([
            'page_id' => $pageId,
            'title' => 'Por qué WPC',
            'slug' => 'por-que-wpc',
            'description' => 'Descubra la belleza de la madera natural y el rendimiento de las puertas Erdoor WPC.',
            'content' => json_encode($esContent),
            'locale' => 'es',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
