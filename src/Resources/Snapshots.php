<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Snapshots
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/snapshots
 *
 * @property Client $client
 */
class Snapshots {

  const BASE_URL = 'v2/snapshot';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/snapshots#requestSnapshot
   * @param $recordType
   * @param $stateFilter
   * @return array
   * @throws Exception
   */
  public function request($recordType, $stateFilter) {
    return $this->client->post(['sp', $recordType, self::BASE_URL], null, [
      'stateFilter' => $stateFilter
    ]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/snapshots#requestSnapshot
   * @param $recordType
   * @param $stateFilter
   * @return array
   * @throws Exception
   */
  public function requestHSA($recordType, $stateFilter) {
    return $this->client->post(['hsa', $recordType, self::BASE_URL], null, [
      'stateFilter' => $stateFilter
    ]);
  }
}
