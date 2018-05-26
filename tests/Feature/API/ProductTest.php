<?php

namespace Tests\Feature\API;

use Tests\TestCase;

class ProductTest extends TestCase
{
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
}
