<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
                'bookname' => 'Harry Potter and the Chamber of Secrets',
                'author' => 'J.K. Rowling',
                'bookcover' => 'Harry Potter'
            ],

            [
                'bookname' => 'Harry Potter  and the Order of the Phoenix',
                'author' => 'Stephenie Meyer',
                'bookcover' => 'Harry Potter'
            ],

            [
                'bookname' => 'New Moon',
                'author' => 'Stephenie Meyer',
                'bookcover' => 'Twilight'
            ],

            [
                'bookname' => 'Breaking Dawn',
                'author' => 'Stephenie Meyer',
                'bookcover' => 'Twilight'
            ]
        ]);
    }
}
