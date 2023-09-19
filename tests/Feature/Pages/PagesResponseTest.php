<?php

use App\Models\Course;

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
    // Act & Assert
    loginAsUser();

    get(route('pages.dashboard'))
        ->assertOk();
});

it('does not find Jetstream registration page', function () {
    // Act & Assert
    get('register')->assertNotFound();
});
