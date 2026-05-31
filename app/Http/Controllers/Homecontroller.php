<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $destinations = $this->destinationsData();
        $treks        = $this->treksData();
        $packages     = $this->packagesData();
        $testimonials = $this->testimonialsData();

        return view('home', compact(
            'destinations',
            'treks',
            'packages',
            'testimonials'
        ));
    }

    public static function destinationsData(): array
    {
        return [
            [
                'slug'        => 'pokhara',
                'name'        => 'Pokhara',
                'label'       => 'The City of Lakes',
                'tag'         => 'Popular',
                'description' => 'Known for its stunning lakes, mountain views and adventure sports, Pokhara is Nepal\'s top tourist destination.',
                'img'         => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
                'gallery'     => [
                    'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80',
                    'https://images.unsplash.com/photo-1598091383021-15ddea10925d?w=800&q=80',
                ],
                'highlights'  => ['Phewa Lake', 'World Peace Pagoda', 'Sarangkot Sunrise', 'Davis Falls', 'Begnas Lake'],
                'best_time'   => 'October – November & March – May',
                'altitude'    => '827 m',
                'delay'       => 0,
            ],
            [
                'slug'        => 'everest-region',
                'name'        => 'Everest Region',
                'label'       => 'Roof of the World',
                'tag'         => 'Iconic',
                'description' => 'Home to the world\'s highest peak, the Everest region offers dramatic landscapes and rich Sherpa culture.',
                'img'         => 'https://images.unsplash.com/photo-1522050212171-61b01dd24579?w=800&q=80',
                'gallery'     => [
                    'https://images.unsplash.com/photo-1522050212171-61b01dd24579?w=800&q=80',
                    'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
                    'https://images.unsplash.com/photo-1529928520614-7b080df4db7a?w=800&q=80',
                ],
                'highlights'  => ['Everest Base Camp', 'Namche Bazaar', 'Tengboche Monastery', 'Kala Patthar', 'Gokyo Lakes'],
                'best_time'   => 'March – May & September – November',
                'altitude'    => '8,849 m (Everest)',
                'delay'       => 150,
            ],
            [
                'slug'        => 'annapurna-region',
                'name'        => 'Annapurna Region',
                'label'       => 'Diverse Natural Beauty',
                'tag'         => 'Top Trek',
                'description' => 'A trekker\'s paradise with diverse landscapes from subtropical forests to high alpine terrain.',
                'img'         => 'https://images.unsplash.com/photo-1598091383021-15ddea10925d?w=800&q=80',
                'gallery'     => [
                    'https://images.unsplash.com/photo-1598091383021-15ddea10925d?w=800&q=80',
                    'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
                    'https://images.unsplash.com/photo-1522050212171-61b01dd24579?w=800&q=80',
                ],
                'highlights'  => ['Annapurna Base Camp', 'Poon Hill', 'Jomsom', 'Muktinath Temple', 'Thorong La Pass'],
                'best_time'   => 'October – December & March – May',
                'altitude'    => '8,091 m (Annapurna I)',
                'delay'       => 300,
            ],
            [
                'slug'        => 'kathmandu',
                'name'        => 'Kathmandu',
                'label'       => 'Cultural Heart of Nepal',
                'tag'         => 'Heritage',
                'description' => 'Nepal\'s vibrant capital packed with UNESCO World Heritage Sites, ancient temples and bustling bazaars.',
                'img'         => 'https://images.unsplash.com/photo-1562602834-6a4e28a4e014?w=800&q=80',
                'gallery'     => [
                    'https://images.unsplash.com/photo-1562602834-6a4e28a4e014?w=800&q=80',
                    'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
                    'https://images.unsplash.com/photo-1529928520614-7b080df4db7a?w=800&q=80',
                ],
                'highlights'  => ['Pashupatinath Temple', 'Boudhanath Stupa', 'Swayambhunath', 'Thamel Bazaar', 'Durbar Square'],
                'best_time'   => 'October – April',
                'altitude'    => '1,400 m',
                'delay'       => 450,
            ],
        ];
    }

    public static function treksData(): array
    {
        return [
            [
                'slug'        => 'everest-base-camp',
                'name'        => 'Everest Base Camp Trek',
                'days'        => 14,
                'difficulty'  => 'Moderate',
                'diff_class'  => 'difficulty-moderate',
                'price'       => 1400,
                'max_altitude'=> '5,364 m',
                'start'       => 'Lukla',
                'best_season' => 'Mar–May, Sep–Nov',
                'img'         => 'https://images.unsplash.com/photo-1522050212171-61b01dd24579?w=800&q=80',
                'description' => 'The classic Himalayan trek to the base of the world\'s highest mountain. An unforgettable journey through Sherpa villages and dramatic mountain landscapes.',
                'itinerary'   => [
                    'Day 1'  => 'Fly Kathmandu to Lukla, trek to Phakding (2,610 m)',
                    'Day 2'  => 'Trek to Namche Bazaar (3,440 m)',
                    'Day 3'  => 'Acclimatization day in Namche',
                    'Day 4'  => 'Trek to Tengboche (3,860 m)',
                    'Day 5'  => 'Trek to Dingboche (4,410 m)',
                    'Day 6'  => 'Acclimatization day in Dingboche',
                    'Day 7'  => 'Trek to Lobuche (4,940 m)',
                    'Day 8'  => 'Trek to Gorak Shep & EBC (5,364 m)',
                    'Day 9'  => 'Kala Patthar (5,545 m) & return to Pheriche',
                    'Day 10' => 'Trek to Namche Bazaar',
                    'Day 11' => 'Trek to Lukla',
                    'Day 12' => 'Fly to Kathmandu',
                    'Day 13' => 'Buffer day / sightseeing',
                    'Day 14' => 'Departure',
                ],
                'includes'    => ['Airport transfers', 'Teahouse accommodation', 'All meals on trek', 'Experienced guide', 'Porter', 'All permits'],
                'delay'       => 0,
            ],
            [
                'slug'        => 'annapurna-circuit',
                'name'        => 'Annapurna Circuit Trek',
                'days'        => 16,
                'difficulty'  => 'Moderate',
                'diff_class'  => 'difficulty-moderate',
                'price'       => 1250,
                'max_altitude'=> '5,416 m',
                'start'       => 'Besisahar',
                'best_season' => 'Oct–Nov, Mar–Apr',
                'img'         => 'https://images.unsplash.com/photo-1598091383021-15ddea10925d?w=800&q=80',
                'description' => 'One of the world\'s greatest treks, circling the entire Annapurna massif through diverse landscapes, cultures and climates.',
                'itinerary'   => [
                    'Day 1'  => 'Drive Kathmandu to Besisahar',
                    'Day 2'  => 'Trek to Bahundanda (1,310 m)',
                    'Day 3'  => 'Trek to Chamje (1,430 m)',
                    'Day 4'  => 'Trek to Dharapani (1,960 m)',
                    'Day 5'  => 'Trek to Chame (2,670 m)',
                    'Day 6'  => 'Trek to Pisang (3,200 m)',
                    'Day 7'  => 'Trek to Manang (3,519 m)',
                    'Day 8'  => 'Acclimatization day in Manang',
                    'Day 9'  => 'Trek to High Camp (4,925 m)',
                    'Day 10' => 'Cross Thorong La (5,416 m) to Muktinath',
                    'Day 11' => 'Drive to Jomsom (2,720 m)',
                    'Day 12' => 'Trek to Marpha (2,670 m)',
                    'Day 13' => 'Drive to Tatopani',
                    'Day 14' => 'Trek to Ghorepani (2,860 m)',
                    'Day 15' => 'Poon Hill sunrise, trek to Nayapul, drive to Pokhara',
                    'Day 16' => 'Drive back to Kathmandu',
                ],
                'includes'    => ['Airport transfers', 'Teahouse accommodation', 'All meals on trek', 'Experienced guide', 'Porter', 'All permits'],
                'delay'       => 150,
            ],
            [
                'slug'        => 'langtang-valley',
                'name'        => 'Langtang Valley Trek',
                'days'        => 10,
                'difficulty'  => 'Easy',
                'diff_class'  => 'difficulty-easy',
                'price'       => 950,
                'max_altitude'=> '4,984 m',
                'start'       => 'Syabrubesi',
                'best_season' => 'Mar–May, Oct–Dec',
                'img'         => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80',
                'description' => 'The closest trek to Kathmandu, offering stunning mountain scenery, Tamang culture and the sacred Gosaikunda lakes.',
                'itinerary'   => [
                    'Day 1'  => 'Drive Kathmandu to Syabrubesi (1,460 m)',
                    'Day 2'  => 'Trek to Lama Hotel (2,380 m)',
                    'Day 3'  => 'Trek to Langtang Village (3,430 m)',
                    'Day 4'  => 'Trek to Kyanjin Gompa (3,870 m)',
                    'Day 5'  => 'Acclimatization – hike to Kyanjin Ri (4,984 m)',
                    'Day 6'  => 'Return to Lama Hotel',
                    'Day 7'  => 'Trek to Syabrubesi',
                    'Day 8'  => 'Drive back to Kathmandu',
                    'Day 9'  => 'Sightseeing in Kathmandu',
                    'Day 10' => 'Departure',
                ],
                'includes'    => ['Airport transfers', 'Teahouse accommodation', 'All meals on trek', 'Experienced guide', 'Porter', 'All permits'],
                'delay'       => 300,
            ],
        ];
    }

    public static function packagesData(): array
    {
        return [
            [
                'slug'       => 'nepal-highlights',
                'name'       => 'Nepal Highlights Tour',
                'days'       => 7,
                'price'      => 750,
                'featured'   => false,
                'badge'      => 'Bestseller',
                'img'        => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
                'description'=> 'A perfect introduction to Nepal — Kathmandu\'s temples, Pokhara\'s lakes, and the stunning mountain scenery.',
                'services'   => ['Hotel Accommodation', 'Breakfast', 'Sightseeing', 'Private Transport'],
                'itinerary'  => [
                    'Day 1' => 'Arrival in Kathmandu, airport transfer, hotel check-in',
                    'Day 2' => 'Kathmandu sightseeing: Pashupatinath, Boudhanath, Swayambhunath',
                    'Day 3' => 'Drive/fly to Pokhara, lakeside walk',
                    'Day 4' => 'Sarangkot sunrise, Phewa Lake, World Peace Pagoda',
                    'Day 5' => 'Mountain flight or free day in Pokhara',
                    'Day 6' => 'Return to Kathmandu, Thamel shopping',
                    'Day 7' => 'Departure transfer',
                ],
                'delay'      => 0,
            ],
            [
                'slug'       => 'cultural-heritage',
                'name'       => 'Cultural & Heritage Tour',
                'days'       => 10,
                'price'      => 1050,
                'featured'   => true,
                'badge'      => 'Most Popular',
                'img'        => 'https://images.unsplash.com/photo-1562602834-6a4e28a4e014?w=800&q=80',
                'description'=> 'Deep-dive into Nepal\'s living heritage — ancient palaces, UNESCO sites, sacred temples and living traditions.',
                'services'   => ['Hotel Accommodation', 'Breakfast', 'Sightseeing', 'Private Transport'],
                'itinerary'  => [
                    'Day 1'  => 'Arrival Kathmandu, welcome dinner',
                    'Day 2'  => 'Kathmandu Durbar Square, Freak Street, Kumari House',
                    'Day 3'  => 'Bhaktapur Durbar Square, Pottery Square',
                    'Day 4'  => 'Patan Durbar Square, Golden Temple',
                    'Day 5'  => 'Pashupatinath Aarti ceremony, Boudhanath kora',
                    'Day 6'  => 'Drive to Pokhara via Prithvi Highway',
                    'Day 7'  => 'Pokhara sightseeing, Bindhyabasini Temple',
                    'Day 8'  => 'Sarangkot sunrise, Phewa Lake boating',
                    'Day 9'  => 'Drive to Lumbini (birthplace of Buddha)',
                    'Day 10' => 'Return Kathmandu, departure',
                ],
                'delay'      => 150,
            ],
            [
                'slug'       => 'himalayan-adventure',
                'name'       => 'Himalayan Adventure Tour',
                'days'       => 14,
                'price'      => 1850,
                'featured'   => false,
                'badge'      => 'Adventure',
                'img'        => 'https://images.unsplash.com/photo-1529928520614-7b080df4db7a?w=800&q=80',
                'description'=> 'The ultimate Nepal adventure combining city culture, lakeside tranquility and a real Himalayan trek experience.',
                'services'   => ['Hotel Accommodation', 'Breakfast', 'Sightseeing', 'Private Transport'],
                'itinerary'  => [
                    'Day 1'  => 'Arrival Kathmandu',
                    'Day 2'  => 'Kathmandu sightseeing',
                    'Day 3'  => 'Fly to Lukla, trek to Phakding',
                    'Day 4'  => 'Trek to Namche Bazaar',
                    'Day 5'  => 'Acclimatization in Namche',
                    'Day 6'  => 'Trek to Tengboche',
                    'Day 7'  => 'Trek to Dingboche',
                    'Day 8'  => 'Acclimatization hike',
                    'Day 9'  => 'Trek to Lobuche',
                    'Day 10' => 'Everest Base Camp & Gorak Shep',
                    'Day 11' => 'Kala Patthar sunrise, trek down',
                    'Day 12' => 'Trek to Lukla, fly to Kathmandu',
                    'Day 13' => 'Pokhara day trip',
                    'Day 14' => 'Departure',
                ],
                'delay'      => 300,
            ],
        ];
    }

    public static function testimonialsData(): array
    {
        return [
            ['name' => 'Emily Johnson',  'location' => 'United States',  'stars' => 5, 'text' => 'Our trip to Nepal was beyond amazing! The mountains, culture, and people are incredible. Highly recommended!',                               'img' => 'https://randomuser.me/api/portraits/women/44.jpg'],
            ['name' => 'James Wilson',   'location' => 'United Kingdom',  'stars' => 5, 'text' => 'The Everest Base Camp trek was the experience of a lifetime. Our guide was fantastic and made every step worthwhile!',                       'img' => 'https://randomuser.me/api/portraits/men/32.jpg'],
            ['name' => 'Sophie Müller', 'location' => 'Germany',          'stars' => 5, 'text' => 'Pokhara is absolutely stunning. The lakeside views, the warm hospitality — Nepal has stolen my heart completely.',                           'img' => 'https://randomuser.me/api/portraits/women/65.jpg'],
            ['name' => 'Raj Sharma',    'location' => 'India',            'stars' => 5, 'text' => 'Perfectly organized tour. Everything from airport pickup to the final farewell was handled with utmost professionalism.',                     'img' => 'https://randomuser.me/api/portraits/men/75.jpg'],
        ];
    }
}