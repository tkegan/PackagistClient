<?php

/**
 * Contains TomEganTech\PackagistClient\SecurityAdvisory
 *
 * @author Tom Egan <tom@tomeagn.tech>
 * @package TomEganTech\PackagistClient
 * @license MIT
 */

declare(strict_types=1);

namespace TomEganTech\PackagistClient;

use DateTime;
use InvalidArgumentException;

/**
 * A data type encapsulating a security advisory
 */
class SecurityAdvisory {
	/** The properties data arrays to fromArray() must contain */
	const REQUIRED_PROPERTIES = [
		'packageName',
		'remoteId',
		'title',
		'link',
		'affectedVersions',
		'source',
		'reportedAt',
		'composerRepository'
	];

	#region instance variables

	/**
	 * The name of the affected package
	 *
	 * @var string
	 */
	protected $packageName;

	/**
	 * Packagist's id for the security advisory
	 *
	 * @var string
	 */
	protected $remoteId;

	/**
	 * The title of the security advisory; a short, human readable, summary.
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * A link (URL) to the security advisory's disclosure
	 *
	 * @var string
	 */
	protected $link;

	/**
	 * The CVE id/number for the security advisory. See also https://cve.mitre.org/
	 *
	 * @var string|null
	 */
	protected $cve;

	/**
	 * The affected version, versions, or range of versions
	 *
	 * @var string
	 */
	protected $affectedVersions;

	/**
	 * The source of the security advisory, typically a vulnerability aggregator
	 * such as Friends Of PHP.
	 *
	 * @var string
	 */
	protected $source;
	
	/**
	 * When the security advisory was reported
	 *
	 * @var DateTime
	 */
	protected $reportedAt;

	/**
	 * The [URL of the] composer repository hosting the package
	 *
	 * @var string
	 */
	protected $composerRepository;

	#endregion

	#region accessor methods

	/**
	 * Get the name of the affected package.
	 *
	 * @return string  The name of the affected package.
	 */
	public function getPackageName(): string {
		return $this->packageName;
	}

	/**
	 * Set the name of the affected package.
	 *
	 * @param string $name  The name of the affected package.
	 * @return self
	 */
	public function setPackageName(string $name): self {
		$this->packageName = $name;
		return $this;
	}

	/**
	 * Get Packagist's id for the security advisory.
	 *
	 * @return string  Packagist's id for the security advisory.
	 */
	public function getRemoteId(): string {
		return $this->remoteId;
	}

	/**
	 * Set Packagist's id for the security advisory.
	 *
	 * @param string $id  Packagist's id for the security advisory.
	 * @return self
	 */
	public function setRemoteId(string $id): self {
		$this->remoteId = $id;
		return $this;
	}

	/**
	 * Get the title of the security advisory.
	 *
	 * @return string  The title of the security advisory.
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * Set the title of the security advisory.
	 *
	 * @param string $title  The title of the security advisory.
	 * @return self
	 */
	public function setTitle(string $title): self {
		$this->title = $title;
		return $this;
	}

	/**
	 * Get the link (URL) to the security advisory's disclosure.
	 *
	 * @return string  The link (URL) to the security advisory's disclosure.
	 */
	public function getLink(): string {
		return $this->link;
	}

	/**
	 * Set the link (URL) to the security advisory's disclosure.
	 *
	 * @param string $link  The link (URL) to the security advisory's disclosure.
	 * @return self
	 */
	public function setLink(string $link): self {
		$this->link = $link;
		return $this;
	}

	/**
	 * Get the CVE id/number for the security advisory.
	 *
	 * @return string|null  The CVE id/number for the security advisory.
	 */
	public function getCve(): ?string {
		return $this->cve;
	}

	/**
	 * Set the CVE id/number for the security advisory.
	 *
	 * @param string|null $cve  The CVE id/number for the security advisory.
	 * @return self
	 */
	public function setCve(?string $cve): self {
		$this->cve = $cve;
		return $this;
	}

	/**
	 * Get the affected version, versions, or range of versions.
	 *
	 * @return string  The affected version, versions, or range of versions.
	 */
	public function getAffectedVersions(): string {
		return $this->affectedVersions;
	}

	/**
	 * Set the affected version, versions, or range of versions.
	 *
	 * @param string $affectedVersions  The affected version, versions, or range
	 *      of versions.
	 * @return self
	 */
	public function setAffectedVersions(string $affectedVersions): self {
		$this->affectedVersions = $affectedVersions;
		return $this;
	}

	/**
	 * Get the source of the security advisory.
	 *
	 * @return string  The source of the security advisory.
	 */
	public function getSource(): string {
		return $this->source;
	}

	/**
	 * Set the source of the security advisory.
	 *
	 * @param string $source  The source of the security advisory.
	 * @return self
	 */
	public function setSource(string $source): self {
		$this->source = $source;
		return $this;
	}

	/**
	 * Get when the security advisory was reported.
	 *
	 * @return DateTime  When the security advisory was reported.
	 */
	public function getReportedAt(): DateTime {
		return $this->reportedAt;
	}

	/**
	 * Set when the security advisory was reported.
	 *
	 * @param DateTime $reportedAt  When the security advisory was reported.
	 * @return self
	 */
	public function setReportedAt(DateTime $reportedAt): self {
		$this->reportedAt = $reportedAt;
		return $this;
	}

	/**
	 * Get the composer repository hosting the package.
	 *
	 * @return string  The composer repository hosting the package.
	 */
	public function getComposerRepository(): string {
		return $this->composerRepository;
	}

	/**
	 * Set the composer repository hosting the package.
	 *
	 * @param string $repository  The composer repository hosting the package.
	 * @return self
	 */
	public function setComposerRepository(string $repository): self {
		$this->composerRepository = $repository;
		return $this;
	}

	#endregion

	/**
	 * Create instance from an array of data
	 *
	 * @param array $data  A dictionary of data such as from decoding the JSON
	 *      retreived from the Packagist REST API
	 * @return SecurityAdvisory
	 */
	public static function fromArray(array $data): SecurityAdvisory {
		// check for required properities
		foreach(self::REQUIRED_PROPERTIES as $propertyName) {
			if(!array_key_exists($propertyName, $data) || !is_string($data[$propertyName])) {
				throw new InvalidArgumentException(
					'data must contain the ' . $propertyName . ' to decode into a SecurityAdvisory'
				);
			}
		}

		// build advisory
		$advisory = (new SecurityAdvisory())
			->setPackageName($data['packageName'])
			->setRemoteId($data['remoteId'])
			->setTitle($data['title'])
			->setLink($data['link'])
			->setAffectedVersions($data['affectedVersions'])
			->setSource($data['source'])
			->setReportedAt(new DateTime($data['reportedAt']))
			->setComposerRepository($data['composerRepository']);
		
		// add in optional data
		if(array_key_exists('cve', $data) && null !== $data['cve']) {
			$advisory->setCve($data['cve']);
		}

		return $advisory;
	}
}
