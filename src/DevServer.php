<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class DevServer
{

	/** @var bool */
	private $enabled;

	/** @var bool */
	private $available;

	/** @var string */
	private $url;

	/** @var string|null */
	private $publicUrl;

	/** @var float */
	private $timeout;

	/** @var ClientInterface */
	private $httpClient;


	public function __construct(bool $enabled, string $url, ?string $publicUrl, float $timeout, ClientInterface $httpClient)
	{
		$this->enabled = $enabled;
		$this->url = $url;
		$this->publicUrl = $publicUrl;
		$this->timeout = $timeout;
		$this->httpClient = $httpClient;
	}


	public function getUrl(): string
	{
		return $this->publicUrl ?? $this->url;
	}


	public function getInternalUrl(): string
	{
		return $this->url;
	}


	public function isEnabled(): bool
	{
		return $this->enabled;
	}


	public function isAvailable(): bool
	{
		if (!$this->isEnabled()) {
			return false;
		}
		if ($this->available === null) {
			try {
				/*
				 * This can produce false positives (if a different application is listening on the target port),
				 * but I currently fail to see a better solution. The root path is not guaranteed to produce a 200 OK
				 * response (can be 404 if the index file is missing), and while webpack-dev-server at least responds
				 * with an "X-Powered-By: Express" header, webpack-serve gives no hint whatsoever.
				 */

				$this->httpClient->request('GET', $this->url, ['http_errors' => false, 'verify' => false, 'timeout' => $this->timeout]);
				$this->available = true;

			} catch (GuzzleException $e) {
				$this->available = false;
			}
		}

		return $this->available;
	}
}
