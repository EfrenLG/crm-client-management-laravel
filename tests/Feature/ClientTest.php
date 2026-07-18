<?php

use App\Models\Client;
use App\Models\User;

test('guests cannot access the clients module', function () {
    $this->get('/clients')->assertRedirect('/login');
});

test('authenticated users can see the full client list', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    Client::factory()->for($owner)->create(['name' => 'Owned Client']);
    Client::factory()->for($other)->create(['name' => 'Other Client']);

    $response = $this->actingAs($owner)->get('/clients');

    $response->assertOk();
    $response->assertSee('Owned Client');
    $response->assertSee('Other Client');
});

test('a client can be created and is owned by the creator', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/clients', [
        'name' => 'Ana Pérez',
        'email' => 'ana@example.com',
        'phone' => '555-1234',
    ]);

    $response->assertRedirect(route('clients.index'));
    $this->assertDatabaseHas('clients', [
        'name' => 'Ana Pérez',
        'email' => 'ana@example.com',
        'user_id' => $user->id,
    ]);
});

test('creating a client requires valid data', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/clients', [
        'name' => 'Al',
        'email' => 'not-an-email',
    ]);

    $response->assertSessionHasErrors(['name', 'email']);
    $this->assertDatabaseCount('clients', 0);
});

test('a client can be viewed by any authenticated user', function () {
    $owner = User::factory()->create();
    $viewer = User::factory()->create();
    $client = Client::factory()->for($owner)->create();

    $this->actingAs($viewer)->get(route('clients.show', $client))->assertOk();
});

test('the owner can update their client', function () {
    $owner = User::factory()->create();
    $client = Client::factory()->for($owner)->create();

    $response = $this->actingAs($owner)->put(route('clients.update', $client), [
        'name' => 'Updated Name',
        'email' => $client->email,
        'phone' => $client->phone,
    ]);

    $response->assertRedirect(route('clients.index'));
    $this->assertSame('Updated Name', $client->fresh()->name);
});

test('a non-owner cannot update someone else\'s client', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $client = Client::factory()->for($owner)->create();

    $this->actingAs($intruder)->get(route('clients.edit', $client))->assertForbidden();

    $response = $this->actingAs($intruder)->put(route('clients.update', $client), [
        'name' => 'Hacked Name',
        'email' => $client->email,
        'phone' => $client->phone,
    ]);

    $response->assertForbidden();
    $this->assertSame($client->name, $client->fresh()->name);
});

test('the owner can delete their client', function () {
    $owner = User::factory()->create();
    $client = Client::factory()->for($owner)->create();

    $response = $this->actingAs($owner)->delete(route('clients.destroy', $client));

    $response->assertRedirect(route('clients.index'));
    $this->assertDatabaseMissing('clients', ['id' => $client->id]);
});

test('a non-owner cannot delete someone else\'s client', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $client = Client::factory()->for($owner)->create();

    $response = $this->actingAs($intruder)->delete(route('clients.destroy', $client));

    $response->assertForbidden();
    $this->assertDatabaseHas('clients', ['id' => $client->id]);
});

test('an admin can update and delete clients owned by other users', function () {
    $admin = User::factory()->admin()->create();
    $owner = User::factory()->create();
    $client = Client::factory()->for($owner)->create();

    $this->actingAs($admin)->put(route('clients.update', $client), [
        'name' => 'Admin Edited',
        'email' => $client->email,
        'phone' => $client->phone,
    ])->assertRedirect(route('clients.index'));

    $this->assertSame('Admin Edited', $client->fresh()->name);

    $this->actingAs($admin)->delete(route('clients.destroy', $client))
        ->assertRedirect(route('clients.index'));

    $this->assertDatabaseMissing('clients', ['id' => $client->id]);
});
