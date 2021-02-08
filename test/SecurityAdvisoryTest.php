<?php

/**
 * Contains SecurityAdvisoryTest
 *
 * @author Tom Egan <tom@tomeagn.tech>
 * @license MIT
 */

declare(strict_types=1);

use DateTime;

use PHPUnit\Framework\TestCase;

use TomEganTech\PackagistClient\SecurityAdvisory;

/** Test SecurityAdvisory */
final class SecurityAdvisoryTest extends TestCase {
	/** Test agreement between accessors */
	public function testAccessorMethods() {
		$packageName = 'monolog/monolog';
		$remoteId = 'monolog/monolog/2014-12-29-1.yaml';
		$title = 'Header injection in NativeMailerHandler';
		$link = 'https://github.com/Seldaek/monolog/pull/448#issuecomment-68208704';
		$affectedVersions = '>=1.8.0,<1.12.0';
		$source = 'FriendsOfPHP/security-advisories';
		$reportedAt = new DateTime('2014-12-29 00:00:00');
		$composerRepository = 'https://packagist.org';

		// nullables
		$cve = 'CVE-2014-00000';

		$advisory = (new SecurityAdvisory())
			->setPackageName($packageName)
			->setRemoteId($remoteId)
			->setTitle($title)
			->setLink($link)
			->setAffectedVersions($affectedVersions)
			->setSource($source)
			->setReportedAt($reportedAt)
			->setComposerRepository($composerRepository);
		
		self::assertEquals($packageName, $advisory->getPackageName());
		self::assertEquals($remoteId, $advisory->getRemoteId());
		self::assertEquals($title, $advisory->getTitle());
		self::assertEquals($link, $advisory->getLink());
		self::assertEquals($affectedVersions, $advisory->getAffectedVersions());
		self::assertEquals($source, $advisory->getSource());
		self::assertEquals($reportedAt, $advisory->getReportedAt());
		self::assertEquals($composerRepository, $advisory->getComposerRepository());
		self::assertNull($advisory->getCve());

		$advisory->setCve($cve);

		self::assertEquals($cve, $advisory->getCve());
	}

	/** Test creating instances from data array */
	public function testFromArray() {
		$data = [
			'packageName' => 'monolog/monolog',
			'remoteId' => 'monolog/monolog/2014-12-29-1.yaml',
			'title' => 'Header injection in NativeMailerHandler',
			'link' => 'https://github.com/Seldaek/monolog/pull/448#issuecomment-68208704',
			'cve' => 'CVE-2014-00000',
			'affectedVersions' => '>=1.8.0,<1.12.0',
			'source' => 'FriendsOfPHP/security-advisories',
			'reportedAt' => '2014-12-29 00:00:00',
			'composerRepository' => 'https://packagist.org'
		];

		$packageName = 'monolog/monolog';
		$remoteId = 'monolog/monolog/2014-12-29-1.yaml';
		$title = 'Header injection in NativeMailerHandler';
		$link = 'https://github.com/Seldaek/monolog/pull/448#issuecomment-68208704';
		$affectedVersions = '>=1.8.0,<1.12.0';
		$source = 'FriendsOfPHP/security-advisories';
		$reportedAt = new DateTime('2014-12-29 00:00:00');
		$composerRepository = 'https://packagist.org';
		$cve = 'CVE-2014-00000';

		$advisory = SecurityAdvisory::fromArray($data);

		self::assertEquals($packageName, $advisory->getPackageName());
		self::assertEquals($remoteId, $advisory->getRemoteId());
		self::assertEquals($title, $advisory->getTitle());
		self::assertEquals($link, $advisory->getLink());
		self::assertEquals($affectedVersions, $advisory->getAffectedVersions());
		self::assertEquals($source, $advisory->getSource());
		self::assertEquals($reportedAt, $advisory->getReportedAt());
		self::assertEquals($composerRepository, $advisory->getComposerRepository());
		self::assertEquals($cve, $advisory->getCve());
	}
}
