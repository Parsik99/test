<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $subjects = [
            [
                'name' => 'ООО "Колосок"',
            ],
            [
                'name' => 'ООО "Васильев и Ко"',
            ],
        ];
        $authorities = [
            [
                'name' => 'Налоговая',
            ],
            [
                'name' => 'Природоохрана',
            ],
            [
                'name' => 'Роспотребнадзор',
            ],
        ];
        $this->db->table('subjects')->insertBatch($subjects);
        $this->db->table('supervisory_authorities')->insertBatch($authorities);
    }
}
