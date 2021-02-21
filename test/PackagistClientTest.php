<?php

/**
 * Contains PackagistClientTest
 *
 * @author Tom Egan <tom@tomeagn.tech>
 * @license MIT
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client as HttpClient;

use TomEganTech\PackagistClient\PackageDescription;
use TomEganTech\PackagistClient\PackagistClient;
use TomEganTech\PackagistClient\SecurityAdvisory;

/** Tests PackagistClient */
final class PackagistClientTest extends TestCase {
	/** An instance of the client to use in testing */
	private static $client;

	/** Setup a client to use in testing */
	public static function setUpBeforeClass(): void {
		self::$client = new PackagistClient(new HttpClient());
	}

	/** Test that we can list packages filtered by type */
	public function testListPackagesByType() {
		$packages = self::$client->listPackages(null, 'composer-plugin');
		self::assertIsArray($packages);
		self::assertNotEmpty($packages);
		self::assertContainsOnly('string', $packages);
	}

	/** Test that we can list packages filtered by organization */
	public function testListPackagesByOrganization() {
		$packages = self::$client->listPackages('composer');
		self::assertIsArray($packages);
		self::assertNotEmpty($packages);
		self::assertContainsOnly('string', $packages);
	}

	/** Test that we can list all packages */
	public function testListingAllPackages() {
		$packages = self::$client->listPackages('composer');
		self::assertIsArray($packages);
		self::assertNotEmpty($packages);
		self::assertContainsOnly('string', $packages);
	}

	/** Test that we can list security advisories for a package */
	public function testListingSecurityAdvisoriesForPackage() {
		$advisories = self::$client->listSecurityAdvisories(null, ['monolog/monolog']);
		self::assertIsArray($advisories);
		self::assertNotEmpty($advisories);
		self::assertContainsOnlyInstancesOf(SecurityAdvisory::class, $advisories);
	}

	/** Test that we can search for packages by search term */
	public function testSearchForPackage() {
		$packages = self::$client->searchPackages('monolog');
		self::assertIsArray($packages);
		self::assertNotEmpty($packages);
		self::assertContainsOnlyInstancesOf(PackageDescription::class, $packages);
	}

	/** Test that we can search for packages by search tag */
	public function testSearchForPackageByTag() {
		$packages = self::$client->searchPackages(null, 'psr-3');
		self::assertIsArray($packages);
		self::assertNotEmpty($packages);
		self::assertContainsOnlyInstancesOf(PackageDescription::class, $packages);
	}

	/** Test that we can search for packages by search type */
	public function testSearchForPackageByType() {
		$packages = self::$client->searchPackages(null, null, 'composer-plugin');
		self::assertIsArray($packages);
		self::assertNotEmpty($packages);
		self::assertContainsOnlyInstancesOf(PackageDescription::class, $packages);
	}
}
