<?php

/**
 * Contains TomEganTech\PackagistClient\PackagistClient
 *
 * @author Tom Egan <tom@tomeagn.tech>
 * @package TomEganTech\PackagistClient
 * @license MIT
 */

declare(strict_types=1);

namespace TomEganTech\PackagistClient;

use DateTime;
use RuntimeException;

use GuzzleHttp\Client as HttpClient;

/**
 * A client for working withthe Packagist API
 */
class PackagistClient {
	/** URL to request to list packages */
	public const LIST_PACKAGES_URL = 'https://packagist.org/packages/list.json';

	public const LIST_SECURITY_ADVISORIES_URL = 'https://packagist.org/api/security-advisories';

	/**
	 * The http request we use for making requests to the REST API
	 *
	 * @var HttpClient
	 */
	protected $client;

	/**
	 * Create new instances of the PackgistClient.
	 *
	 * @param HttpClient $client  An HTTP client to use to make requests of the
	 *      Packagist REST API.
	 */
	public function __construct(HttpClient $client) {
		$this->client = $client;
	}

	/**
	 * Get the HTTP client to use to make requests of the Packagist REST API.
	 *
	 * @return  The HTTP client to use to make requests of the Packagist REST
	 *      API.
	 */
	public function getClient(): HttpClient {
		return $this->client;
	}

	/**
	 * Set the HTTP client to use to make requests of the Packagist REST API.
	 *
	 * @param HttpClient $client  An HTTP client to use to make requests of the
	 *      Packagist REST API.
	 * @return self
	 */
	public function setClient(HttpClient $client) {
		$this->client = $client;
		return $this;
	}

	/**
	 * Get a list of packages; optionally meeting some criteria
	 *
	 * @param string|null $organization  Search only for packages by this
	 *      organization. Specify null (the default) to search for packages from
	 *      all organizations.
	 * @param string|null  $type  Search only for packages of this type. Specify
	 *      null (the default) to search for packages of all types.
	 * @return string[]  The list of package names reported by the API
	 */
	public function listPackages(
		?string $organization = null,
		?string $type = null
	): array {
		$url = self::LIST_PACKAGES_URL;
		$query = [];

		if(null !== $organization && 0 < strlen($organization)) {
			$query['vendor'] = $organization;
		}

		if(null !== $type && 0 < strlen($type)) {
			$query['type'] = $type;
		}

		$response = $this->getClient()->get($url, [
			'query' => $query
		]);
		
		if(200 === $response->getStatusCode()) {
			$body = (string) $response->getBody();
			$data = json_decode($body, true);
			if(is_array($data) && array_key_exists('packageNames', $data)) {
				return $data['packageNames'];
			}
		}

		throw new RuntimeException(
			'PackagistAPI did not respond as expected',
			$response->getStatusCode()
		);
	}

	/**
	 * Get a list of security adisories; optionally meeting some criteria
	 *
	 * @param DateTime|null $since  Search only for security advisories after
	 *      this time. Specify null (the default) to search for security
	 *      advisories from anytime.
	 * @param string[]|null $packages  Search only for security advisories
	 *      related to these packages. Specify null (the default) to search for
	 *      security advisories for all packages.
	 * @return SecurityAdvisory[]  The list of security advisories reported by
	 *      the API
	 */
	public function listSecurityAdvisories(
		?DateTime $since = null,
		?array $packages = null
	): array {
		$url = self::LIST_SECURITY_ADVISORIES_URL;
		$query = [];

		if(null !== $since && 0 < strlen($since)) {
			$query['updatedSince'] = $since;
		}

		if(null !== $packages && 0 < count($packages)) {
			$query['packages'] = $packages;
		}

		$response = $this->getClient()->get($url, [
			'query' => $query
		]);
		
		if(200 === $response->getStatusCode()) {
			$body = (string) $response->getBody();
			$data = json_decode($body, true);
			if(is_array($data) && array_key_exists('advisories', $data)) {
				$advisories = [];
				foreach($data['advisories'] as $package => $packageAdvisories) {
					foreach($packageAdvisories as $advisory) {
						$advisories[] = SecurityAdvisory::fromArray($advisory);
					}
				}
				return $advisories;
			}
		}

		throw new RuntimeException(
			'PackagistAPI did not respond as expected',
			$response->getStatusCode()
		);
	}
}