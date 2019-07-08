<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class AdGroups
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class AdGroups {

  const BASE_URL = 'adGroups';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL, $query);
  }

  /**
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL, 'extended'], $query);
  }

  /**
   * @param string $adGroupId
   * @return array
   * @throws Exception
   */
  public function get($adGroupId) {
    return $this->client->get(self::BASE_URL, $adGroupId);
  }

  /**
   * @param string $adGroupId
   * @return array
   * @throws Exception
   */
  public function getExtended($adGroupId) {
    return $this->client->get([self::BASE_URL, 'extended', $adGroupId]);
  }

  /**
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL, null, $params);
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
   * @param string $adGroupId
   * @return array
   * @throws Exception
   */
  public function archive($adGroupId) {
    return $this->client->delete(self::BASE_URL, $adGroupId);
  }

  /**
   * @param $adGroupId
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function getSuggestedKeywords($adGroupId, $params = []) {
    return $this->client->get([self::BASE_URL, $adGroupId, 'suggested', 'keywords'], null, $params);
  }

  /**
   * @param $adGroupId
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function getSuggestedKeywordsExtended($adGroupId, $params = []) {
    return $this->client->get([self::BASE_URL, $adGroupId, 'suggested', 'keywords', 'extended'], null, $params);
  }

  /**
   * @param $asinValue
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function getAsinSuggestedKeywords($asinValue, $params = []) {
    return $this->client->get(['asins', $asinValue, 'suggested', 'keywords'], null, $params);
  }

  /**
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function bulkGetAsinSuggestedKeywords($params = []) {
    return $this->client->post(['asins', 'suggested', 'keywords'], null, $params);
  }

  /**
   * @return AdGroupsBiddableKeywords
   */
  public function biddableKeywords() {
    return new AdGroupsBiddableKeywords($this->client);
  }

  /**
   * @return AdGroupsNegativeKeywords
   */
  public function negativeKeywords() {
    return new AdGroupsNegativeKeywords($this->client);
  }

}
