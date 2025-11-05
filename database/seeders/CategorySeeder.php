<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Truncate bảng trước khi seed để tránh trùng lặp
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('categories')->insert([
            // --- Laptop & PC ---
            [
                'name' => 'Laptop Gaming',
                'description' => 'Laptop hiệu năng cao chuyên dụng cho game thủ.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Laptop Văn phòng',
                'description' => 'Laptop mỏng nhẹ, pin lâu dành cho dân văn phòng, học sinh, sinh viên.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'PC Gaming',
                'description' => 'Máy tính để bàn cấu hình mạnh mẽ dành cho game thủ.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Workstation',
                'description' => 'Máy trạm phục vụ đồ họa, render, AI, kỹ thuật chuyên sâu.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
           
        ]);
    }
}
