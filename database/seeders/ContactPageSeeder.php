<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. 'pages' tablosuna "Contact" sayfası için kayıt ekleyelim (ID büyük ihtimalle 4 olacak)
        $pageId = DB::table('pages')->insertGetId([
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // ==========================================
        // 2. İNGİLİZCE (EN) İÇERİK
        // ==========================================
        $enContent = [
            'info_section' => [
                'title' => 'Contact Information',
                'location_title' => 'Our Location',
                'location_text' => '3018 NW 79TH Avenue 33122 Doral, Florida',
                'phone_title' => 'Phone Number',
                'phone_text' => '+1 305 413 36 03',
                'email_title' => 'Email Address',
                'email_text' => 'erdoor@erdoor.us',
                'hours_title' => 'Working Hours',
                'hours_text' => 'Mon - Fri: 09:00 - 18:00<br>Sat - Sun: Closed',
                'map_query' => '3018 NW 79TH Avenue 33122 Doral, Florida'
            ],
            'form_section' => [
                'title' => 'Send a Message',
                'name_label' => 'Full Name *',
                'name_placeholder' => 'Your Name',
                'email_label' => 'Email Address *',
                'email_placeholder' => 'your@email.com',
                'phone_label' => 'Phone Number',
                'phone_placeholder' => '+1 (555) 000-0000',
                'role_label' => 'I Am A...',
                'role_placeholder' => 'Select Your Role',
                'role_options' => ['Architect', 'Contractor', 'Homeowner', 'Designer', 'Distributor'],
                'message_label' => 'Message *',
                'message_placeholder' => 'How can we help you?',
                'button_text' => 'Send Message'
            ]
        ];

        DB::table('page_translations')->insert([
            'page_id' => $pageId,
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'description' => 'Get in touch with Erdoor. Find our location, contact details, and send us a message easily.',
            'content' => json_encode($enContent),
            'locale' => 'en',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // ==========================================
        // 3. İSPANYOLCA (ES) İÇERİK
        // ==========================================
        $esContent = [
            'info_section' => [
                'title' => 'Información de Contacto',
                'location_title' => 'Nuestra Ubicación',
                'location_text' => '3018 NW 79TH Avenue 33122 Doral, Florida',
                'phone_title' => 'Número de Teléfono',
                'phone_text' => '+1 305 413 36 03',
                'email_title' => 'Correo Electrónico',
                'email_text' => 'erdoor@erdoor.us',
                'hours_title' => 'Horario de Trabajo',
                'hours_text' => 'Lun - Vie: 09:00 - 18:00<br>Sáb - Dom: Cerrado',
                'map_query' => '3018 NW 79TH Avenue 33122 Doral, Florida'
            ],
            'form_section' => [
                'title' => 'Enviar un Mensaje',
                'name_label' => 'Nombre Completo *',
                'name_placeholder' => 'Tu Nombre',
                'email_label' => 'Correo Electrónico *',
                'email_placeholder' => 'tu@email.com',
                'phone_label' => 'Número de Teléfono',
                'phone_placeholder' => '+1 (555) 000-0000',
                'role_label' => 'Soy Un...',
                'role_placeholder' => 'Selecciona tu Rol',
                'role_options' => ['Arquitecto', 'Contratista', 'Propietario', 'Diseñador', 'Distribuidor'],
                'message_label' => 'Mensaje *',
                'message_placeholder' => '¿Cómo podemos ayudarte?',
                'button_text' => 'Enviar Mensaje'
            ]
        ];

        DB::table('page_translations')->insert([
            'page_id' => $pageId,
            'title' => 'Contáctenos',
            'slug' => 'contactenos',
            'description' => 'Póngase en contacto con Erdoor. Encuentre nuestra ubicación, detalles de contacto y envíenos un mensaje.',
            'content' => json_encode($esContent),
            'locale' => 'es',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
