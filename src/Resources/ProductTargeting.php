<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class ProductTargeting
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class ProductTargeting {

  const BASE_URL = 'targets';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

}
