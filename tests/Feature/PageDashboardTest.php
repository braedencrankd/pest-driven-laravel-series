<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;

use function Pest\Laravel\get;

it('cannot be accessed by guest', function () {
    // Arrange
    get(route('dashboard'))
        ->assertRedirect(route('login'));
});

it('lists purchased courses', function () {
    //expect()->
    $user = User::factory()
        ->has(Course::factory()->count(2)->state(
            new Sequence(
                ['title' => 'Course A'],
                ['title' => 'Course B'],
            )
        ))
        ->create();

    // Act & Assert
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText([
            'Course A',
            'Course B',
        ]);
});

it('does not list other courses', function () {
    //expect()->
});

it('shows latest purchased course first', function () {
    //expect()->
});

it('includes link to product video', function () {
    //expect()->
});
