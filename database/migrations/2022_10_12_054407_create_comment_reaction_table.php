<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentReactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_reaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_id')->unsigned();
            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')->onDelete('cascade');
            $table->unsignedBigInteger('reaction_id')->unsigned();
            $table->foreign('reaction_id')
                ->references('id')
                ->on('reactions')->onDelete('cascade');
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
        Schema::dropIfExists('comment_reaction');
    }
}
