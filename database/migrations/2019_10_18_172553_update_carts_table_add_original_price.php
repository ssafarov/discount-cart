<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCartsTableAddOriginalPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart', function($table) {
            $table->string('originalTotal')->nullable()->after('coupon_id');
            $table->string('reducedTotal')->nullable()->after('originalTotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function($table) {
            $table->dropColumn('originalTotal');
            $table->dropColumn('reducedTotal');
        });
    }
}
