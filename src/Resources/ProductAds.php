<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class ProductAds
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/product_ads
 *
 * @property Client $client
 */
class ProductAds {

  const BASE_URL_SP = 'sp/productAds';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_ads#listProductAds
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL_SP, $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_ads#listProductAdsEx
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL_SP, 'extended'], $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_ads#getProductAd
   * @param string $adId
   * @return array
   * @throws Exception
   */
  public function get($adId) {
    return $this->client->get(self::BASE_URL_SP, $adId);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_ads#getProductAdEx
   * @param string $adId
   * @return array
   * @throws Exception
   */
  public function getExtended($adId) {
    return $this->client->get([self::BASE_URL_SP, 'extended', $adId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_ads#createProductAds
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_ads#updateProductAds
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_ads#archiveProductAd
   * @param string $adId
   * @return array
   * @throws Exception
   */
  public function archive($adId) {
    return $this->client->delete(self::BASE_URL_SP, $adId);
  }

}
