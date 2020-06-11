<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('vat')->unique();
            $table->string('name');
            $table->string('last_name');
            $table->string('telephone');
            $table->string('email');
            $table->string('picture');
            $table->string('born_at');
            $table->text('notes');
            $table->float('credit', 8, 2)->default(0);
            $table->smallInteger('active')->default(1);
            $table->bigInteger('user_id')->default(0);
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
        Schema::dropIfExists('members');
    }
}
