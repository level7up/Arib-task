<?php

use App\Models\Role;
use App\Models\User;

test('User can create department', function () {
    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->get('/department/create');

    $response->assertOk();
});
test('Staff can not create department', function () {
    $user = User::factory()->create();
    $user->role_id = Role::firstOrCreate([
        'name'=> 'Staff'
    ])->id;
    $user->save();
    $response = $this
        ->actingAs($user)
        ->get('/department/create');

    $response->assertStatus(401);
});
test('user can save department', function () {
    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->post('/department',[
            'title' => 'Title',
            'description' => 'Description',
        ]);

    $response->assertRedirect('/department');
});
