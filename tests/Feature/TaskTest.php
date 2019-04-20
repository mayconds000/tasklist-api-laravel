<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    const BASE_URL = '/api/tasks';

    protected function createTask()
    {
        return Task::create(['title' => 'título da tarefa']);
    }

    public function testGetAllTasks()
    {
        $response = $this->json('GET', self::BASE_URL);
        // var_dump($response);
        // die();

        $response->assertStatus(200)
            ->assertJsonStructure([]);
    }

    public function testUpdateTask()
    {   
        $task = $this->createTask();
        $url = self::BASE_URL . '/' . $task->id;
        $data = ['title' => 'Reunião as 14:00', 'status' => 'closed'];
        $response = $this->json('PATCH', $url, $data);

        $response->assertStatus(200)
            ->assertJson($data);
    }

    public function testeDeleteTask()
    {
        $task = $this->createTask();
        $url = self::BASE_URL . '/' . $task->id;
        $response = $this->json('DELETE', $url);

        $response->assertStatus(204);
        $this->assertNull(Task::find($task->id));
    }
}
