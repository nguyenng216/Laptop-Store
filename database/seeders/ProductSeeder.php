<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Tắt kiểm tra foreign key để truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = DB::table('categories')->pluck('id')->toArray(); // Lấy tất cả category_id

        $brands = ['ASUS', 'Acer', 'Dell', 'HP', 'Lenovo', 'MSI', 'Apple'];
        $series = ['Gaming', 'Office', 'Workstation', 'Ultrabook', 'Business'];
        $cpus = ['Intel i5', 'Intel i7', 'Intel i9', 'Ryzen 5', 'Ryzen 7', 'Ryzen 9', 'Apple M2', 'Apple M3'];
        $gpus = ['RTX 3050', 'RTX 3060', 'RTX 4060', 'RTX 4070', 'GTX 1650', 'Intel Iris Xe', 'Radeon RX 7600M', 'Integrated'];
        $rams = ['8GB', '16GB', '32GB', '64GB'];
        $storages = ['512GB SSD', '1TB SSD', '256GB SSD', '2TB SSD'];
        $displays = ['15.6" FHD 144Hz', '14" FHD IPS', '16" QHD 165Hz', '13.3" Retina'];
        $weights = ['1.2kg', '1.5kg', '2.0kg', '2.3kg'];
        $origins = ['Việt Nam', 'Trung Quốc', 'Đài Loan', 'Mỹ', 'Nhật Bản'];
        $colors = ['Đen', 'Bạc', 'Xám', 'Trắng', 'Xanh dương', 'Đỏ'];

        $products = [];

        foreach ($categories as $catId) {
            // Tạo ít nhất 10 sản phẩm cho mỗi category
            for ($i = 1; $i <= 10; $i++) {
                $brand = $brands[array_rand($brands)];
                $seriesName = $series[array_rand($series)];
                $cpu = $cpus[array_rand($cpus)];
                $gpu = $gpus[array_rand($gpus)];
                $ram = $rams[array_rand($rams)];
                $storage = $storages[array_rand($storages)];
                $display = $displays[array_rand($displays)];
                $weight = $weights[array_rand($weights)];
                $origin = $origins[array_rand($origins)];
                $color = $colors[array_rand($colors)];

                $name = "$brand $seriesName $cpu / $ram / $storage";
                $slug = Str::slug($name) . "-{$catId}-{$i}";
                $price = rand(15000000, 45000000);
                $discount_price = rand(0, 1) ? $price - rand(1000000, 5000000) : null;
                $stock = rand(5, 30);

                // Random ảnh chính từ 1.png -> 10.png
                $mainImageNumber = rand(1, 10);
                $image = "{$mainImageNumber}.png";

                // Tạo gallery gồm 10 ảnh từ 1.png -> 10.png
                $gallery = [];
                for ($g = 1; $g <= 10; $g++) {
                    $gallery[] = "products/{$g}.png";
                }

                $products[] = [
                    'name' => $name,
                    'slug' => $slug,
                    'description' => "Sản phẩm $seriesName, CPU $cpu, GPU $gpu, RAM $ram, ổ $storage, màn hình $display.",
                    'price' => $price,
                    'discount_price' => $discount_price,
                    'stock' => $stock,
                    'category_id' => $catId,
                    'image' => $image,
                    'gallery' => json_encode($gallery),
                    'cpu' => $cpu,
                    'gpu' => $gpu,
                    'ram' => $ram,
                    'storage' => $storage,
                    'display' => $display,
                    'weight' => $weight,
                    'warranty' => '12 tháng',
                    'origin' => $origin,
                    'color' => $color,
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('products')->insert($products);
    }
}
