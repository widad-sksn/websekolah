<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'school_name', 'value' => 'MTs MUHAMMADIYAH 32 SUMBERAGUNG', 'type' => 'text'],
            ['key' => 'school_alias', 'value' => 'MTs MUGADA', 'type' => 'text'],
            ['key' => 'school_motto', 'value' => 'Mendidik Generasi Berakhlak Mulia & Berprestasi', 'type' => 'text'],
            ['key' => 'school_logo', 'value' => '', 'type' => 'image'],
            ['key' => 'school_favicon', 'value' => '', 'type' => 'image'],
            ['key' => 'school_address', 'value' => 'Perguruan Muhammadiyah Sumberagung, Lamongan', 'type' => 'text'],
            ['key' => 'school_phone', 'value' => '-', 'type' => 'text'],
            ['key' => 'school_email', 'value' => 'mts.mugada@gmail.com', 'type' => 'text'],
            ['key' => 'school_website', 'value' => 'https://mtsmugada.sch.id', 'type' => 'text'],
            ['key' => 'school_whatsapp', 'value' => '6281234567890', 'type' => 'text'],
            ['key' => 'school_maps', 'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.3384218883656!2d112.29653191141386!3d-6.728442865768846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77b7000af420cf%3A0xe7fcc5c1f0b9f939!2sPerguruan%20Muhammadiyah%20Sumberagung!5e0!3m2!1sen!2sid!4v1718090000000!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'type' => 'text'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/mts.mugada.sumberagung', 'type' => 'text'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/mts.mugada', 'type' => 'text'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@mts.mugada', 'type' => 'text'],
            ['key' => 'social_tiktok', 'value' => 'https://tiktok.com/@mts.mugada', 'type' => 'text'],
            ['key' => 'operational_hours', 'value' => 'Senin - Sabtu: 07.00 - 14.00', 'type' => 'text'],
            ['key' => 'footer_copyright', 'value' => '© ' . date('Y') . ' MTs MUGADA Sumberagung. All rights reserved.', 'type' => 'text'],
            ['key' => 'color_primary', 'value' => '#2563EB', 'type' => 'text'],
            ['key' => 'color_secondary', 'value' => '#38BDF8', 'type' => 'text'],
            ['key' => 'ppdb_status', 'value' => '1', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            $existing = \App\Models\Setting::where('key', $setting['key'])->first();
            if ($existing) {
                // Only update if it's currently holding the old placeholder value
                if (str_contains($existing->value, 'Contoh') || str_contains($existing->value, 'SMAN 1') || $existing->value == '021-1234567' || $existing->value == 'https://facebook.com' || str_contains($existing->value, 'Jakarta') || $existing->value == 'Unggul dalam Prestasi, Santun dalam Budi Pekerti' || str_contains($existing->value, 'Senin - Jumat: 07.00 - 15.00')) {
                    $existing->update(['value' => $setting['value']]);
                }
            } else {
                \App\Models\Setting::create([
                    'key' => $setting['key'],
                    'value' => $setting['value'],
                    'type' => $setting['type']
                ]);
            }
        }
    }
}
