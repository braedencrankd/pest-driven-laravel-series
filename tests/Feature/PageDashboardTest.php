<?php

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
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
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()->create();

    // Act & Assert
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertDontSeeText($course->title);
});

it('shows latest purchased course first', function () {
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()->create();

    $firstPurchasedCourse = Course::factory()->create();
    $secondPurchasedCourse = Course::factory()->create();

    $user->courses()->attach(
        $firstPurchasedCourse->id,
        ['created_at' => Carbon::yesterday()]
    );

    $user->courses()->attach(
        $secondPurchasedCourse->id,
        ['created_at' => Carbon::now()]
    );

    // Act & Assert
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeInOrder([
            $secondPurchasedCourse->title,
            $firstPurchasedCourse->title,
        ]);
});

it('includes link to product video', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory())
        ->create();

    // Act & Assert
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText('Watch Videos')
        ->assertSee(route('pages.course-videos', Course::first()));
});
