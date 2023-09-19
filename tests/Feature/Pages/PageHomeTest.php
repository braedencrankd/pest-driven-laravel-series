<?php

use App\Models\Course;
use Carbon\Carbon;

use function Pest\Laravel\get;

it('shows courses overview', function () {
    // Arrange
    $firstCourse = Course::factory()->released()->create();
    $secondCourse = Course::factory()->released()->create();
    $thirdCourse = Course::factory()->released()->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertOk()
        ->assertSeeText([
            $firstCourse->title,
            $firstCourse->description,
            $secondCourse->title,
            $secondCourse->description,
            $thirdCourse->title,
            $thirdCourse->description,
        ]);
});

it('shows only released courses', function () {
    // Arrange
    $releasedCourse = Course::factory()->released()->create();
    $notReleasedCourse = Course::factory()->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertOk()
        ->assertSeeText($releasedCourse->title)
        ->assertDontSeeText($notReleasedCourse->title);
});

it('shows courses by release date', function () {
    $olderCourse = Course::factory()->released(Carbon::yesterday())->create();
    $newerCourse = Course::factory()->released(Carbon::now())->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertOk()
        ->assertSeeTextInOrder([$newerCourse->title, $olderCourse->title]);
});

it('includes login if not logged in', function () {
    get(route('pages.home'))
        ->assertOk()
        ->assertSeeText('Login')
        ->assertSee(route('login'));
});

it('includes logout if logged in', function () {

    loginAsUser();

    get(route('pages.home'))
        ->assertOk()
        ->assertSeeText('Log out')
        ->assertSee(route('logout'));
});
