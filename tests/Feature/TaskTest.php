<?php

use App\Models\User;


test('User can create task', function () {
    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->get('/task/create');

    $response->assertOk();
});

test('user can save task', function () {
    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->post('/task',[
            'title' => 'Title',
            'description' => 'Description',
            'employee_id'=> $user->id
        ]);

    $response->assertRedirect('/task');
});
