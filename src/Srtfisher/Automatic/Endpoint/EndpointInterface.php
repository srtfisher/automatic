<?php namespace Srtfisher\Automatic\Endpoint;

interface EndpointInterface
{
    /**
     * Provide a Resource Instance
     *
     * @return Srtfisher\Automatic\Resource\AbstractResource
     */
    public function getResource();
    public function validateData($data);
}
