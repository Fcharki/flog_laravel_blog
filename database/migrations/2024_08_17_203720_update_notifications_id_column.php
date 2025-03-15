<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class UpdateNotificationsIdColumn extends Migration
{
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->uuid('id')->change(); // Change to UUID type
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->bigIncrements('id')->change(); // Change back to BigIncrements if needed
        });
    }
}
