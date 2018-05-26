<?php

namespace Tests\Feature\API;

use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/api/categories');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            [
                'id',
                'name'
            ]
        ]);
    }
}
