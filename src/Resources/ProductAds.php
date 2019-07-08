<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class ProductAds
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class ProductAds {

  const BASE_URL = 'productAds';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

}
