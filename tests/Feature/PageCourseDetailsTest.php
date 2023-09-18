<?php

use App\Models\Course;

use function Pest\Laravel\get;

it('shows course details', function () {
    // Arrange
    $course = Course::factory()->create([
        'tagline' => 'Course tagline',
        'image' => 'image.jpg',
        'learnings' => [
            'Learning Laravel routes',
            'Learning Laravel view',
            'Learning Laravel commands',
        ]
    ]);

    // Act & Assert
    get(route('course-details', $course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            $course->tagline,
            'Learning Laravel routes',
            'Learning Laravel view',
            'Learning Laravel commands',
        ])
        ->assertSee('image.jpg');
});
it('shows course video count', function () {
    // Arrange

    // Act & Assert
});
