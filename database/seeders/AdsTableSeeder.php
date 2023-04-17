<?php

namespace Database\Seeders;

use App\Models\Ad;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();

        // $image1 = Storage::url($faker->image(public_path('ad_images'), 640, 480, null, false));
        // $image2 = Storage::url($faker->image(public_path('ad_images'), 640, 480, null, false));
        // $image3 = Storage::url($faker->image(public_path('ad_images'), 640, 480, null, false));


        // DB::table('ads')->insert([
        //     ['id' => 1, 'title' => $faker->sentence(3), 'body' => $faker->paragraph(3), 'price' => $faker->randomFloat(2, 10, 500), 'views' => $faker->numberBetween(0, 100), 'image1' => $image1, 'image2' => $image2, 'image3' => $image3, 'user_id' => $faker->numberBetween(1, 3), 'category_id' => $faker->numberBetween(1, 5), 'created_at' => $faker->dateTimeBetween('-1 year', 'now'), 'updated_at' => now()],
            
        // ]);
        

        $ads = [
            [
                'title' => 'BMW 2.0',
                'body' => 'Super sportski automobil na prodaji. Zvati za detalje',
                'price' => 250999,
                'image1' => 'bmw_image1.jpg',
                'image2' => 'bmw_image2.jpg',
                'image3' => 'bmw_image3.jpg',
                'user_id' => 1,
                'category_id' => 1,
            ],

            [
                'title' => 'Kucni alat',
                'body' => 'Alat koji je svakoj kuci potreban. Zaista povoljno i kvalitetno',
                'price' => 14999,
                'image1' => 'kuca_alat1.jpg',
                'image2' => 'kuca_alat2.jpg',
                'image3' => 'kuca_alat3.jpg',
                'user_id' => 2,
                'category_id' => 2,
            ],

            [
                'title' => 'Dell Notepad Thinker 200',
                'body' => 'Laptop kupljen pre mesec dana. Jos u garanciji. Svaka provera je moguca. Zvati na 063 / 333-333',
                'price' => 79000,
                'image1' => 'dell1.jpg',
                'image2' => 'dell2.jpg',
                'image3' => 'dell3.jpg',
                'user_id' => 1,
                'category_id' => 5,
            ],

            [
                'title' => 'Majstorski alat',
                'body' => 'Alat koji treba da poseduju svi majstori. Najbolji majstorski alat koji cete naci na ovim oglasima.',
                'price' => 12350,
                'image1' => 'alat1.jpg',
                'image2' => 'alat2.jpg',
                'image3' => 'alat3.jpg',
                'user_id' => 2,
                'category_id' => 2,
            ],

            [
                'title' => 'Oldtimer',
                'body' => 'Automobil sportskog izgleda iz sedamdesetih! Ovako nesto necete videti nigde',
                'price' => 333332,
                'image1' => 'oldtimer1.jpg',
                'image2' => 'oldtimer2.jpg',
                'image3' => 'oldtimer3.jpg',
                'user_id' => 3,
                'category_id' => 1,
            ],

            [
                'title' => 'Samsung Galaxy S23',
                'body' => 'Telefon najnovije generacije. Prodajem sa svom pratecom opremom i originalnom maskom kupljenom u MTS-u',
                'price' => 34500,
                'image1' => 'samsung1.jpg',
                'image2' => 'samsung2.jpg',
                'image3' => 'samsung3.jpg',
                'user_id' => 3,
                'category_id' => 3,
            ],

            [
                'title' => 'Violoncelo',
                'body' => 'Klasican instrument marke Marcello. Za detaljne informacije pitati inbox u svako doba',
                'price' => 455000,
                'image1' => 'celo1.jpg',
                'image2' => 'celo2.jpg',
                'image3' => 'celo3.jpg',
                'user_id' => 4,
                'category_id' => 6,
            ],

            [
                'title' => 'Najveca kolekcija stripova',
                'body' => 'Ovde cete naci strip za svaciji ukus. Zaista povoljno,licna kolekcija Vise pogledajte na www.stripovi.rs',
                'price' => 999,
                'image1' => 'comic1.jpg',
                'image2' => 'comic2.jpg',
                'user_id' => 4,
                'category_id' => 4,
            ],

            [
                'title' => 'I-Phone 13',
                'body' => 'Na prodaji. U odlicnom stanju. Prateca oprema je ukljucena u cenu. Slobodno me kontaktirajte za vise informacija putem poruka',
                'price' => 90888,
                'image1' => 'phone1.jpg',
                'image2' => 'phone2.jpg',
                'image3' => 'phone3.jpg',
                'user_id' => 5,
                'category_id' => 3,
            ],

            [
                'title' => 'Mercedes-Benz Coupe',
                'body' => 'Jedna poslastica za sve ljubitelje dobrih automobila',
                'price' => 355000,
                'image1' => 'mercedes1.jpg',
                'image2' => 'mercedes2.jpg',
                'image3' => 'mercedes3.jpg',
                'user_id' => 5,
                'category_id' => 1,
            ],

            [
                'title' => 'VW Buba',
                'body' => 'Stara dobra Buba na prodaji. Automobil u besprekornom stanju',
                'price' => 122000,
                'image1' => 'buba1.jpg',
                'image2' => 'buba2.jpg',
                'image3' => 'buba3.jpg',
                'user_id' => 3,
                'category_id' => 1,
            ],
        ];

        foreach ($ads as $ad) {
            Ad::create($ad);
        }
    }
}