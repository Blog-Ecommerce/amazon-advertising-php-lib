<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class AdGroups
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/ad_groups
 *
 * @property Client $client
 */
class AdGroups {

  const BASE_URL_SP = 'v2/sp/adGroups';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(
    protected Client $client
  ) {}

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/ad_groups#listAdGroups
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL_SP, $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/ad_groups#listAdGroupsEx
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL_SP, 'extended'], $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/ad_groups#getAdGroup
   * @param string $adGroupId
   * @return array
   * @throws Exception
   */
  public function get($adGroupId) {
    return $this->client->get(self::BASE_URL_SP, $adGroupId);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/ad_groups#getAdGroupEx
   * @param string $adGroupId
   * @return array
   * @throws Exception
   */
  public function getExtended($adGroupId) {
    return $this->client->get([self::BASE_URL_SP, 'extended', $adGroupId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/ad_groups#createAdGroups
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/ad_groups#updateAdGroups
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/ad_groups#archiveAdGroup
   * @param string $adGroupId
   * @return array
   * @throws Exception
   */
  public function archive($adGroupId) {
    return $this->client->delete(self::BASE_URL_SP, $adGroupId);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/suggested_keywords#getAdGroupSuggestedKeywords
   * @param $adGroupId
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function getSuggestedKeywords($adGroupId, $params = []) {
    return $this->client->get([self::BASE_URL_SP, $adGroupId, 'suggested', 'keywords'], null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/suggested_keywords#getAdGroupSuggestedKeywordsEx
   * @param $adGroupId
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function getSuggestedKeywordsExtended($adGroupId, $params = []) {
    return $this->client->get([self::BASE_URL_SP, $adGroupId, 'suggested', 'keywords', 'extended'], null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/suggested_keywords#getAsinSuggestedKeywords
   * @param $asinValue
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function getAsinSuggestedKeywords($asinValue, $params = []) {
    return $this->client->get(['asins', $asinValue, 'suggested', 'keywords'], null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/suggested_keywords#bulkGetAsinSuggestedKeywords
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function bulkGetAsinSuggestedKeywords($params = []) {
    return $this->client->post(['asins', 'suggested', 'keywords'], null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/bidding/bid_recommendations#getAdGroupBidRecommendations
   * @param $adGroupId
   * @return array
   * @throws Exception
   */
  public function getBidRecommendations($adGroupId) {
    return $this->client->get([self::BASE_URL_SP, $adGroupId, 'bidRecommendations']);
  }

  /**
   * @return Keywords
   */
  public function biddableKeywords() {
    return new Keywords($this->client);
  }

  /**
   * @return NegativeKeywords
   */
  public function negativeKeywords() {
    return new NegativeKeywords($this->client);
  }

}
