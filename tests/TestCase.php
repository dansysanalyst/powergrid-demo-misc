<?php
declare(strict_types = 1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function test_without_vite_example()
    {
        $this->withoutVite();

        // ...
    }
}
