<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->text('description')->nullable(true)->change();
            $table->text("image")->nullable(true);
            $table->integer('status');
            $table->dropColumn('assignee');
            $table->dropColumn('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('status');
            $table->string('assignee');
            $table->double('score', 8, 2);
            $table->text('description')->nullable(false)->change();
        });
    }
};
