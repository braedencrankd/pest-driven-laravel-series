<?php

use Carbon\Carbon;
use App\Models\Course;
use function Pest\Laravel\get;


it('shows courses overview', function () {
    // Arrange
    Course::factory()->create(['title' => 'Course A', 'description' => 'Description Course A', 'released_at' => Carbon::now()]);
    Course::factory()->create(['title' => 'Course B', 'description' => 'Description Course B', 'released_at' => Carbon::now()]);
    Course::factory()->create(['title' => 'Course C', 'description' => 'Description Course C', 'released_at' => Carbon::now()]);

    // Act & Assert
    get(route('home'))
        ->assertOk()
        ->assertSeeText([
            'Course A',
            'Description Course A',
            'Course B',
            'Description Course B',
            'Course C',
            'Description Course C',
        ]);
});

it('shows only released courses', function () {
    // Arrange
    Course::factory()->create(['title' => 'Course A', 'released_at' => Carbon::yesterday()]);
    Course::factory()->create(['title' => 'Course B']);

    // Act & Assert
    get(route('home'))
        ->assertOk()
        ->assertSeeText('Course A')
        ->assertDontSeeText('Course B');
});

it('shows courses by release date', function () {
    Course::factory()->create(['title' => 'Course A', 'released_at' => Carbon::yesterday()]);
    Course::factory()->create(['title' => 'Course B', 'released_at' => Carbon::now()]);

    // Act & Assert
    get(route('home'))
        ->assertOk()
        ->assertSeeTextInOrder(['Course B', 'Course A']);
});
