<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUsers extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up ()
    {
        Schema::create( 'admin_users', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'username' )->unique();
            $table->string( 'authpwd', 32 )->nullable();
            $table->string( 'password' );
            $table->tinyInteger( 'is_super', false, true );
            $table->timestamps();

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
