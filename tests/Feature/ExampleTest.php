<?php



it('gives back successful response for homepage', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});