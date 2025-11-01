<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn('No categories found. Please run CategorySeeder first.');
            return;
        }

        $products = [
            [
                'name' => 'Laptop Dell XPS 15',
                'description' => 'Powerful laptop with Intel i7 processor, 16GB RAM, and 512GB SSD.',
                'price' => 15000000,
                'stock' => 10,
                'category' => 'Electronics',
            ],
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Latest iPhone with A17 Pro chip, 256GB storage.',
                'price' => 18000000,
                'stock' => 15,
                'category' => 'Electronics',
            ],
            [
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse with long battery life.',
                'price' => 350000,
                'stock' => 50,
                'category' => 'Electronics',
            ],
            [
                'name' => 'Cotton T-Shirt',
                'description' => 'Comfortable cotton t-shirt available in multiple colors.',
                'price' => 150000,
                'stock' => 100,
                'category' => 'Clothing',
            ],
            [
                'name' => 'Jeans Regular Fit',
                'description' => 'Classic jeans with regular fit, high quality denim.',
                'price' => 450000,
                'stock' => 75,
                'category' => 'Clothing',
            ],
            [
                'name' => 'Nike Running Shoes',
                'description' => 'Comfortable running shoes for daily exercise.',
                'price' => 1200000,
                'stock' => 30,
                'category' => 'Sports',
            ],
            [
                'name' => 'The Laravel Book',
                'description' => 'Complete guide to Laravel framework development.',
                'price' => 350000,
                'stock' => 25,
                'category' => 'Books',
            ],
            [
                'name' => 'PHP Programming Guide',
                'description' => 'Learn PHP from basics to advanced topics.',
                'price' => 280000,
                'stock' => 40,
                'category' => 'Books',
            ],
            [
                'name' => 'Garden Tools Set',
                'description' => 'Complete set of gardening tools for your garden.',
                'price' => 850000,
                'stock' => 20,
                'category' => 'Home & Garden',
            ],
            [
                'name' => 'LEGO Building Set',
                'description' => 'Creative building blocks for kids and adults.',
                'price' => 650000,
                'stock' => 35,
                'category' => 'Toys',
            ],
        ];

        foreach ($products as $productData) {
            $category = $categories->firstWhere('name', $productData['category']);
            
            if ($category) {
                Product::create([
                    'name' => $productData['name'],
                    'slug' => Str::slug($productData['name']),
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}

