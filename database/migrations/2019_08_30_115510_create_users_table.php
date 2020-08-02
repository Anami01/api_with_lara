<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable($value = true);
            $table->text('address')->nullable($value = true);
            $table->bigInteger('number')->nullable($value = true);
            $table->string('email')->nullable($value = true);
            $table->string('city')->nullable($value = true);
            $table->string('state')->nullable($value = true);
            $table->string('country')->nullable($value = true);
            $table->text('photo')->nullable($value = true);
            $table->string('gender')->nullable($value = true);
            $table->text('password')->nullable($value = true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
