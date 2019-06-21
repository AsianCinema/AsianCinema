<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position')->default(0);
            $table->string('description', 255)->default('');
            $table->bigInteger('upload_value')->default(0);
            $table->integer('invite_value')->default(0);
            $table->integer('vip_value')->default(0);
            $table->integer('freeleech_value')->default(0);
            $table->integer('bonus_value')->default(0);
			$table->unsignedDecimal('cost', 7, 2)->default(0.0);
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
        Schema::dropIfExists('donation_packages');
    }
}
