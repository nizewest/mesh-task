<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use App\Category;

class CategoryTest extends TestCase
{
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
}
