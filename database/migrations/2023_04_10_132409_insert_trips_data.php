<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertTripsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('trips')->insert([
            [
                'id' => 1,
                'slug' => 'Iasi-1',
                'title' => 'Hotel Unirea',
                'description' => 'Description',
                'image' => '/images/hotel-unirea-iasi-57.jpg',
                'location' => 'Iasi',
                'price' => 500.00,
                'created_at' => '2023-04-06 12:14:44',
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'slug' => 'Iasi-2',
                'title' => 'Hotel Unirea',
                'description' => 'Description',
                'image' => '/images/hotel-unirea-iasi-57.jpg',
                'location' => 'Iasi',
                'price' => 450.00,
                'created_at' => '2023-04-06 12:40:04',
                'updated_at' => '2023-04-06 12:40:04',
            ],
            [
                'id' => 3,
                'slug' => 'Iasi-3',
                'title' => 'Hotel Unirea',
                'description' => 'Description',
                'image' => '/images/hotel-unirea-iasi-57.jpg',
                'location' => 'Iasi',
                'price' => 460.00,
                'created_at' => '2023-04-06 12:40:04',
                'updated_at' => '2023-04-06 12:40:04',
            ],
            [
                'id' => 4,
                'slug' => 'Iasi-4',
                'title' => 'Hotel Unirea',
                'description' => 'Description',
                'image' => '/images/hotel-unirea-iasi-57.jpg',
                'location' => 'Iasi',
                'price' => 350.00,
                'created_at' => '2023-04-06 12:40:04',
                'updated_at' => '2023-04-06 12:40:04',
            ],
            [
                'id' => 5,
                'slug' => 'Iasi-5',
                'title' => 'Hotel Unirea',
                'description' => 'Description',
                'image' => '/images/hotel-unirea-iasi-57.jpg',
                'location' => 'Iasi',
                'price' => 360.00,
                'created_at' => '2023-04-06 12:40:04',
                'updated_at' => '2023-04-06 12:40:04',
            ],
            [
                'id' => 6,
                'slug' => 'Iasi-6',
                'title' => 'Hotel Traian',
                'description' => 'Description',
                'image' => '/images/hotel-unirea-iasi-57.jpg',
                'location' => 'Iasi',
                'price' => 370.00,
                'created_at' => '2023-04-06 12:40:04',
                'updated_at' => '2023-04-06 12:40:04',
            ],
            [
                'id' => 7,
                'slug' => 'Brasov-1',
                'title' => 'Hotel Brasov',
                'description' => 'Description',
                'image' => '/images/hotel-unirea-iasi-57.jpg',
                'location' => 'Brasov',
                'price' => 400.00,
                'created_at' => '2023-04-06 12:40:04',
                'updated_at' => '2023-04-06 12:40:04',
            ],
            [
                'id' => 8,
                'slug' => 'Brasov-2',
                'title' => 'Hotel Brasov',
                'description' => 'Description',
                'image' => '/images/hotel-unirea-iasi-57.jpg',
                'location' => 'Brasov',
                'price' => 390.00,
                'created_at' => '2023-04-06 12:40:04',
                'updated_at' => '2023-04-06 12:40:04',
            ],
            [
                'id' => 9,
                'slug' => 'Paris-1',
                'title' => 'Hotel Paris',
                'description' => 'Description',
                'image' => '/images/hotel-unirea-iasi-57.jpg',
                'location' => 'Paris',
                'price' => 200.00,
                'created_at' => '2023-04-06 12:40:04',
                'updated_at' => '2023-04-06 12:40:04',
            ],
            [
                'id' => 10,
                'slug' => 'Paris-2',
                'title' => 'Hotel Paris',
                'description' => 'Description',
                'image' => '/images/hotel-unirea-iasi-57.jpg',
                'location' => 'Paris',
                'price' => 300.00,
                'created_at' => '2023-04-06 12:40:04',
                'updated_at' => '2023-04-06 12:40:04',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
