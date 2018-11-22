<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Banners extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up ()
    {
        Schema::create( 'banners', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'url', 255 );
            $table->string( 'title', 40 );
            $table->string( 'image', 255 );
            $table->integer( 'listorder', false, true );
            $table->string( 'position', 30 );
            $table->timestamps();

        } );
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists( 'banners' );
    }
}
