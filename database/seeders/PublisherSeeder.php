<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedPublisher = [
            [
                'name' => 'Simon & Schuster',
                'city' => 'New York City',
                'country' => 'USA',
            ],
            [
                'name' => 'HarperCollins',
                'city' => 'New York City',
                'country' => 'USA',
            ],
            [
                'name' => 'Pearson Education',
                'city' => 'London',
                'country' => 'GBR',
            ],
        ];

        foreach ($seedPublisher as $publisher) {
            Publisher::create([
                'name' => $publisher['name'],
                'city' => $publisher['city'],
                'country' => $publisher['country'],
            ]);
        }
    }
}
