<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('history_id');
            $table->unsignedinteger('item_id');
            $table->unsignedinteger('amount');
            $table->timestamps();
            // あとからint('purchased_price')を追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_details');
    }
}
