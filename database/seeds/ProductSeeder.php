<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'name' => 'Camisa',
                'stock' => '2',
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi id magni suscipit dolorem eveniet, corrupti eligendi atque. Ipsa qui nihil eligendi dignissimos voluptatum placeat neque omnis maxime. Labore, perferendis non.', 
                'price' => '12000',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQQvtrfV-lj3ZrpxJ0MQZx5-eN3izrMJc8qog&usqp=CAU',
                'iva' => '19',
                'branch_id' => '1'
            ],
            [
                'name' => 'Papaya',
                'stock' => '7',
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi id magni suscipit dolorem eveniet, corrupti eligendi atque. Ipsa qui nihil eligendi dignissimos voluptatum placeat neque omnis maxime. Labore, perferendis non.', 
                'price' => '12000',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQQvtrfV-lj3ZrpxJ0MQZx5-eN3izrMJc8qog&usqp=CAU',
                'iva' => '19',
                'branch_id' => '1'
            ],
            [
                'name' => 'Arroz',
                'stock' => '34',
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi id magni suscipit dolorem eveniet, corrupti eligendi atque. Ipsa qui nihil eligendi dignissimos voluptatum placeat neque omnis maxime. Labore, perferendis non.', 
                'price' => '12000',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQQvtrfV-lj3ZrpxJ0MQZx5-eN3izrMJc8qog&usqp=CAU',
                'iva' => '19',
                'branch_id' => '1'
            ]
        );
        DB::table('products')->insert($data);
    }
}
