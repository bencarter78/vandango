<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blink_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organisation_id')->references('id')->on('blink_organisations');
            $table->integer('uploaded_by')->references('id')->on('users');
            $table->string('name');
            $table->string('type');
            $table->text('description');
            $table->text('path');
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
        Schema::dropIfExists('blink_documents');
    }
}
