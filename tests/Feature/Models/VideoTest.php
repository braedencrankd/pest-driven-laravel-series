<?php

use App\Models\Course;
use App\Models\Video;

it('belongs to a course', function () {
    $video = Video::factory()
        ->has(Course::factory())
        ->create();

    expect($video->course)->toBeInstanceOf(Course::class);
});


it('gives back readable video duration', function () {
    // Arrange
    $video = Video::factory()->create(['duration_in_mins' => 10]);

    // Act & Assert
    expect($video->getReadableDuration())->toEqual('10min');
});
