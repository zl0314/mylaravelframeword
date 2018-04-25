<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminProfile extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up ()
    {
        Schema::create( 'admins_profile', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->timestamps();
            $table->integer( 'admin_users_id', false, true );
            $table->string( 'realname' )->nullable();
            $table->foreign( 'admin_users_id' )->references( 'id' )->on( 'admin_users' )->onDelete( 'cascade' );
            $table->index( 'admin_users_id' );
        } );
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists( 'admins_profile' );
    }
}
