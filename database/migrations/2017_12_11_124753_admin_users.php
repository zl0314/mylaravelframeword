<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class admin_users extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up ()
    {
        Schema::create( 'admin_users', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->timestamps();
            $table->string( 'username' )->unique();
            $table->tinyInteger( 'is_super', false, true );
            $table->string( 'authpwd', 32 )->nullable();
            $table->string( 'password' );
        } );
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists( 'admin_users' );
    }
}
