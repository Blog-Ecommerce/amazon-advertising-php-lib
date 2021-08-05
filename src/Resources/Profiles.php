<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Profiles
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/profiles
 *
 * @property Client $client
 */
class Profiles {

  const BASE_URL = 'v2/profiles';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/profiles#listProfiles
   * @return array
   * @throws Exception
   */
  public function list() {
    return $this->client->get([self::BASE_URL]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/profiles#getProfile
   * @param $profileId
   * @return array
   * @throws Exception
   */
  public function get($profileId) {
    return $this->client->get([self::BASE_URL, $profileId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/profiles#updateProfiles
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/profiles#registerProfile
   * @param $countryCode
   * @return array
   * @throws Exception
   */
  public function register($countryCode) {
    return $this->client->put([self::BASE_URL, 'register'], null, [
      'countryCode' => $countryCode
    ]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/profiles#registerBrand
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
