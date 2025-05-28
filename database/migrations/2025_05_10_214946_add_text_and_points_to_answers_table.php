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
    Schema::table('answers', function (Blueprint $table) {
        if (Schema::hasColumn('answers', 'content')) {
            $table->dropColumn('content');
        }

        if (!Schema::hasColumn('answers', 'text')) {
            $table->text('text');
        }

        if (!Schema::hasColumn('answers', 'points')) {
            $table->integer('points');
        }
    });
}



    /**
     * Reverse the migrations.
     *
     * @return void
     */
public function down()
{
    Schema::table('answers', function (Blueprint $table) {
        $table->dropColumn(['text', 'points']);  // حذف الأعمدة في حالة التراجع عن الهجرة
    });
}
};
