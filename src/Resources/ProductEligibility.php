<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class ProductEligibility
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/en-us/eligibility-prod-3p#
 *
 * @property Client $client
 */
class ProductEligibility {

  const BASE_URL_SP = 'eligibility';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/en-us/eligibility-prod-3p#/Product%20Eligibility/productEligibility
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function metadata($params = []) {
    return $this->client->post([self::BASE_URL_SP, 'product', 'list'], null, $params);
  }

}
