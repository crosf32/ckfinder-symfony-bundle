<?php

namespace CKSource\Bundle\CKFinderBundle\Factory;

use CKSource\Bundle\CKFinderBundle\Authentication\AuthenticationInterface;

class ConnectorFactory
{
    /**
     * @var array
     */
    protected $connectorConfig;

    /**
     * @var AuthenticationInterface
     */
    protected $authenticationService;

    protected $connectorInstance;

    /**
     * ConnectorFactory constructor.
     *
     * @param $connectorConfig
     * @param $authenticationService
     */
    public function __construct($connectorConfig, $authenticationService)
    {
        $this->connectorConfig = $connectorConfig;
        $this->authenticationService = $authenticationService;
    }

    public function getConnector()
    {
        if ($this->connectorInstance) {
            return $this->connectorInstance;
        }

        $connector = new $this->connectorConfig['connectorClass']($this->connectorConfig);

        $connector['authentication'] = $this->authenticationService;

        $this->connectorInstance = $connector;

        return $connector;
    }
}
