<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnstablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unstables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('line');
            $table->dateTime('start_date');

            $table->text('shift');
            $table->text('duty');
            $table->text('area');
            $table->text('catego');
            $table->text('steel_grade');

            $table->double('aim_thick', 8, 2);
            $table->double('aim_width', 8, 2);
            $table->string('coil_id')->unique();

            $table->text('events');
            $table->text('describe');

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
        Schema::dropIfExists('unstables');
    }
}
