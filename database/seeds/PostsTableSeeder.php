<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
            ['id' => 1, 'nama' => 'Novri', 'jabatan' => 'Admin', 'status' => 'enabled', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );
        
        DB::table('posts')->insert($posts);
    }
}
