<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $mul_rows= [
            [
              'title' => 'Php',
              'description' => 'To learn Php',
              'status' =>'1',
              'create_user_id' => '1',
              'updated_user_id' => '1',
            ],
            [
                'title' => 'Angular',
                'description' => 'To learn Angular',
                'status' =>'2',
                'create_user_id' => '2',
                'updated_user_id' => '2',
            ]
        ];
        foreach ($mul_rows as $rows) {
          $insert= DB::table('posts')->insert($rows);
        }
    }
}
