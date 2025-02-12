<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::insert([
            [
                'name' => 'Oscar',
                'document_type' => 1,
                'document_number' => 727364571,
                'email' => 'osca@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Eduardo',
                'document_type' => 2,
                'document_number' => 104337465892,
                'email' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
