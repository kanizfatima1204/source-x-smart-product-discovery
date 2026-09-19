<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name'=>'Sundarban Raw Honey','slug'=>'sundarban-raw-honey','category'=>'Honey','type'=>'Raw Honey','location'=>'Khulna','description'=>'Pure, unprocessed honey collected from the Sundarbans region. Rich aroma and naturally sweet finish.','price'=>780,'unit'=>'kg','stock'=>120,'rating'=>4.9,'review_count'=>84,'is_featured'=>true,'image'=>'https://images.unsplash.com/photo-1587049352846-4a222e784d38?auto=format&fit=crop&w=900&q=80','tags'=>['মধু','raw','sundarban','natural'],'source_name'=>'Sundarban Harvest'],
            ['name'=>'Litchi Blossom Honey','slug'=>'litchi-blossom-honey','category'=>'Honey','type'=>'Floral Honey','location'=>'Rajshahi','description'=>'Light floral honey with a delicate litchi blossom fragrance, sourced from local apiaries.','price'=>920,'unit'=>'kg','stock'=>65,'rating'=>4.8,'review_count'=>61,'is_featured'=>true,'image'=>'https://images.unsplash.com/photo-1471943311424-646960669fbc?auto=format&fit=crop&w=900&q=80','tags'=>['মধু','litchi','floral','natural'],'source_name'=>'Rajshahi Apiary'],
            ['name'=>'Mustard Flower Honey','slug'=>'mustard-flower-honey','category'=>'Honey','type'=>'Floral Honey','location'=>'Manikganj','description'=>'Golden mustard flower honey with a clean, mildly spicy floral note.','price'=>650,'unit'=>'kg','stock'=>240,'rating'=>4.7,'review_count'=>109,'is_featured'=>false,'image'=>'https://images.unsplash.com/photo-1558642452-9d2a7deb7f62?auto=format&fit=crop&w=900&q=80','tags'=>['মধু','mustard','manikganj','floral'],'source_name'=>'Green Field Producers'],
            ['name'=>'Organic Black Seed Honey','slug'=>'organic-black-seed-honey','category'=>'Honey','type'=>'Infused Honey','location'=>'Dhaka','description'=>'Natural honey paired with black seed for a distinctive taste and everyday pantry use.','price'=>1100,'unit'=>'kg','stock'=>18,'rating'=>4.6,'review_count'=>42,'is_featured'=>true,'image'=>'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=900&q=80','tags'=>['মধু','black seed','organic','dhaka'],'source_name'=>'Pure Pantry'],
            ['name'=>'Organic Turmeric Powder','slug'=>'organic-turmeric-powder','category'=>'Spices','type'=>'Powder','location'=>'Rajshahi','description'=>'Bright, aromatic turmeric powder from carefully dried local turmeric roots.','price'=>340,'unit'=>'kg','stock'=>90,'rating'=>4.8,'review_count'=>73,'is_featured'=>true,'image'=>'https://images.unsplash.com/photo-1615485925600-97237c4fc1ec?auto=format&fit=crop&w=900&q=80','tags'=>['turmeric','organic','spice'],'source_name'=>'Rajshahi Organics'],
            ['name'=>'Premium Mustard Oil','slug'=>'premium-mustard-oil','category'=>'Oil','type'=>'Cold Pressed','location'=>'Manikganj','description'=>'Small-batch cold-pressed mustard oil with a bold aroma and rich golden color.','price'=>480,'unit'=>'litre','stock'=>44,'rating'=>4.7,'review_count'=>58,'is_featured'=>false,'image'=>'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=900&q=80','tags'=>['mustard oil','cold pressed','manikganj'],'source_name'=>'Deshi Press'],
            ['name'=>'Mango Pulp','slug'=>'mango-pulp','category'=>'Fruits','type'=>'Processed Fruit','location'=>'Chapainawabganj','description'=>'Thick, naturally sweet mango pulp prepared from ripe seasonal mangoes.','price'=>560,'unit'=>'kg','stock'=>0,'rating'=>4.5,'review_count'=>37,'is_featured'=>false,'image'=>'https://images.unsplash.com/photo-1553279768-865429fa0078?auto=format&fit=crop&w=900&q=80','tags'=>['mango','fruit','pulp'],'source_name'=>'Mango Valley'],
            ['name'=>'Aromatic Miniket Rice','slug'=>'aromatic-miniket-rice','category'=>'Grains','type'=>'Rice','location'=>'Dinajpur','description'=>'Clean, aromatic rice suitable for everyday meals and bulk procurement.','price'=>890,'unit'=>'25 kg','stock'=>300,'rating'=>4.6,'review_count'=>92,'is_featured'=>true,'image'=>'https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=900&q=80','tags'=>['rice','grain','bulk'],'source_name'=>'Northern Grains'],
            ['name'=>'Raw Cashew Nuts','slug'=>'raw-cashew-nuts','category'=>'Nuts','type'=>'Raw Nuts','location'=>'Chattogram','description'=>'Selected raw cashew kernels for food businesses, retailers and home use.','price'=>1480,'unit'=>'kg','stock'=>32,'rating'=>4.8,'review_count'=>49,'is_featured'=>false,'image'=>'https://images.unsplash.com/photo-1508061253366-f7da158b6d0f?auto=format&fit=crop&w=900&q=80','tags'=>['cashew','nuts','raw'],'source_name'=>'Coastal Foods'],
        ];

        foreach ($products as $product) Product::updateOrCreate(['slug'=>$product['slug']], $product);
    }
}
