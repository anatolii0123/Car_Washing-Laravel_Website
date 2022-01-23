<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->time('Mon_start');
            $table->time('Mon_end');
            $table->time('Tue_start');
            $table->time('Tue_end');
            $table->time('Wed_start');
            $table->time('Wed_end');
            $table->time('Thu_start');
            $table->time('Thu_end');
            $table->time('Fri_start');
            $table->time('Fri_end');
            $table->time('Sat_start');
            $table->time('Sat_end');
            $table->time('Sun_start');
            $table->time('Sun_end');
            $table->integer('interval');                                                    
            $table->string('address');
            $table->string('street');
            $table->string('city');
            $table->char('is_delete'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
