<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter\BasePath;


use Nette\Http\IRequest;

final class NetteHttpBasePathProvider implements BasePathProvider
{

	/** @var IRequest */
	private $httpRequest;


	public function __construct(IRequest $httpRequest)
	{
		$this->httpRequest = $httpRequest;
	}


	public function getBasePath(): string
	{
		return $this->httpRequest->getUrl()->getBasePath();
	}
}
