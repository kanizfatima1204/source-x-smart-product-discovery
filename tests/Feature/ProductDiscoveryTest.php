<?php
namespace Tests\Feature;
use App\Models\Product; use Illuminate\Foundation\Testing\RefreshDatabase; use Tests\TestCase;
class ProductDiscoveryTest extends TestCase { use RefreshDatabase; public function test_discovery_page_loads():void{Product::factory()->create(['name'=>'Sundarban Honey']);$this->get('/')->assertOk()->assertInertia(fn($page)=>$page->component('Discovery/Index')->has('products'));} public function test_search_filters_products():void{Product::factory()->create(['name'=>'Sundarban Honey','category'=>'Honey']);Product::factory()->create(['name'=>'Miniket Rice','category'=>'Grains']);$this->get('/?q=Honey')->assertInertia(fn($page)=>$page->where('filters.query','Honey')->has('products.data',1));}}
