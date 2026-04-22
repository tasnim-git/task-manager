<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_can_create_task()
{
    $response = $this->post('/tasks', [
        'title' => 'Test Task'
    ]);

    $response->assertStatus(302);

    $this->assertDatabaseHas('tasks', [
        'title' => 'Test Task'
    ]);
}
public function test_can_delete_task()
{
    $task = \App\Models\Task::create([
        'title' => 'Delete Me'
    ]);

    $this->delete('/tasks/' . $task->id);

    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id
    ]);
}
public function test_can_update_task_status()
{
    $task = \App\Models\Task::create([
        'title' => 'Status Test'
    ]);

    $this->patch('/tasks/' . $task->id . '/status', [
        'status' => 'completed'
    ]);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'status' => 'completed'
    ]);
}
}
