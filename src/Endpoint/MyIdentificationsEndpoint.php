<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\MyIdentificationInfo;

/**
 * @extends ResourceEndpoint<MyIdentificationInfo>
 */
final class MyIdentificationsEndpoint extends ResourceEndpoint
{
    public function __construct(MyEndpoint $parent)
    {
        parent::__construct($parent, '/identifications');
    }

    public function info(string $id): MyIdentificationInfo
    {
        return $this->createResource($this->getRequest('/{id}/info', ['id' => $id]), MyIdentificationInfo::class);
    }
}
