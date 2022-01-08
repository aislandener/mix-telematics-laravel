<?php

namespace Aislandener\MixTelematicsLaravel\Tests;

use Aislandener\MixTelematicsLaravel\MixTelematicsServiceProvider;

class TextCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
  {
    parent::setUp();
    // additional setup
  }

  protected function getPackageProviders($app)
  {
    return [
      MixTelematicsServiceProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    // perform environment setup
  }
}