<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('location_id');
            $table->string("email");
            $table->string("phone");
            $table->string("started_at");
            $table->string("driver");
            $table->string("number");
            $table->string("summary");
            $table->string("mark_id");
            $table->string("model_id");
            $table->char('is_delete');
            $table->string("service_id");
            $table->integer("pesubox_id");
            $table->integer("vehicle_id");
            $table->date('date');
            $table->time('time');
            $table->integer("duration");
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
        Schema::dropIfExists('bookings');
    }
}
