<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Tag;
use App\Models\User;
use App\Enums\PriceRange;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        // Pre-fetch commonly used tags
        $tags = [
            'main' => [
                'tradicional' => Tag::where('name', 'Tradicional')->first(),
                'sushi' => Tag::where('name', 'Sushi')->first(),
                'ensaladas' => Tag::where('name', 'Ensaladas')->first(),
            ],
            'location' => [
                'coruna' => Tag::where('name', 'A Coruña')->first(),
                'madrid' => Tag::where('name', 'Madrid')->first(),
                'barcelona' => Tag::where('name', 'Barcelona')->first(),
                'sevilla' => Tag::where('name', 'Sevilla')->first(),
            ],
            'features' => Tag::whereIn('name', [
                'Pulpo', 'Menú del día', 'Con vistas', 'Reservas disponibles',
                'Moderno', 'Elegante', 'Experiencia', 'Degustación',
                'Terraza', 'Brunch', 'Zumos naturales', 'Pet-friendly',
                'Con barra', 'Croquetas', 'Jamón ibérico', 'Local emblemático'
            ])->get()->keyBy('name'),
        ];

        $restaurants = [
            [
                'name' => 'La Taberna del Puerto',
                'main_tag_id' => $tags['main']['tradicional']->id,
                'main_location_tag_id' => $tags['location']['coruna']->id,
                'price_range' => PriceRange::FOUR,
                'rating' => 4.5,
                'description' => 'Restaurante tradicional gallego con los mejores mariscos',
                'additional_tag_ids' => [
                    $tags['features']['Pulpo']->id,
                    $tags['features']['Menú del día']->id,
                    $tags['features']['Con vistas']->id,
                    $tags['features']['Reservas disponibles']->id,
                ]
            ],
            [
                'name' => 'Sushi Zen',
                'main_tag_id' => $tags['main']['sushi']->id,
                'main_location_tag_id' => $tags['location']['madrid']->id,
                'price_range' => PriceRange::SEVEN,
                'rating' => 4.8,
                'description' => 'Auténtica experiencia japonesa en el corazón de Madrid',
                'additional_tag_ids' => [
                    $tags['features']['Moderno']->id,
                    $tags['features']['Elegante']->id,
                    $tags['features']['Experiencia']->id,
                    $tags['features']['Degustación']->id,
                ]
            ],
            [
                'name' => 'La Terraza Verde',
                'main_tag_id' => $tags['main']['ensaladas']->id,
                'main_location_tag_id' => $tags['location']['barcelona']->id,
                'price_range' => PriceRange::THREE,
                'rating' => 4.2,
                'description' => 'Cocina saludable y vegetariana con productos locales',
                'additional_tag_ids' => [
                    $tags['features']['Terraza']->id,
                    $tags['features']['Brunch']->id,
                    $tags['features']['Zumos naturales']->id,
                    $tags['features']['Pet-friendly']->id,
                ]
            ],
            [
                'name' => 'El Rincón del Tapeo',
                'main_tag_id' => $tags['main']['tradicional']->id,
                'main_location_tag_id' => $tags['location']['sevilla']->id,
                'price_range' => PriceRange::TWO,
                'rating' => 4.6,
                'description' => 'Las mejores tapas de Sevilla en un ambiente acogedor',
                'additional_tag_ids' => [
                    $tags['features']['Con barra']->id,
                    $tags['features']['Croquetas']->id,
                    $tags['features']['Jamón ibérico']->id,
                    $tags['features']['Local emblemático']->id,
                ]
            ],
        ];

        foreach ($restaurants as $restaurantData) {
            $additionalTagIds = $restaurantData['additional_tag_ids'];
            unset($restaurantData['additional_tag_ids']);

            $restaurant = Restaurant::create([
                ...$restaurantData,
                'user_id' => $user->id,
            ]);

            $restaurant->tags()->attach($additionalTagIds);
        }
    }
}
