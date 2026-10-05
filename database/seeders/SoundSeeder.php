<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Music;
use App\Models\Video;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SoundSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create admin user
        User::create([
            'user_id'  => 'admin',
            'name'     => 'Administrator',
            'email'    => 'admin@sound.com',
            'phone'    => '9000000001',
            'address'  => 'SOUND Group HQ, Mumbai',
            'role'     => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        // 2. Create sample normal user
        User::create([
            'user_id'  => 'demo_user',
            'name'     => 'Demo User',
            'email'    => 'user@sound.com',
            'phone'    => '9000000002',
            'address'  => '123 Music Lane, Delhi',
            'role'     => 'user',
            'password' => Hash::make('user123'),
        ]);

        // 3. Categories (Genres, Languages, Artists, Albums)
        $genres = ['Pop', 'Qawwali', 'Hip-Hop', 'Romantic', 'Rock', 'Classical Fusion', 'Folk', 'Electronic', 'Indie', 'Retro'];
        foreach ($genres as $g) {
            Category::create(['name' => $g, 'type' => 'genre', 'slug' => strtolower(str_replace(' ', '-', $g))]);
        }
        foreach (['Regional', 'English', 'Hindi', 'Punjabi', 'Urdu', 'Tamil'] as $lang) {
            Category::create(['name' => $lang, 'type' => 'language', 'slug' => strtolower($lang)]);
        }
        $artists = ['Yo Yo Honey Singh', 'Atif Aslam', 'Talwinder', 'Arijit Singh', 'Rahat Fateh Ali Khan', 'Nusrat Fateh Ali Khan', 'The Weeknd', 'Ed Sheeran', 'Dua Lipa', 'Imagine Dragons'];
        foreach ($artists as $art) {
            Category::create(['name' => $art, 'type' => 'artist', 'slug' => strtolower(str_replace(' ', '-', $art))]);
        }
        $albums = ['Glory', 'Desi Kalakaar', 'Coke Studio Season 8', 'Brahmastra', 'After Hours', '÷ (Divide)', 'Future Nostalgia', 'Evolve', 'Jal Pari', 'International Villager'];
        foreach ($albums as $alb) {
            Category::create(['name' => $alb, 'type' => 'album', 'slug' => strtolower(str_replace(' ', '-', $alb))]);
        }

        // 4. 25+ Famous Music Tracks (Featuring the 5 uploaded blockbuster Yo Yo Honey Singh songs at top)
        $musicItems = [
            [
                'title'       => 'Millionaire',
                'artist'      => 'Yo Yo Honey Singh',
                'album'       => 'Glory',
                'year'        => 2024,
                'genre'       => 'Hip-Hop',
                'language'    => 'Punjabi',
                'cover_image' => '/images/millionaire.jpg',
                'audio_url'   => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
                'description' => 'Global blockbuster Punjabi hip-hop track Millionaire from Glory album with 460M+ views.',
                'is_new'      => true,
                'rating'      => 4.98,
                'rating_count'=> 460000000,
                'duration'    => '3:20',
            ],
            [
                'title'       => 'Payal',
                'artist'      => 'Yo Yo Honey Singh ft. Nora Fatehi & Paradox',
                'album'       => 'Glory',
                'year'        => 2024,
                'genre'       => 'Hip-Hop',
                'language'    => 'Punjabi',
                'cover_image' => '/images/payal.jpg',
                'audio_url'   => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3',
                'description' => 'Sensational dance track Payal featuring Nora Fatehi & Paradox with 395M+ views.',
                'is_new'      => true,
                'rating'      => 4.95,
                'rating_count'=> 395000000,
                'duration'    => '3:45',
            ],
            [
                'title'       => 'Maniac',
                'artist'      => 'Yo Yo Honey Singh',
                'album'       => 'Glory',
                'year'        => 2024,
                'genre'       => 'Hip-Hop',
                'language'    => 'Punjabi',
                'cover_image' => '/images/maniac.jpg',
                'audio_url'   => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3',
                'description' => 'High octane bass banger Maniac from Glory album with 165M+ views.',
                'is_new'      => true,
                'rating'      => 4.92,
                'rating_count'=> 165000000,
                'duration'    => '3:15',
            ],
            [
                'title'       => 'Bonita',
                'artist'      => 'Yo Yo Honey Singh ft. The Shams',
                'album'       => 'Glory',
                'year'        => 2024,
                'genre'       => 'Hip-Hop',
                'language'    => 'Punjabi',
                'cover_image' => '/images/bonita.jpg',
                'audio_url'   => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3',
                'description' => 'Atmospheric reggaeton fusion Bonita featuring The Shams with 90M+ views.',
                'is_new'      => true,
                'rating'      => 4.89,
                'rating_count'=> 90000000,
                'duration'    => '3:30',
            ],
            [
                'title'       => 'Blue Eyes',
                'artist'      => 'Yo Yo Honey Singh',
                'album'       => 'Desi Kalakaar',
                'year'        => 2013,
                'genre'       => 'Hip-Hop',
                'language'    => 'Punjabi',
                'cover_image' => '/images/blue_eyes.jpg',
                'audio_url'   => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3',
                'description' => 'All-time classic Punjabi hip-hop anthem Blue Eyes with 790M+ views across YouTube.',
                'is_new'      => false,
                'rating'      => 4.99,
                'rating_count'=> 790000000,
                'duration'    => '4:02',
            ],
            [
                'title'       => 'Tajdar-e-Haram',
                'artist'      => 'Atif Aslam',
                'album'       => 'Coke Studio Season 8',
                'year'        => 2015,
                'genre'       => 'Qawwali',
                'language'    => 'Urdu',
                'cover_image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=600&auto=format&fit=crop&q=80',
                'audio_url'   => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-6.mp3',
                'description' => 'Iconic spiritual qawwali tribute by Atif Aslam on Coke Studio.',
                'is_new'      => false,
                'rating'      => 4.95,
                'rating_count'=> 1420,
                'duration'    => '10:28',
            ],
            [
                'title'       => 'Gallan4',
                'artist'      => 'Talwinder',
                'album'       => 'Glory',
                'year'        => 2023,
                'genre'       => 'Indie',
                'language'    => 'Punjabi',
                'cover_image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=600&auto=format&fit=crop&q=80',
                'audio_url'   => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-7.mp3',
                'description' => 'Atmospheric Punjabi indie soul track by Talwinder.',
                'is_new'      => true,
                'rating'      => 4.90,
                'rating_count'=> 530,
                'duration'    => '3:45',
            ],
            [
                'title'       => 'Kesariya',
                'artist'      => 'Arijit Singh',
                'album'       => 'Brahmastra',
                'year'        => 2022,
                'genre'       => 'Romantic',
                'language'    => 'Hindi',
                'cover_image' => 'https://images.unsplash.com/photo-1518609878373-06d740f60d8b?w=600&auto=format&fit=crop&q=80',
                'audio_url'   => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-8.mp3',
                'description' => 'Melodic romantic chartbuster sung by Arijit Singh.',
                'is_new'      => false,
                'rating'      => 4.92,
                'rating_count'=> 2100,
                'duration'    => '4:28',
            ],
            [
                'title'       => 'Blinding Lights',
                'artist'      => 'The Weeknd',
                'album'       => 'After Hours',
                'year'        => 2020,
                'genre'       => 'Pop',
                'language'    => 'English',
                'cover_image' => 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=600&auto=format&fit=crop&q=80',
                'audio_url'   => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-9.mp3',
                'description' => 'Global synthwave synth-pop hit by The Weeknd.',
                'is_new'      => false,
                'rating'      => 4.96,
                'rating_count'=> 3400,
                'duration'    => '3:20',
            ],
            [
                'title'       => 'Afreen Afreen',
                'artist'      => 'Rahat Fateh Ali Khan & Momina Mustehsan',
                'album'       => 'Coke Studio Season 9',
                'year'        => 2016,
                'genre'       => 'Qawwali',
                'language'    => 'Urdu',
                'cover_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600&auto=format&fit=crop&q=80',
                'audio_url'   => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-10.mp3',
                'description' => 'Unforgettable Coke Studio classic rendition of Nusrat Fateh Ali Khan qawwali.',
                'is_new'      => false,
                'rating'      => 4.98,
                'rating_count'=> 4100,
                'duration'    => '6:45',
            ]
        ];

        foreach ($musicItems as $item) {
            Music::create($item);
        }

        // 5. 4K Concerts & Official Videos (Featuring the 5 uploaded blockbuster Yo Yo Honey Singh videos at top)
        $videoItems = [
            [
                'title'        => 'Millionaire - Yo Yo Honey Singh (Official 4K Video)',
                'artist'       => 'Yo Yo Honey Singh',
                'album'        => 'Glory',
                'year'         => 2024,
                'genre'        => 'Hip-Hop',
                'language'     => 'Punjabi',
                'thumbnail'    => '/images/millionaire.jpg',
                'video_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'description'  => 'Official 4K music video of Millionaire by Yo Yo Honey Singh with 460 Million+ views.',
                'is_new'       => true,
                'rating'       => 4.98,
                'rating_count' => 1950,
                'views'        => 460000000,
                'duration'     => '3:20',
            ],
            [
                'title'        => 'Payal - Yo Yo Honey Singh ft. Nora Fatehi & Paradox',
                'artist'       => 'Yo Yo Honey Singh',
                'album'        => 'Glory',
                'year'         => 2024,
                'genre'        => 'Hip-Hop',
                'language'     => 'Punjabi',
                'thumbnail'    => '/images/payal.jpg',
                'video_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'description'  => 'Official 4K video of Payal featuring Nora Fatehi & Paradox with 395 Million+ views.',
                'is_new'       => true,
                'rating'       => 4.96,
                'rating_count' => 1740,
                'views'        => 395000000,
                'duration'     => '3:45',
            ],
            [
                'title'        => 'Maniac - Yo Yo Honey Singh (Official 4K Video)',
                'artist'       => 'Yo Yo Honey Singh',
                'album'        => 'Glory',
                'year'         => 2024,
                'genre'        => 'Hip-Hop',
                'language'     => 'Punjabi',
                'thumbnail'    => '/images/maniac.jpg',
                'video_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'description'  => 'Official 4K video of Maniac by Yo Yo Honey Singh with 165 Million+ views.',
                'is_new'       => true,
                'rating'       => 4.92,
                'rating_count' => 1120,
                'views'        => 165000000,
                'duration'     => '3:15',
            ],
            [
                'title'        => 'Bonita - Yo Yo Honey Singh ft. The Shams',
                'artist'       => 'Yo Yo Honey Singh',
                'album'        => 'Glory',
                'year'         => 2024,
                'genre'        => 'Hip-Hop',
                'language'     => 'Punjabi',
                'thumbnail'    => '/images/bonita.jpg',
                'video_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'description'  => 'Official 4K video of Bonita featuring The Shams with 90 Million+ views.',
                'is_new'       => true,
                'rating'       => 4.89,
                'rating_count' => 890,
                'views'        => 90000000,
                'duration'     => '3:30',
            ],
            [
                'title'        => 'Blue Eyes - Yo Yo Honey Singh (Official 4K Video)',
                'artist'       => 'Yo Yo Honey Singh',
                'album'        => 'Desi Kalakaar',
                'year'         => 2013,
                'genre'        => 'Hip-Hop',
                'language'     => 'Punjabi',
                'thumbnail'    => '/images/blue_eyes.jpg',
                'video_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'description'  => 'Official 4K video of Blue Eyes with 790 Million+ views across YouTube.',
                'is_new'       => false,
                'rating'       => 4.99,
                'rating_count' => 3100,
                'views'        => 790000000,
                'duration'     => '4:02',
            ],
            [
                'title'        => 'Atif Aslam Live Concert in Dubai 4K',
                'artist'       => 'Atif Aslam',
                'album'        => 'Live World Tour',
                'year'         => 2024,
                'genre'        => 'Romantic',
                'language'     => 'Urdu',
                'thumbnail'    => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=600&auto=format&fit=crop&q=80',
                'video_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'description'  => 'Electric 4K live concert performance by Atif Aslam singing his biggest hits.',
                'is_new'       => true,
                'rating'       => 4.97,
                'rating_count' => 1850,
                'views'        => 45000,
                'duration'     => '12:45',
            ]
        ];

        foreach ($videoItems as $item) {
            Video::create($item);
        }
    }
}
