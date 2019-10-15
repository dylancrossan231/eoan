<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Todo; 

class AddUserIdColumnAndForeignConstraintToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //add the import
     public function up()
     {
         Todo::truncate(); // empty the table
         Schema::table('todos', function (Blueprint $table) {
             $table->unsignedBigInteger('user_id'); // unsigned for foreign key.
             $table->foreign('user_id') // foreign key column name.
                 ->references('id') // parent table primary key.
                 ->on('users') // parent table name.
                 ->onDelete('cascade'); // this will delete all the children rows when the parent row is deleted.
         });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {

            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);
        });
    }
}
