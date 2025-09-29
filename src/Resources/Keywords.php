<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Keywords
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords
 *
 * @property Client $client
 */
class Keywords {

  const BASE_URL_SP   = 'v2/sp/keywords';
  const BASE_URL_HSA  = 'v2/hsa/keywords';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(
    protected Client $client
  ) {}

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#listBiddableKeywords
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL_SP, $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#listBiddableKeywordsEx
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL_SP, 'extended'], $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#getBiddableKeyword
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function get($keywordId) {
    return $this->client->get([self::BASE_URL_SP, $keywordId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#getBiddableKeyword
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function getHSA($keywordId) {
    return $this->client->get([self::BASE_URL_HSA, $keywordId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#getBiddableKeywordEx
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function getExtended($keywordId) {
    return $this->client->get([self::BASE_URL_SP, 'extended', $keywordId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#createBiddableKeywords
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#createBiddableKeywords
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function createHSA($params = []) {
    return $this->client->post(self::BASE_URL_HSA, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#updateBiddableKeywords
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#updateBiddableKeywords
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function updateHSA($params = []) {
    return $this->client->put(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#archiveBiddableKeyword
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function archive($keywordId) {
    return $this->client->delete([self::BASE_URL_SP, $keywordId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_biddable_keywords#archiveBiddableKeyword
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function archiveHSA($keywordId) {
    return $this->client->delete([self::BASE_URL_SP, $keywordId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/bidding/bid_recommendations#getKeywordBidRecommendations
   * @param $keywordId
   * @return array
   * @throws Exception
   */
  public function getBidRecommendations($keywordId) {
    return $this->client->get([self::BASE_URL_SP, $keywordId, 'bidRecommendations']);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/bidding/bid_recommendations#createKeywordBidRecommendations
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function createBidRecommendations($params = []) {
    return $this->client->post(['ksponsoredeywords', 'bidRecommendations'], null, $params);
  }
}
