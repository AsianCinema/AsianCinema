<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position')->default(0);
            $table->string('name', 255)->default('');
            $table->string('address', 255)->default('');
            $table->tinyInteger('status')->unsigned()->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_gateways');
    }
}
