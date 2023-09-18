<?php

use App\Models\Video;

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
    $course = Course::factory()->create();
    Video::factory()->count(3)->create([
        'course_id' => $course->id,
    ]);

    // Act & Assert
    get(route('course-details', $course))
        ->assertOk()
        ->assertSeeText('3 videos');
});
