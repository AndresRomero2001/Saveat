<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $location_tags = [
            // Andalucía
            ['name' => 'Andalucía', 'is_location' => true, 'is_default' => true],
            ['name' => 'Almería', 'is_location' => true, 'is_default' => true],
            ['name' => 'Cádiz', 'is_location' => true, 'is_default' => true],
            ['name' => 'Córdoba', 'is_location' => true, 'is_default' => true],
            ['name' => 'Granada', 'is_location' => true, 'is_default' => true],
            ['name' => 'Huelva', 'is_location' => true, 'is_default' => true],
            ['name' => 'Jaén', 'is_location' => true, 'is_default' => true],
            ['name' => 'Málaga', 'is_location' => true, 'is_default' => true],
            ['name' => 'Sevilla', 'is_location' => true, 'is_default' => true],

            // Aragón
            ['name' => 'Aragón', 'is_location' => true, 'is_default' => true],
            ['name' => 'Huesca', 'is_location' => true, 'is_default' => true],
            ['name' => 'Teruel', 'is_location' => true, 'is_default' => true],
            ['name' => 'Zaragoza', 'is_location' => true, 'is_default' => true],

            // Asturias
            ['name' => 'Asturias (ca)', 'is_location' => true, 'is_default' => true],
            ['name' => 'Asturias', 'is_location' => true, 'is_default' => true],

            // Islas Baleares
            ['name' => 'Islas Baleares (ca)', 'is_location' => true, 'is_default' => true],
            ['name' => 'Islas Baleares', 'is_location' => true, 'is_default' => true],

            // Canarias
            ['name' => 'Canarias', 'is_location' => true, 'is_default' => true],
            ['name' => 'Las Palmas', 'is_location' => true, 'is_default' => true],
            ['name' => 'Santa Cruz de Tenerife', 'is_location' => true, 'is_default' => true],

            // Cantabria
            ['name' => 'Cantabria (ca)', 'is_location' => true, 'is_default' => true],
            ['name' => 'Cantabria', 'is_location' => true, 'is_default' => true],

            // Castilla-La Mancha
            ['name' => 'Castilla-La Mancha', 'is_location' => true, 'is_default' => true],
            ['name' => 'Albacete', 'is_location' => true, 'is_default' => true],
            ['name' => 'Ciudad Real', 'is_location' => true, 'is_default' => true],
            ['name' => 'Cuenca', 'is_location' => true, 'is_default' => true],
            ['name' => 'Guadalajara', 'is_location' => true, 'is_default' => true],
            ['name' => 'Toledo', 'is_location' => true, 'is_default' => true],

            // Castilla y León
            ['name' => 'Castilla y León', 'is_location' => true, 'is_default' => true],
            ['name' => 'Ávila', 'is_location' => true, 'is_default' => true],
            ['name' => 'Burgos', 'is_location' => true, 'is_default' => true],
            ['name' => 'León', 'is_location' => true, 'is_default' => true],
            ['name' => 'Palencia', 'is_location' => true, 'is_default' => true],
            ['name' => 'Salamanca', 'is_location' => true, 'is_default' => true],
            ['name' => 'Segovia', 'is_location' => true, 'is_default' => true],
            ['name' => 'Soria', 'is_location' => true, 'is_default' => true],
            ['name' => 'Valladolid', 'is_location' => true, 'is_default' => true],
            ['name' => 'Zamora', 'is_location' => true, 'is_default' => true],

            // Cataluña
            ['name' => 'Cataluña', 'is_location' => true, 'is_default' => true],
            ['name' => 'Barcelona', 'is_location' => true, 'is_default' => true],
            ['name' => 'Girona', 'is_location' => true, 'is_default' => true],
            ['name' => 'Lleida', 'is_location' => true, 'is_default' => true],
            ['name' => 'Tarragona', 'is_location' => true, 'is_default' => true],

            // Comunidad de Madrid
            ['name' => 'Comunidad de Madrid', 'is_location' => true, 'is_default' => true],
            ['name' => 'Madrid', 'is_location' => true, 'is_default' => true],

            // Comunidad Valenciana
            ['name' => 'Comunidad Valenciana', 'is_location' => true, 'is_default' => true],
            ['name' => 'Alicante', 'is_location' => true, 'is_default' => true],
            ['name' => 'Castellón', 'is_location' => true, 'is_default' => true],
            ['name' => 'Valencia', 'is_location' => true, 'is_default' => true],

            // Extremadura
            ['name' => 'Extremadura', 'is_location' => true, 'is_default' => true],
            ['name' => 'Badajoz', 'is_location' => true, 'is_default' => true],
            ['name' => 'Cáceres', 'is_location' => true, 'is_default' => true],

            // Galicia
            ['name' => 'Galicia', 'is_location' => true, 'is_default' => true],
            ['name' => 'A Coruña', 'is_location' => true, 'is_default' => true],
            ['name' => 'Lugo', 'is_location' => true, 'is_default' => true],
            ['name' => 'Ourense', 'is_location' => true, 'is_default' => true],
            ['name' => 'Pontevedra', 'is_location' => true, 'is_default' => true],

            // La Rioja
            ['name' => 'La Rioja (ca)', 'is_location' => true, 'is_default' => true],
            ['name' => 'La Rioja', 'is_location' => true, 'is_default' => true],

            // Navarra
            ['name' => 'Navarra (ca)', 'is_location' => true, 'is_default' => true],
            ['name' => 'Navarra', 'is_location' => true, 'is_default' => true],

            // País Vasco
            ['name' => 'País Vasco', 'is_location' => true, 'is_default' => true],
            ['name' => 'Álava', 'is_location' => true, 'is_default' => true],
            ['name' => 'Gipuzkoa', 'is_location' => true, 'is_default' => true],
            ['name' => 'Bizkaia', 'is_location' => true, 'is_default' => true],

            // Región de Murcia
            ['name' => 'Región de Murcia', 'is_location' => true, 'is_default' => true],
            ['name' => 'Murcia', 'is_location' => true, 'is_default' => true],

            // Autonomous Cities
            ['name' => 'Ceuta', 'is_location' => true, 'is_default' => true],
            ['name' => 'Melilla', 'is_location' => true, 'is_default' => true],
        ];

        $non_location_tags = [
            // Cuisines/Types of Food
            ['name' => 'Tapas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Paella', 'is_location' => false, 'is_default' => true],
            ['name' => 'Marisco', 'is_location' => false, 'is_default' => true],
            ['name' => 'Asador', 'is_location' => false, 'is_default' => true],
            ['name' => 'Pescado', 'is_location' => false, 'is_default' => true],
            ['name' => 'Comida rápida', 'is_location' => false, 'is_default' => true],
            ['name' => 'Comida casera', 'is_location' => false, 'is_default' => true],
            ['name' => 'Cocina de autor', 'is_location' => false, 'is_default' => true],
            ['name' => 'Mediterránea', 'is_location' => false, 'is_default' => true],
            ['name' => 'Italiana', 'is_location' => false, 'is_default' => true],
            ['name' => 'Mexicana', 'is_location' => false, 'is_default' => true],
            ['name' => 'Americana', 'is_location' => false, 'is_default' => true],
            ['name' => 'Japonesa', 'is_location' => false, 'is_default' => true],
            ['name' => 'China', 'is_location' => false, 'is_default' => true],
            ['name' => 'India', 'is_location' => false, 'is_default' => true],
            ['name' => 'Árabe', 'is_location' => false, 'is_default' => true],
            ['name' => 'Peruana', 'is_location' => false, 'is_default' => true],
            ['name' => 'Tailandesa', 'is_location' => false, 'is_default' => true],
            ['name' => 'Coreana', 'is_location' => false, 'is_default' => true],
            ['name' => 'Francesa', 'is_location' => false, 'is_default' => true],
            ['name' => 'Griega', 'is_location' => false, 'is_default' => true],
            ['name' => 'Argentina', 'is_location' => false, 'is_default' => true],
            ['name' => 'Brasileña', 'is_location' => false, 'is_default' => true],
            ['name' => 'Cubana', 'is_location' => false, 'is_default' => true],
            ['name' => 'Turca', 'is_location' => false, 'is_default' => true],
            ['name' => 'Vietnamita', 'is_location' => false, 'is_default' => true],
            ['name' => 'Filipina', 'is_location' => false, 'is_default' => true],
            ['name' => 'Africana', 'is_location' => false, 'is_default' => true],
            ['name' => 'Alemana', 'is_location' => false, 'is_default' => true],
            ['name' => 'Portuguesa', 'is_location' => false, 'is_default' => true],
            ['name' => 'Oriental', 'is_location' => false, 'is_default' => true],

            // Diets and Restrictions
            ['name' => 'Vegetariana', 'is_location' => false, 'is_default' => true],
            ['name' => 'Vegana', 'is_location' => false, 'is_default' => true],
            ['name' => 'Sin gluten', 'is_location' => false, 'is_default' => true],
            ['name' => 'Baja en calorías', 'is_location' => false, 'is_default' => true],
            ['name' => 'Orgánica', 'is_location' => false, 'is_default' => true],
            ['name' => 'Kosher', 'is_location' => false, 'is_default' => true],
            ['name' => 'Halal', 'is_location' => false, 'is_default' => true],
            ['name' => 'Sano', 'is_location' => false, 'is_default' => true],

            // Restaurant Features
            ['name' => 'Buffet libre', 'is_location' => false, 'is_default' => true],
            ['name' => 'Barbacoa', 'is_location' => false, 'is_default' => true],
            ['name' => 'Terraza', 'is_location' => false, 'is_default' => true],
            ['name' => 'Comida para llevar', 'is_location' => false, 'is_default' => true],
            ['name' => 'A domicilio', 'is_location' => false, 'is_default' => true],
            ['name' => 'Alta cocina', 'is_location' => false, 'is_default' => true],
            ['name' => 'Romántico', 'is_location' => false, 'is_default' => true],
            ['name' => 'Pet-friendly', 'is_location' => false, 'is_default' => true],
            ['name' => 'Música en vivo', 'is_location' => false, 'is_default' => true],
            ['name' => 'Grupos', 'is_location' => false, 'is_default' => true],
            ['name' => 'Brunch', 'is_location' => false, 'is_default' => true],
            ['name' => 'Degustación', 'is_location' => false, 'is_default' => true],
            ['name' => 'Exclusivo', 'is_location' => false, 'is_default' => true],
            ['name' => 'Con vistas', 'is_location' => false, 'is_default' => true],
            ['name' => 'De temporada', 'is_location' => false, 'is_default' => true],
            ['name' => 'Tradicional', 'is_location' => false, 'is_default' => true],
            ['name' => 'Fusión', 'is_location' => false, 'is_default' => true],
            ['name' => 'Moderno', 'is_location' => false, 'is_default' => true],

            // Specific Dishes
            ['name' => 'Bocadillos', 'is_location' => false, 'is_default' => true],
            ['name' => 'Hamburguesas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Ensaladas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Pizza', 'is_location' => false, 'is_default' => true],
            ['name' => 'Sushi', 'is_location' => false, 'is_default' => true],
            ['name' => 'Ramen', 'is_location' => false, 'is_default' => true],
            ['name' => 'Tacos', 'is_location' => false, 'is_default' => true],
            ['name' => 'Burritos', 'is_location' => false, 'is_default' => true],
            ['name' => 'Nachos', 'is_location' => false, 'is_default' => true],
            ['name' => 'Arepas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Empanadas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Curry', 'is_location' => false, 'is_default' => true],
            ['name' => 'Shawarma', 'is_location' => false, 'is_default' => true],
            ['name' => 'Falafel', 'is_location' => false, 'is_default' => true],
            ['name' => 'Gyozas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Ceviche', 'is_location' => false, 'is_default' => true],
            ['name' => 'Pollo frito', 'is_location' => false, 'is_default' => true],
            ['name' => 'Costillas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Pulpo', 'is_location' => false, 'is_default' => true],
            ['name' => 'Tortilla española', 'is_location' => false, 'is_default' => true],
            ['name' => 'Croquetas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Jamón ibérico', 'is_location' => false, 'is_default' => true],
            ['name' => 'Gazpacho', 'is_location' => false, 'is_default' => true],
            ['name' => 'Salmorejo', 'is_location' => false, 'is_default' => true],
            ['name' => 'Churros', 'is_location' => false, 'is_default' => true],

            // Desserts and Sweets
            ['name' => 'Postres', 'is_location' => false, 'is_default' => true],
            ['name' => 'Pastelería', 'is_location' => false, 'is_default' => true],
            ['name' => 'Helados', 'is_location' => false, 'is_default' => true],
            ['name' => 'Tartas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Crepes', 'is_location' => false, 'is_default' => true],
            ['name' => 'Brownies', 'is_location' => false, 'is_default' => true],
            ['name' => 'Galletas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Pudding', 'is_location' => false, 'is_default' => true],
            ['name' => 'Tiramisú', 'is_location' => false, 'is_default' => true],
            ['name' => 'Macarons', 'is_location' => false, 'is_default' => true],
            ['name' => 'Donuts', 'is_location' => false, 'is_default' => true],
            ['name' => 'Mousse', 'is_location' => false, 'is_default' => true],
            ['name' => 'Sorbete', 'is_location' => false, 'is_default' => true],
            ['name' => 'Tarta de queso', 'is_location' => false, 'is_default' => true],

            // Drinks
            ['name' => 'Café', 'is_location' => false, 'is_default' => true],
            ['name' => 'Té', 'is_location' => false, 'is_default' => true],
            ['name' => 'Vino', 'is_location' => false, 'is_default' => true],
            ['name' => 'Cerveza', 'is_location' => false, 'is_default' => true],
            ['name' => 'Cócteles', 'is_location' => false, 'is_default' => true],
            ['name' => 'Smoothies', 'is_location' => false, 'is_default' => true],
            ['name' => 'Zumos naturales', 'is_location' => false, 'is_default' => true],
            ['name' => 'Batidos', 'is_location' => false, 'is_default' => true],

            // Other Tags
            ['name' => 'Abierto 24 horas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Solo cenas', 'is_location' => false, 'is_default' => true],
            ['name' => 'Menú del día', 'is_location' => false, 'is_default' => true],
            ['name' => 'Reservas disponibles', 'is_location' => false, 'is_default' => true],
            ['name' => 'Self-service', 'is_location' => false, 'is_default' => true],
            ['name' => 'Con barra', 'is_location' => false, 'is_default' => true],
            ['name' => 'Experiencia', 'is_location' => false, 'is_default' => true],
            ['name' => 'Local emblemático', 'is_location' => false, 'is_default' => true],
            ['name' => 'Comida internacional', 'is_location' => false, 'is_default' => true],
            ['name' => 'Elegante', 'is_location' => false, 'is_default' => true],
        ];

        foreach (array_merge($location_tags, $non_location_tags) as $tag) {
            Tag::create($tag);
        }
    }
}
