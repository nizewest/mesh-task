<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $response = $this->get('/api/products');

        $content = json_decode($response->assertStatus(200)->getContent());

        if (!empty($content)) {
            $response->assertJsonStructure([
                [
                    'id',
                    'name',
                    'description',
                    'image',
                    'category_id'
                ]
            ]);
        }
    }

    public function testShow()
    {
        $product = Product::first();
        $response = $this->get('/api/products/'.$product->id);
        $response->assertStatus(200);
        $response->assertJson($product->toArray());
    }

    public function testUpdate()
    {
        $product = Product::first();

        $response = $this->put('/api/products/'.$product->id, [
            'name' => 'test 1',
            'description' => 'test 2',
            'image' => 'test 3',
            'category_id' => 1,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'test 1',
            'description' => 'test 2',
            'image' => 'test 3',
            'category_id' => 1,
        ]);
    }

    public function testStore()
    {
        $response = $this->post('/api/products', [
            'name' => 'test 1',
            'description' => 'test 2',
            'image' => 'test 3',
            'category_id' => 1,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['data', 'message']);

        $content = json_decode($response->getContent());

        $this->assertDatabaseHas('products', [
            'id' => $content->data->id,
            'name' => 'test 1',
            'description' => 'test 2',
            'image' => 'test 3',
            'category_id' => 1,
        ]);
    }

    public function testDestroy()
    {
        $product = Product::first();
        $response = $this->delete('/api/products/'.$product->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
        $response->assertJsonStructure(['message']);
    }
}
