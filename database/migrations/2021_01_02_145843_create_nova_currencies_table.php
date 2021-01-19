<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNovaCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nova_currencies', function (Blueprint $table) {
            $table->id();
            $table->labeling();
            $table->string('code');
            $table->string('symbol');
            $table->string('point')->default('.');
            $table->string('separator')->default(',');
            $table->boolean('enabled')->default(true);
            $table->tinyInteger('decimal')->default(2);
            $table->decimal('exchange_rate', 4, 3)->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nova_currencies');
    }
}
