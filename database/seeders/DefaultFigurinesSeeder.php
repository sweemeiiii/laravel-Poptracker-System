<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultFigurinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultFigurines = [
            ['name' => 'Minnie Ballon', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'minnie.jpg'],
            ['name' => 'Mickey TV Show', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'mickey.jpg'],
            ['name' => 'Three Nephews', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'three-nephews.jpg'],
            ['name' => 'Daisy Gift', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'daisy.jpg'],
            ['name' => 'Donald Duck Singing', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'donald-singing.jpg'],
            ['name' => 'Donald Duck Popcorn', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'donald-pop.jpg'],
            ['name' => 'Scrooge Bathtub', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'bathtub.jpg'],
            ['name' => 'Chip and Dale', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'chip-and-date.jpg'],
            ['name' => 'Chip and Dale Dream', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'chip.jpg'],
            ['name' => 'Goofy Prank', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'goofy.jpg'],
            ['name' => 'Classic Mickey', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Common', 'image_path' => 'classic-mickey.jpg'],
            ['name' => 'The Captain of Steamboat Willie', 'series' => 'Dimoo', 'edition' => 'Dimoo World Disney', 'rarity' => 'Secret', 'image_path' => 'secret.jpg'],
            ['name' => 'Show off', 'series' => 'The Monster', 'edition' => 'Lazy Yoga Series', 'rarity' => 'common', 'image_path' => 'show-off.jpg'],
            ['name' => 'Confident', 'series' => 'The Monster', 'edition' => 'Lazy Yoga Series', 'rarity' => 'common', 'image_path' => 'confident.jpg'],
            ['name' => 'Ab Roller', 'series' => 'The Monster', 'edition' => 'Lazy Yoga Series', 'rarity' => 'common', 'image_path' => 'ab-roller.jpg'],
            ['name' => 'Stretch Out', 'series' => 'The Monster', 'edition' => 'Lazy Yoga Series', 'rarity' => 'common', 'image_path' => 'stretch-out.jpg'],
            ['name' => 'Sweating', 'series' => 'The Monster', 'edition' => 'Lazy Yoga Series', 'rarity' => 'common', 'image_path' => 'sweating.jpg'],
            ['name' => 'Americano', 'series' => 'The Monster', 'edition' => 'Lazy Yoga Series', 'rarity' => 'common', 'image_path' => 'americano.jpg'],
            ['name' => 'Little Bird', 'series' => 'The Monster', 'edition' => 'Lazy Yoga Series', 'rarity' => 'common', 'image_path' => 'little-bird.jpg'],
            ['name' => 'Yoga Coach', 'series' => 'The Monster', 'edition' => 'Lazy Yoga Series', 'rarity' => 'Secret', 'image_path' => 'yoga-secret.jpg'],
            
        ];
    }
    
}
