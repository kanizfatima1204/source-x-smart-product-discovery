<?php
namespace Database\Factories;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductFactory extends Factory { protected $model=Product::class; public function definition():array{return ['name'=>$this->faker->words(3,true),'slug'=>$this->faker->unique()->slug(),'category'=>'Honey','type'=>'Raw Honey','location'=>'Dhaka','description'=>$this->faker->sentence(12),'price'=>$this->faker->numberBetween(300,1500),'unit'=>'kg','stock'=>$this->faker->numberBetween(0,100),'rating'=>$this->faker->randomFloat(1,3.5,5),'review_count'=>$this->faker->numberBetween(1,100),'is_featured'=>$this->faker->boolean(),'image'=>'https://images.unsplash.com/photo-1587049352846-4a222e784d38?auto=format&fit=crop&w=900&q=80','tags'=>['honey'],'source_name'=>$this->faker->company()];}}
