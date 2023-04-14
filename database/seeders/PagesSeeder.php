<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            'Terms and Conditions',
            'Privacy Policy'
        ];

        foreach ($pages as $page) {
            Page::create([
                'title' => $page,
                'content' => 'lorem ipsum'
            ]);
        }
    }
}
