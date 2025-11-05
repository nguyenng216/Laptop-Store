<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('cpu')->nullable();
        $table->string('gpu')->nullable();
        $table->string('ram')->nullable();
        $table->string('storage')->nullable();
        $table->string('display')->nullable();
        $table->string('weight')->nullable();
        $table->string('warranty')->nullable()->default('12 tháng');
        $table->string('origin')->nullable();
        $table->string('color')->nullable();
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn([
            'cpu', 'gpu', 'ram', 'storage', 'display',
            'weight', 'warranty', 'origin', 'color'
        ]);
    });
}

};
