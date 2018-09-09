<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('file_name');

            $table->timestamps();
        });

        Schema::create('import_rows', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('import_id');
            $table->foreign('import_id')->references('id')->on('imports')->onUpdate('cascade')->onDelete('cascade');

            $table->string('splitwise_id')->nullable();

            $table->date('completed_date');
            $table->string('reference');
            $table->decimal('paid_out', 10, 2);
            $table->string('category');

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_rows');
        Schema::dropIfExists('imports');
    }
}
