<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter;


use Oops\WebpackNetteAdapter\BasePath\BasePathProvider;

/**
 * @internal
 */
class PublicPathProvider
{

	/** @var string */
	private $path;

	/** @var BasePathProvider */
	private $basePathProvider;

	/** @var DevServer */
	private $devServer;


	public function __construct(string $path, BasePathProvider $basePathProvider, DevServer $devServer)
	{
		$this->path = $path;
		$this->basePathProvider = $basePathProvider;
		$this->devServer = $devServer;
	}


	public function getPublicPath(): string
	{
		return $this->devServer->isAvailable()
			? $this->devServer->getUrl()
			: \rtrim($this->basePathProvider->getBasePath(), '/') . '/' . \trim($this->path, '/');
	}
}
