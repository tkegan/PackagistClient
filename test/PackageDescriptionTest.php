<?php

/**
 * Contains PackageDescriptionTest
 *
 * @author Tom Egan <tom@tomeagn.tech>
 * @license MIT
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use TomEganTech\PackagistClient\PackageDescription;

/** Test PackageDescription */
final class PackageDescriptionTest extends TestCase {
	/** Test agreement between accessors */
	public function testAccessorMethods() {
		$name = 'monolog/monolog';
		$description = 'Sends your logs to files, sockets, inboxes, databases and various web services';
		$url = 'https://packagist.org/packages/monolog/monolog';
		$repository = 'https://github.com/Seldaek/monolog';
		$downloads = 272186276;
		$favers = 19084;

		$package = (new PackageDescription())
			->setName($name)
			->setDescription($description)
			->setURL($url)
			->setRepository($repository)
			->setDownloads($downloads)
			->setFavers($favers);
		
		self::assertEquals($name, $package->getName());
		self::assertEquals($description, $package->getDescription());
		self::assertEquals($url, $package->getURL());
		self::assertEquals($repository, $package->getRepository());
		self::assertEquals($downloads, $package->getDownloads());
		self::assertEquals($favers, $package->getFavers());
	}

	/** Test creating instances from data array */
	public function testFromArray() {
		$name = 'monolog/monolog';
		$description = 'Sends your logs to files, sockets, inboxes, databases and various web services';
		$url = 'https://packagist.org/packages/monolog/monolog';
		$repository = 'https://github.com/Seldaek/monolog';
		$downloads = 272186276;
		$favers = 19084;

		$data = [
			'name' => $name,
			'description' => $description,
			'url' => $url,
			'repository' => $repository,
			'downloads' => $downloads,
			'favers' => $favers
		];

		$package = PackageDescription::fromArray($data);

		self::assertEquals($name, $package->getName());
		self::assertEquals($description, $package->getDescription());
		self::assertEquals($url, $package->getURL());
		self::assertEquals($repository, $package->getRepository());
		self::assertEquals($downloads, $package->getDownloads());
		self::assertEquals($favers, $package->getFavers());
	}
}
