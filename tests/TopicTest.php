<?php

class TopicTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testTopic()
    {
        $response = $this->call('GET', '/topic');

        $this->assertEquals(200, $response->status());
    }

    public function testCreateTopic()
    {
        $response = $this->call('POST', '/topic', ['name' => 'politik']);

        $this->assertEquals(200, $response->status());
    }

    public function testUpdateTopic()
    {
        $response = $this->call('PUT', '/topic/update/2', ['name' => 'teknologi']);

        $this->assertEquals(200, $response->status());
    }

    public function testDeleteTopic()
    {
        $response = $this->call('DELETE', '/topic/delete/3');

        $this->assertEquals(200, $response->status());
    }
}