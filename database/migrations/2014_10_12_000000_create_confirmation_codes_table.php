<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmationCodesTable extends Migration
{
    public function up()
    {
        Schema::create('confirmation_codes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('email');
            $table->string('code', 6);

            $table->datetime('expires_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('confirmation_codes');
    }
}
