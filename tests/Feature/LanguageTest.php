<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function language_is_exists()
    {
        $this->get(route('language.change', 'en'))
            ->assertSessionHas('lang', 'en');
    }
}
