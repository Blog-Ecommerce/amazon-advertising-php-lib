<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Reports
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class Reports {

  const BASE_URL = 'reports';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

}
