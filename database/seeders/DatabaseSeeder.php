<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Faq;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@cuadrosresina.com',
            'phone' => '+34600123456',
            'is_admin' => true,
            'password' => Hash::make('password'),
        ]);

        $client = User::create([
            'name' => 'María García',
            'email' => 'cliente@cuadrosresina.com',
            'phone' => '+34600654321',
            'is_admin' => false,
            'password' => Hash::make('password'),
        ]);

        // 2. Categories
        $catOlas = Category::create([
            'name' => 'Olas y Efecto Océano',
            'slug' => 'olas-y-efecto-oceano',
            'description' => 'Cuadros inspirados en la rompiente de las olas, espuma marina realista y degradados de azules profundos y turquesas.',
            'image' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?auto=format&fit=crop&w=800&q=80'
        ]);

        $catGeodas = Category::create([
            'name' => 'Abstractos y Geodas',
            'slug' => 'abstractos-y-geodas',
            'description' => 'Piezas de arte abstracto con formaciones minerales simuladas, cristales de vidrio y texturas tridimensionales.',
            'image' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?auto=format&fit=crop&w=800&q=80'
        ]);

        $catMetalicos = Category::create([
            'name' => 'Acabados Dorados y Metálicos',
            'slug' => 'acabados-dorados-y-metalicos',
            'description' => 'Obras sofisticadas con hojas de oro, cobre y pigmentos metálicos que reflejan la luz con elegancia.',
            'image' => 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?auto=format&fit=crop&w=800&q=80'
        ]);

        $catPersonalizados = Category::create([
            'name' => 'Bajo Pedido y Personalizados',
            'slug' => 'bajo-pedido-y-personalizados',
            'description' => 'Diseños únicos creados a medida según tus preferencias de color, tamaño y elementos especiales.',
            'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=800&q=80'
        ]);

        // 3. Products
        $p1 = Product::create([
            'category_id' => $catOlas->id,
            'name' => 'Océano Profundo Nº 1',
            'slug' => 'oceano-profundo-1',
            'description' => 'Pieza única que captura la fuerza y belleza del mar abierto. Múltiples capas de resina epoxi de alta transparencia con efectos de espuma marina en relieve tridimensional.',
            'price' => 380.00,
            'dimensions' => '100x70 cm',
            'materials' => 'Resina epoxi UV, pigmentos náuticos, bastidor de madera de pino reforzado',
            'type' => 'unique',
            'making_time' => 'Disponible para envío inmediato',
            'stock' => 1,
            'status' => 'available',
            'featured' => true,
            'image' => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?auto=format&fit=crop&w=800&q=80',
            'care_instructions' => 'Limpiar suavemente con un paño de microfibra seco. Evitar la exposición directa y prolongada a la luz solar intensa.'
        ]);

        $p2 = Product::create([
            'category_id' => $catGeodas->id,
            'name' => 'Geoda de Amatista y Oro',
            'slug' => 'geoda-de-amatista-y-oro',
            'description' => 'Inspirada en las formaciones de cuarzo y amatista. Bordes con hoja de oro de 24k y cristales incrustados en resina translúcida.',
            'price' => 450.00,
            'dimensions' => '80x80 cm (Circular)',
            'materials' => 'Resina epoxi, cristales de vidrio triturado, hoja de oro, base de DM hidrófugo',
            'type' => 'unique',
            'making_time' => 'Disponible para envío inmediato',
            'stock' => 1,
            'status' => 'available',
            'featured' => true,
            'image' => 'https://images.unsplash.com/photo-1579546929662-711aa81148cf?auto=format&fit=crop&w=800&q=80',
            'care_instructions' => 'Mantener en interior. Limpiar con plumero o paño suave sin productos químicos abrasivos.'
        ]);

        $p3 = Product::create([
            'category_id' => $catMetalicos->id,
            'name' => 'Elegancia Cobre y Mármol',
            'slug' => 'elegancia-cobre-y-marmol',
            'description' => 'Diseño abstracto contemporáneo que combina vetas efecto mármol blanco con ríos de pigmento cobrizo brillante.',
            'price' => 310.00,
            'dimensions' => '90x60 cm',
            'materials' => 'Resina epoxi autonivelante, pigmentos metálicos cobre, tintes blancos profesionales',
            'type' => 'limited_series',
            'making_time' => '3-5 días para preparación de embalaje especial',
            'stock' => 2,
            'status' => 'available',
            'featured' => true,
            'image' => 'https://images.unsplash.com/photo-1582561251761-a0210086eb79?auto=format&fit=crop&w=800&q=80',
            'care_instructions' => 'No apoyar objetos punzantes. Limpiar con microfibra.'
        ]);

        $p4 = Product::create([
            'category_id' => $catOlas->id,
            'name' => 'Bahía Turquesa',
            'slug' => 'bahia-turquesa',
            'description' => 'Paisaje marino minimalista con transiciones suaves desde la arena cristalina hasta el azul profundo del océano.',
            'price' => 275.00,
            'dimensions' => '60x60 cm',
            'materials' => 'Resina epoxi, pigmentos perlados, bastidor entelado 3D',
            'type' => 'unique',
            'making_time' => 'Disponible para envío inmediato',
            'stock' => 1,
            'status' => 'available',
            'featured' => false,
            'image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80',
            'care_instructions' => 'Evitar fuentes directas de calor.'
        ]);

        // 4. FAQs
        Faq::create([
            'question' => '¿Los cuadros son piezas únicas?',
            'answer' => 'Sí, la gran mayoría de nuestras obras son piezas 100% artesanales y únicas. Debido a la naturaleza fluida de la resina epoxi, es imposible replicar exactamente el mismo patrón, lo que garantiza que tendrás una obra de arte exclusiva.',
            'category' => 'productos',
            'sort_order' => 1,
        ]);

        Faq::create([
            'question' => '¿Cómo se realizan los envíos de piezas frágiles?',
            'answer' => 'Utilizamos embalajes de alta resistencia diseñados a medida con múltiples capas de protección contra impactos, cantoneras reforzadas y cajas de madera o cartón rígido de doble grosor. Todos los envíos van asegurados.',
            'category' => 'envios',
            'sort_order' => 2,
        ]);

        Faq::create([
            'question' => '¿Puedo encargar un cuadro personalizado con mis colores preferidos?',
            'answer' => '¡Por supuesto! Contamos con un configurador de pedidos personalizados en nuestra web donde puedes indicarnos las medidas, paleta de colores y estilo deseado, o incluso enviarnos fotos de inspiración.',
            'category' => 'personalizacion',
            'sort_order' => 3,
        ]);

        // 5. Reviews
        Review::create([
            'user_id' => $client->id,
            'product_id' => $p1->id,
            'rating' => 5,
            'comment' => 'Absolutamente impresionante. El brillo y la profundidad de la resina en persona superan con creces las fotos. Llegó perfectamente embalado.',
            'is_approved' => true,
        ]);
    }
}
