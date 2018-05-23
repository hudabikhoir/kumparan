<?php

class NewsTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testNews()
    {
        $response = $this->call('GET', '/news');

        $this->assertEquals(200, $response->status());
    }

    public function testCreateNews()
    {
        $response = $this->call('POST', '/news', ['title' => 'title', 'content' => 'content', 'status' => 'draft', 'topic' => '1,2']);

        $this->assertEquals(200, $response->status());
    }

    public function testUpdateNews()
    {
        $response = $this->call('PUT', '/news/update/1', ['title' => 'title', 'content' => 'content', 'status' => 'publish']);

        $this->assertEquals(200, $response->status());
    }

    public function testDeleteNews()
    {
        $response = $this->call('DELETE', '/news/delete/1');

        $this->assertEquals(200, $response->status());
    }

    public function testNewsbyStatus()
    {
        $response = $this->call('GET', '/news/status/draft');

        $this->assertEquals(200, $response->status());
    }

    public function testNewsbyTopic()
    {
        $response = $this->call('GET', '/news/status/politik');

        $this->assertEquals(200, $response->status());
    }
}