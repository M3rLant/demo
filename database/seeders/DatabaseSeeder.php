<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "name" => "admin",
                "data_brith" => "1970-01-01",
                "surname" => "admin",
                "email" => "admin@mail.com",
                "tel" => "copp",
                "role" => "admin",
                "password" => Hash::make("password"),
            ],
        ]);

        DB::table("tours")->insert([
            [
                "title" => "Аракульский Шихан+ озеро Аракуль",
                "date" => "2024-09-19",
                "path_img" => "tour2.jpg",
                "price" => "2200",
            ],
        ]);

        DB::table("tours")->insert([
            [
                "title" => "Хребет Зюраткуль",
                "date" => "2024-09-10",
                "path_img" => "tour3.jpg",
                "price" => "2300",
            ],
        ]);

        DB::table("tours")->insert([
            [
                "title" => "Озеро Тургояк и остров Веры",
                "date" => "2024-09-03",
                "path_img" => "tour4.jpg",
                "price" => "1650",
            ],
        ]);

        DB::table("tours")->insert([
            [
                "title" => "Стеклянная сказка. В гости к стеклодувам!",
                "date" => "2024-10-07",
                "path_img" => "tour5.jpg",
                "price" => "1900",
            ],
        ]);


        DB::table("tours")->insert([
            [
                "title" => "Купеческий Троицк",
                "date" => "2024-10-02",
                "path_img" => "tour6.jpg",
                "price" => "2600",
            ],
        ]);

        DB::table("tours")->insert([
            [
                "title" => "Обзорная экскурсия по Екатеринбургу",
                "date" => "2024-10-15",
                "path_img" => "tour7.jpg",
                "price" => "2600",
            ],
        ]);
    }
}
