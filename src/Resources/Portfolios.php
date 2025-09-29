<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Portfolios
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/portfolios
 *
 * @property Client $client
 */
class Portfolios {

  const BASE_URL = 'v2/portfolios';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(
    protected Client $client
  ) {}

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/portfolios#listPortfolios
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL, $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/portfolios#listPortfoliosEx
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL, 'extended'], $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/portfolios#getPortfolio
   * @param $portfolioId
   * @return array
   * @throws Exception
   */
  public function get($portfolioId) {
    return $this->client->get([self::BASE_URL, $portfolioId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/portfolios#getPortfolioEx
   * @param $portfolioId
   * @return array
   * @throws Exception
   */
  public function getExtended($portfolioId) {
    return $this->client->get([self::BASE_URL, 'extended', $portfolioId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/portfolios#createPortfolios
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/portfolios#updatePortfolios
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL, null, $params);
  }
}
