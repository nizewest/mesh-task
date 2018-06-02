<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use App\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $response = $this->get('/api/categories');

        $content = json_decode($response->assertStatus(200)->getContent());

        if (!empty($content)) {
            $response->assertJsonStructure([
                [
                    'id',
                    'name'
                ]
            ]);
        }
    }

    public function testProducts()
    {
        $category = Category::first();
        $response = $this->get('/api/categories/'.$category->id.'/products');

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
        $category = Category::first();
        $response = $this->get('/api/categories/'.$category->id);
        $response->assertStatus(200);
        $response->assertJson($category->toArray());
    }

    public function testUpdate()
    {
        $category = Category::first();

        $response = $this->put('/api/categories/'.$category->id, [
            'name' => 'test'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'test'
        ]);
    }

    public function testStore()
    {
        $response = $this->post('/api/categories', [
            'name' => 'test'
        ]);

        $response->assertStatus(201);

        $content = json_decode($response->getContent());

        $this->assertDatabaseHas('categories', [
            'id' => $content->id,
            'name' => 'test'
        ]);
    }

    public function testDestroy()
    {
        $category = Category::first();

        foreach ($category->products()->pluck('id') as $id) {
            $productsIds[] = ['id' => $id];
        }

        foreach ($category->descendants()->pluck('id') as $id) {
            $descendantsIds[] = ['id' => $id];
            foreach (Category::find($id)->products()->pluck('id') as $productId) {
                $productsIds[] = ['id' => $productId];
            }
        }

        $response = $this->delete('/api/categories/'.$category->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);

        foreach ($descendantsIds as $descendantsId) {
            $this->assertDatabaseMissing('categories', $descendantsId);
        }

        foreach ($productsIds as $productsId) {
            $this->assertDatabaseMissing('products', $productsId);
        }

        $response->assertJsonStructure(['message']);
    }
}
