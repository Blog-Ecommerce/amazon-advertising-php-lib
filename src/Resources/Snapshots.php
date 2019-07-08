<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Snapshots
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class Snapshots {

  const BASE_URL = 'snapshots';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

}
