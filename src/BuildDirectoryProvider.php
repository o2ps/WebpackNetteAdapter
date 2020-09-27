<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter;


/**
 * @internal
 */
class BuildDirectoryProvider
{

	/** @var string */
	private $directory;

	/** @var DevServer */
	private $devServer;


	public function __construct(string $directory, DevServer $devServer)
	{
		$this->directory = $directory;
		$this->devServer = $devServer;
	}


	public function getBuildDirectory(): string
	{
		return $this->devServer->isAvailable()
			? $this->devServer->getInternalUrl()
			: $this->directory;
	}
}
