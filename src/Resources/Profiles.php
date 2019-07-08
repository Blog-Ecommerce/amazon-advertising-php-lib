<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Profiles
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class Profiles {

  const BASE_URL = 'profiles';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @return array
   * @throws Exception
   */
  public function list() {
    return $this->client->get([self::BASE_URL]);
  }

  /**
   * @param $profileId
   * @return array
   * @throws Exception
   */
  public function get($profileId) {
    return $this->client->get([self::BASE_URL, $profileId]);
  }

  /**
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL, null, $params);
  }

  /**
   * @param $countryCode
   * @return array
   * @throws Exception
   */
  public function register($countryCode) {
    return $this->client->put(self::BASE_URL, null, [
      'countryCode' => $countryCode
    ]);
  }

  /**
   * @param $countryCode
   * @param $brand
   * @return array
   * @throws Exception
   */
  public function registerBrand($countryCode, $brand) {
    return $this->client->put([self::BASE_URL, 'registerBrand'], null, [
      'countryCode' => $countryCode,
      'brand' => $brand
    ]);
  }

}
