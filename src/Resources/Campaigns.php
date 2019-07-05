<?php

namespace CapsuleB\Resources;

use CapsuleB\Client;

/**
 * Class Addons
 * @package CapsuleB\Resources
 *
 * @property Client $client
 */
class Addons {

  const BASE_URL = 'campaigns';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

}
