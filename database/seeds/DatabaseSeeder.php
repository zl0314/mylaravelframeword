<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run ()
    {
        // $this->call(UsersTableSeeder::class);
        $fileSystem = new Filesystem();
        $database = $fileSystem->get( base_path( 'database/seeds' ) . '/' . 'seed.sql' );
        DB::connection()->getPdo()->exec( $database );
    }
}
