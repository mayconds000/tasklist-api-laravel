<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;

class TaskTest extends TestCase
{
    protected function createTask()
    {
        $task = Task::create(['title' => 'título da tarefa']);
    }

    public function getAllTasksTest()
    {
        $response = $this->json('GET', '/tasks');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function updateTaskTest()
    {   
        $task = $this->createTask();
        $url = '/tasks/' . $task->id;
        $data = ['title' => 'Reunião as 14:00', 'status' => 'closed'];
        $response = $this->json('PATCH', $url, $data);

        $response->assertStatus(200)
            ->assertJson($data);
    }

    public function deleteTaskTest()
    {
        $task = $this->createTask();
        $url = '/tasks/' . $task->id;
        $response = $this->json('DELETE', $url);

        $response->assertStatus(204);
        $this->assertFalse(Task::find($task->id));
    }
}
