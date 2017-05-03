<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenunameToOrdersMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
          Schema::table('orders_menus', function (Blueprint $table) {
             $table->string('menu_name');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('orders_menus', function (Blueprint $table) {
             $table->dropColumn('menu_name');
         });
     }
}
