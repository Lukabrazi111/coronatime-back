<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_if_language_is_exists()
    {
        $this->get(route('language.change', 'en'))
            ->assertSessionHas('lang', 'en');
    }
}
