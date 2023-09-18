<?php

use function Pest\Laravel\get;

it('gives back successful response for homepage', function () {
    get(route('home'))
        ->assertOk();
});