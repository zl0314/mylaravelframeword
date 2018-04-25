<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Setting extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up ()
    {
        Schema::create( 'settings', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'intro', 40 );
            $table->string( 'key', 40 );
            $table->string( 'value', 255 );
            $table->index( 'key' )->unique();
        } );
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists( 'settings' );
    }
}
