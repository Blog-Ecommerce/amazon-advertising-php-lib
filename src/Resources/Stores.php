<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Stores
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class Stores {

  const BASE_URL = 'stores';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

}
