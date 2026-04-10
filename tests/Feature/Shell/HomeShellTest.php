<?php

it('renders the application shell preview', function () {
    $response = $this->get(route('home'));

    $response->assertSuccessful();
    $response->assertSee('Application toolbar');
    $response->assertSee('Context navigation');
    $response->assertSee('Main content');
    $response->assertSee('Ideas');
    $response->assertSee('Drafts');
    $response->assertSee('Private idea workspace');
});
