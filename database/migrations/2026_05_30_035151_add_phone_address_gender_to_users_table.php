<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_pic')->nullable()->after('password');
            $table->string('phone')->nullable()->after('profile_pic');
            $table->string('address')->nullable()->after('phone');
            $table->string('gender')->nullable()->after('address');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['profile_pic', 'phone', 'address', 'gender']);
        });
    }
};