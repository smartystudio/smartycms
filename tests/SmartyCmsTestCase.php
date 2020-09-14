<?php

namespace SmartyStudio\SmartyCms\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase;
use SmartyStudio\SmartyCms\Database\Seeds\DatabaseSeeder as DatabaseSeeder;

abstract class SmartyCmsTestCase extends TestCase
{
	protected function getEnvironmentSetUp($app)
	{
		// Setup default database
	}

	protected function getPackageProviders($app)
	{
		return ['SmartyStudio\SmartyCms\AdminServiceProvider'];
	}

	protected function getPackageAliases($app)
	{
		return [
			'Cms'    => \SmartyStudio\SmartyCms\Facades\Cms::class,
			'config' => Illuminate\Config\Repository::class,
		];
	}

	public function setUp()
	{
		parent::setUp();

		Schema::defaultStringLength(191);

		Artisan::call('migrate', [
			'--path' => '../../../../src/database/migrations',
		]);

		$seeder = new DatabaseSeeder();
		$seeder->run();

		$this->withFactories(__DIR__ . '/../src/database/factories');
	}

	public function tearDown()
	{
		Artisan::call('migrate:reset', [
			'--path' => '../../../../src/database/migrations',
		]);

		parent::tearDown();
	}
}
