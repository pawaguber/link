<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    function __construct()
    {
        parent::setUp();
    }

    public function testPage($url)
    {
        $response = $this->get($url);

        $status = $this->assertEquals(200, $response->getStatusCode());
        return $status;
    }
}
