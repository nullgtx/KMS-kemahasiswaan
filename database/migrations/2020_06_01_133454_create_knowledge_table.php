<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Knowledge;

class CreateKnowledgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->string('title');
            $table->string('slug');
            $table->string('level');
            $table->string('image');
            $table->integer('confirmed')->default(Knowledge::KNOWLEDGE_STATUS_NOT_CONFIRMED);
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('knowledge');
    }
}
