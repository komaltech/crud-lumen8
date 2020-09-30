<?php

use App\Models\Product;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ProductTest extends TestCase 
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->post('/product/store',[
            'product_title' => 'test product'
        ]);

        $this->assertCount(1,Product::all());
    }
}