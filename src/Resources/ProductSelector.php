<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Products
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/en-us/product-metadata/#/Product%20Selector/ProductMetadata
 *
 * @property Client $client
 */
class ProductSelector {

  const BASE_URL_SP = 'product';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/en-us/product-metadata/#/Product%20Selector/ProductMetadata
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function metadata($params = []) {
    return $this->client->post([self::BASE_URL_SP, 'metadata'], null, $params);
  }

}
