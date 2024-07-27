<?php

/** @var Tests\TestCase $this */
it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
