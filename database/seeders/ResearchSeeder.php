<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchSeeder extends Seeder
{
    public function run()
    {
        DB::table('research_opportunities')->insert([
            [
                'title' => 'AI in Healthcare Diagnostics',
                'description' => 'Exploring how machine learning can identify early-stage anomalies in X-ray imaging.',
                'status' => 'open',
                'created_at' => now(),
            ],
            [
                'title' => 'Sustainable Urban Architecture',
                'description' => 'Analyzing the impact of vertical gardens on high-rise temperature regulation.',
                'status' => 'open',
                'created_at' => now(),
            ],
            [
                'title' => 'Blockchain for Academic Verifications',
                'description' => 'A study on using decentralized ledgers to prevent certificate forgery in universities.',
                'status' => 'open',
                'created_at' => now(),
            ],
            [
                'title' => 'Mental Health & Social Media',
                'description' => 'Correlation study between short-form video consumption and attention span in teenagers.',
                'status' => 'open',
                'created_at' => now(),
            ],
            [
                'title' => 'Cybersecurity in IoT Devices',
                'description' => 'Investigating vulnerabilities in smart home devices and proposing a new encryption layer.',
                'status' => 'open',
                'created_at' => now(),
            ]
        ]);
    }
}