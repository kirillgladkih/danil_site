<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_lists')->insert([
            'price'     => 150,
            'name'      => 'Рубец',
            'img_path'  => '/images/rub.jpg'
        ]);

        DB::table('product_lists')->insert([
            'price'     => 200,
            'name'      => 'Легкое "Крошка"',
            'img_path'  => '/images/leg.jpg'
        ]);

        DB::table('product_lists')->insert([
            'price'     => 300,
            'name'      => 'Бычьи семенники',
            'img_path'  => '/images/bi.jpg'
        ]);

        DB::table('admins')->insert([
            'login'         => 'admin',
            'password'      => Hash::make('admin'),
        ]);

    }
}
