<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Website;
use App\Models\Positionads;
use App\Models\Roleadmin;
use App\Models\Info;
use App\Models\Tag;
use App\Models\Longtail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Basic User

        User::create([
            'role_id' => '1',
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@yahoo.co.id',
            'password' => bcrypt('superadmin123'),
            'phone' => '082112341234',
            'address' => 'Bandar Lampung',
        ]);

        User::create([
            'role_id' => '2',
            'name' => 'Redaksi',
            'username' => 'redaksi',
            'email' => 'redaksi@gmail.co.id',
            'password' => bcrypt('redaksi123'),
            'phone' => '082108210821',
            'address' => 'Bandar Lampung',
        ]);


        // Basic Role Admin

        Roleadmin::create([
            'role' => 'Super Admin',
        ]);
        Roleadmin::create([
            'role' => 'Admin',
        ]);
        Roleadmin::create([
            'role' => 'Editor',
        ]);
        Roleadmin::create([
            'role' => 'Author',
        ]);

        // Basic Category
        Category::create([
            'name' => 'NEWS',
            'slug' => 'news',
            'description' => 'Berita terbaru hari ini, berita trending topik, berita viral, trending topik indonesia',
            'excerpt' => 'Berita terbaru hari ini, berita trending topik, berita viral, trending topik indonesia',
        ]);

        Category::create([
            'name' => 'VIRALITY',
            'slug' => 'virality',
            'description' => 'Berita terbaru hari ini, berita trending topik, berita viral, trending topik indonesia',
            'excerpt' => 'Berita terbaru hari ini, berita trending topik, berita viral, trending topik indonesia',
        ]);

        Category::create([
            'name' => 'LIFESTYLE',
            'slug' => 'lifestyle',
            'description' => 'Berita terbaru hari ini, berita trending topik, berita viral, trending topik indonesia',
            'excerpt' => 'Berita terbaru hari ini, berita trending topik, berita viral, trending topik indonesia',
        ]);

        Category::create([
            'name' => 'PROFILE',
            'slug' => 'profile',
            'description' => 'Berita terbaru hari ini, berita trending topik, berita viral, trending topik indonesia',
            'excerpt' => 'Berita terbaru hari ini, berita trending topik, berita viral, trending topik indonesia',
        ]);

        Category::create([
            'name' => 'RAGAM',
            'slug' => 'ragam',
            'description' => 'Berita terbaru hari ini, berita trending topik, berita viral, trending topik indonesia',
            'excerpt' => 'Berita terbaru hari ini, berita trending topik, berita viral, trending topik indonesia',
        ]);

        // Basic Article

        Article::create([
            'category_id' => '2',
            'user_id' => '2',
            'author_id' => '2',
            'title' => 'Halo Dunia',
            'slug' => 'halo-dunia',
            'description' => 'Halo Dunia',
            'excerpt' => 'Halo Dunia',
            'body' => 'Halo Dunia',
            'headline' => 1,
            'pilihan' => 1,
            'rekomendasi' => 1,
            'status' => 1
        ]);

        // Basic Tag

        Tag::create([
            'name' => 'seo',
            'slug' => 'seo',
        ]);
        Tag::create([
            'name' => 'tips dan trik',
            'slug' => 'tips-dan-trik',
        ]);

        // Basic Longtail Keyword

        Longtail::create([
            'name' => 'apa itu longtail keyword',
            'slug' => 'apa-itu-longtail-keyword',
        ]);
        Longtail::create([
            'name' => 'apa itu artikel seo',
            'slug' => 'apa-itu-artikel-seo',
        ]);

        // Basic Website Info

        Website::create([
            'name' => 'INSELEB',
            'domain' => 'Inseleb.com',
            'slug' => 'inseleb',
            'slogan' => 'Mengulik, Tak Sekedar Menggelitik',
            'description' => 'Berita terbaru hari ini, nasional, internasional, viral, trending topik, travel, wisata dan kuliner',
            'meta_title' => 'Inseleb',
            'meta_description' => 'Berita terbaru hari ini, nasional, internasional, viral, trending topik, travel, wisata dan kuliner',
            'meta_keyword' => 'berita terbaru,berita hari ini,info terbaru,berita terkini,trending topik,viral,berita indonesia,info indonesia,indonesia update,kabar indonesia,berita internasional,travel,wisata,kuliner',
        ]);

        // Basic Ads Positions

        Positionads::create([
            'name' => 'Header',
        ]);
        Positionads::create([
            'name' => 'Footer',
        ]);
        Positionads::create([
            'name' => 'Dibawah Headline',
        ]);
        Positionads::create([
            'name' => 'Home 1',
        ]);
        Positionads::create([
            'name' => 'Home 2',
        ]);
        Positionads::create([
            'name' => 'Home 3',
        ]);
        Positionads::create([
            'name' => 'Home 4',
        ]);
        Positionads::create([
            'name' => 'Sidebar 1',
        ]);
        Positionads::create([
            'name' => 'Sidebar 2',
        ]);
        Positionads::create([
            'name' => 'Sidebar 3',
        ]);
        Positionads::create([
            'name' => 'Sidebar 4',
        ]);
        Positionads::create([
            'name' => 'Sidebar 5',
        ]);
        Positionads::create([
            'name' => 'Didalam Artikel',
        ]);
        Positionads::create([
            'name' => 'Dibawah Artikel',
        ]);

        // Basic Footer Info

        Info::create([
            'title' => 'Tentang Kami',
            'slug' => 'tentang-kami',
            'description' => 'Tentang Kami dari Situs Anda',
            'body' => 'Tentang Kami dari Situs Anda',
        ]);

        Info::create([
            'title' => 'Redaksi',
            'slug' => 'redaksi',
            'description' => 'Redaksi dari Situs Anda',
            'body' => 'Redaksi dari Situs Anda',
        ]);

        Info::create([
            'title' => 'Kontak',
            'slug' => 'kontak',
            'description' => 'Kontak dari Situs Anda',
            'body' => 'Kontak dari Situs Anda',
        ]);

        Info::create([
            'title' => 'Pedoman Siber',
            'slug' => 'pedoman-siber',
            'description' => 'Pedoman Media Siber dari Situs Anda',
            'body' => 'Pedoman Media Siber dari Situs Anda',
        ]);

        Info::create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'description' => 'Privasi dan Kebijakan dari Situs Anda',
            'body' => 'Privasi dan Kebijakan dari Situs Anda',
        ]);
    }
}
