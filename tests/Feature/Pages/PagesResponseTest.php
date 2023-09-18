<?php

use App\Models\Course;
use App\Models\User;

use function Pest\Laravel\get;

it('gives back successful response for homepage', function () {
    get(route('pages.home'))
        ->assertOk();
});

it('gives back succesful response for course details page', function () {
    // Arrange
    $course = Course::factory()->released()->create();

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertOk();
});

it('gives back succesful response for dashboard page', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    $this->actingAs($user);

    get(route('dashboard'))
        ->assertOk();
});
