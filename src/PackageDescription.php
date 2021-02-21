<?php

/**
 * Contains TomEganTech\PackagistClient\PackageDescription
 *
 * @author Tom Egan <tom@tomeagn.tech>
 * @package TomEganTech\PackagistClient
 * @license MIT
 */

declare(strict_types=1);

namespace TomEganTech\PackagistClient;

use InvalidArgumentException;

/**
 * A data type encapsulating a security advisory
 */
class PackageDescription {
	/**
	 * The properties data arrays passed to fromArray() must contain as strings
	 */
	const REQUIRED_STRING_PROPERTIES = [
		'name',
		'description',
		'url',
		'repository'
	];

	/**
	 * The properties data arrays passed to fromArray() must contain as integers
	 */
	const REQUIRED_INT_PROPERTIES = [
		'downloads',
		'favers'
	];

	#region instance variables

	/**
	 * The name (vendor/identifier) of the package.
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * A description of the package
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * The url for the package oon packagist.org
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * The version control repository where the package is developed.
	 *
	 * @var string
	 */
	protected $repository;

	/**
	 * The number of times the package has been downloaded.
	 *
	 * @var int
	 */
	protected $downloads;

	/**
	 * The number of times the package has been marked as a favorite (starred).
	 *
	 * @var int
	 */
	protected $favers;

	#endregion

	#region accessor methods

	/**
	 * Get the name (vendor/identifier) of the package.
	 *
	 * @return string  The name (vendor/identifier) of the package.
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * Set the name (vendor/identifier) of the package.
	 *
	 * @param string $name  The name (vendor/identifier) of the package.
	 * @return self
	 */
	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}

	/**
	 * Get the description of the package
	 *
	 * @return string  The description of the package
	 */
	public function getDescription(): string {
		return $this->description;
	}

	/**
	 * Set the description of the package
	 *
	 * @param string $description  The description of the package
	 * @return self
	 */
	public function setDescription(string $description): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * Get the url for the package oon packagist.org
	 *
	 * @return string  The url for the package oon packagist.org
	 */
	public function getURL(): string {
		return $this->url;
	}

	/**
	 * Set the url for the package oon packagist.org
	 *
	 * @param string $url  The url for the package oon packagist.org
	 * @return self
	 */
	public function setURL(string $url): self {
		$this->url = $url;
		return $this;
	}

	/**
	 * Get the version control repository where the package is developed.
	 *
	 * @return string  The version control repository where the package is
	 *      developed.
	 */
	public function getRepository(): string {
		return $this->repository;
	}

	/**
	 * Set the version control repository where the package is developed.
	 *
	 * @param string $repository  The version control repository where the
	 *      package is developed.
	 * @return self
	 */
	public function setRepository(string $repository): self {
		$this->repository = $repository;
		return $this;
	}

	/**
	 * Get the number of times the package has been downloaded.
	 *
	 * @return int  The number of times the package has been downloaded.
	 */
	public function getDownloads(): int {
		return $this->downloads;
	}

	/**
	 * Set the number of times the package has been downloaded.
	 *
	 * @param int $downloads  The number of times the package has been
	 *      downloaded.
	 * @return self
	 */
	public function setDownloads(int $downloads): self {
		$this->downloads = $downloads;
		return $this;
	}

	/**
	 * Get the number of times the package has been marked as a favorite
	 * (starred).
	 *
	 * @return int  The number of times the package has been marked as a
	 *      favorite (starred).
	 */
	public function getFavers(): int {
		return $this->favers;
	}

	/**
	 * Set the number of times the package has been marked as a favorite
	 * (starred).
	 *
	 * @param int $favers  The number of times the package has been marked as a
	 *      favorite (starred).
	 * @return self
	 */
	public function setFavers(int $favers): self {
		$this->favers = $favers;
		return $this;
	}

	#endregion

	/**
	 * Create instance from an array of data
	 *
	 * @param array $data  A dictionary of data such as from decoding the JSON
	 *      retreived from the Packagist REST API
	 * @return PackageDescription
	 */
	public static function fromArray(array $data): PackageDescription {
		// check for required properities
		foreach(self::REQUIRED_STRING_PROPERTIES as $propertyName) {
			if(!array_key_exists($propertyName, $data) || !is_string($data[$propertyName])) {
				throw new InvalidArgumentException(
					'data must contain the ' . $propertyName . ' to decode into a PackageDescription'
				);
			}
		}
		foreach(self::REQUIRED_INT_PROPERTIES as $propertyName) {
			if(!array_key_exists($propertyName, $data) || !is_int($data[$propertyName])) {
				throw new InvalidArgumentException(
					'data must contain the ' . $propertyName . ' to decode into a PackageDescription'
				);
			}
		}

		// build package description
		return (new PackageDescription())
			->setName($data['name'])
			->setDescription($data['description'])
			->setURL($data['url'])
			->setRepository($data['repository'])
			->setDownloads(intval($data['downloads']))
			->setFavers(intval($data['favers']));
	}
}