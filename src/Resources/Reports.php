<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Reports
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/reports
 *
 * @property Client $client
 */
class Reports {

  const BASE_URL = 'reports';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @param string $recordType
   * @param string|array $reportDate
   * @param string|array $segment
   * @param array $metrics
   * @return mixed
   * @throws Exception
   */
  private function retrieve($type, $recordType, $reportDate, $segment, $metrics) {
    $params = [];
    if (!empty($reportDate) ) $params['reportDate'] = $reportDate;
    if (!empty($metrics)    ) $params['metrics']    = implode(',', $metrics);
    if (!empty($segment)    ) $params['segment']    = $segment;

    return $this->client->post([$type, $recordType, 'report'], null, $params);
  }

  public function download($id) {
    $report = $this->client->get([self::BASE_URL, $id]);

    // If the report is ready, download, format and return it
    if ($report->status == 'SUCCESS') {
      return $this->client->download($report->location);
    }

    // Otherwise return the answer as-is
    return $report;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Campaigns-reports
   * @param $reportDate
   * @param $segment
   * @param array $metrics
   * @return mixed
   * @throws Exception
   */
  public function getCampaigns($reportDate, $metrics = [], $segment = []) {
    return $this->retrieve('sp', 'campaigns', $reportDate, $metrics, $segment);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Campaigns-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getCampaignsHSA($reportDate, $metrics = [], $segment = []) {
    return $this->retrieve('hsa', 'campaigns', $reportDate, $metrics, $segment);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Ad-Group-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getAdGroups($reportDate, $metrics = [], $segment = []) {
    return $this->retrieve('sp', 'adGroups', $reportDate, $metrics, $segment);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Ad-Group-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getAdGroupsHSA($reportDate, $metrics = [], $segment = []) {
    return $this->retrieve('hsa', 'adGroups', $reportDate, $metrics, $segment);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Keyword-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getKeywords($reportDate, $metrics = [], $segment = []) {
    return $this->retrieve('sp', 'keywords', $reportDate, $metrics, $segment);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Keyword-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getKeywordsHSA($reportDate, $metrics = [], $segment = []) {
    return $this->retrieve('hsa', 'keywords', $reportDate, $metrics, $segment);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Product-Ads-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getProductAds($reportDate, $metrics = [], $segment = []) {
    return $this->retrieve('sp', 'productAds', $reportDate, $metrics, $segment);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Product-Targeting-Reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getProductTargeting($reportDate, $metrics = [], $segment = []) {
    return $this->retrieve('sp', 'productAds', $reportDate, $metrics, $segment);
  }
}
