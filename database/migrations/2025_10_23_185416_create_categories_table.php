<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Khóa chính, kiểu UNSIGNED BIGINT
            $table->string('name'); // Tên danh mục
            $table->text('description')->nullable(); // Mô tả (có thể để trống)
            $table->timestamps(); // Tự động thêm created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
