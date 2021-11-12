<?php

namespace CapsuleB\AmazonAdvertising;

use CapsuleB\AmazonAdvertising\Resources\AdGroups;
use CapsuleB\AmazonAdvertising\Resources\Keywords;
use CapsuleB\AmazonAdvertising\Resources\NegativeKeywords;
use CapsuleB\AmazonAdvertising\Resources\Campaigns;
use CapsuleB\AmazonAdvertising\Resources\CampaignsNegativeKeywords;
use CapsuleB\AmazonAdvertising\Resources\NegativeProductTargeting;
use CapsuleB\AmazonAdvertising\Resources\Portfolios;
use CapsuleB\AmazonAdvertising\Resources\ProductAds;
use CapsuleB\AmazonAdvertising\Resources\ProductSelector;
use CapsuleB\AmazonAdvertising\Resources\ProductTargeting;
use CapsuleB\AmazonAdvertising\Resources\Profiles;
use CapsuleB\AmazonAdvertising\Resources\Reports;
use CapsuleB\AmazonAdvertising\Resources\Snapshots;
use CapsuleB\AmazonAdvertising\Resources\Stores;
use Exception;

/**
 * Class Client
 * @package CapsuleB\AmazonAdvertising
 *
 * @property AdGroups                   $adGroups
 * @property Keywords                   $keywords
 * @property NegativeKeywords           $negativeKeywords
 * @property Campaigns                  $campaigns
 * @property CampaignsNegativeKeywords  $campaignsNegativeKeywords
 * @property Portfolios                 $portfolios
 * @property ProductSelector            $productSelector
 * @property ProductAds                 $productAds
 * @property ProductTargeting           $productTargeting
 * @property NegativeProductTargeting   $negativeProductTargeting
 * @property Profiles                   $profiles
 * @property Reports                    $reports
 * @property Snapshots                  $snapshots
 * @property Stores                     $stores
 */
class Client {

  /**
   * Sandbox Environment. Covers all marketplaces
   */
  const BASE_URL_SANDBOX = 'https://advertising-api-test.amazon.com';

  /**
   * North America (NA). Covers US, CA, MX, and BR marketplaces
   */
  const BASE_URL_NA = 'https://advertising-api.amazon.com';

  /**
   * Europe (EU). Covers UK, FR, IT, ES, DE, NL, and AE marketplaces
   */
  const BASE_URL_EU = 'https://advertising-api-eu.amazon.com';

  /**
   * Far East (FE). Covers JP, AU, and SG marketplaces.
   */
  const BASE_URL_FE = 'https://advertising-api-fe.amazon.com';

  /**
   * URL used to refresh the token
   */
  const BASE_REFRESH_TOKEN = 'https://api.amazon.com/auth/o2/token';

  /**
   * @var string $baseUrl
   */
  private $baseUrl;

  /**
   * @var $requestHeader
   */
  private $requestHeader;

  /**
   * @var $requestQuery
   */
  private $requestQuery;

  /**
   * @var $curlClient
   */
  private $curlClient;

  /**
   * @var string $clientId
   */
  private $clientId;

  /**
   * @var string $clientSecret
   */
  private $clientSecret;

  /**
   * @var string $accessToken
   */
  private $accessToken;

  /**
   * @var string $refreshToken
   */
  private $refreshToken;

  /**
   * @var string $customerId
   */
  private $customerId;

  /**
   * @var string $userAgent
   */
  private $userAgent;

  /**
   * @var string $region
   */
  private $region;

  /**
   * @var bool $sandbox
   */
  private $sandbox;

  /**
   * @var int $retryAfter
   */
  private $retryAfter = 0;

  /**
   * Client constructor.
   * @param $clientId
   * @param $clientSecret
   * @param $accessToken
   * @param $refreshToken
   * @param null $region
   * @param bool $sandbox
   */
  public function __construct($clientId, $clientSecret, $accessToken, $refreshToken = null, $region = null, $sandbox = true) {
    // Init the Curl Client
    $this->curlClient = curl_init();

    // Init the infos
    $this->clientId     = $clientId;
    $this->clientSecret = $clientSecret;
    $this->accessToken  = $accessToken;
    $this->refreshToken = $refreshToken;
    $this->region       = $region;
    $this->sandbox      = $sandbox;

    // Init the header and query
    $this->initBaseUrl();
    $this->initHeader();
    $this->initQuery();

    // Init the resources
    $this->adGroups                   = new AdGroups($this);
    $this->keywords                   = new Keywords($this);
    $this->negativeKeywords           = new NegativeKeywords($this);
    $this->campaigns                  = new Campaigns($this);
    $this->campaignsNegativeKeywords  = new CampaignsNegativeKeywords($this);
    $this->portfolios                 = new Portfolios($this);
    $this->productAds                 = new ProductAds($this);
    $this->productSelector            = new ProductSelector($this);
    $this->productTargeting           = new ProductTargeting($this);
    $this->negativeProductTargeting   = new NegativeProductTargeting($this);
    $this->profiles                   = new Profiles($this);
    $this->reports                    = new Reports($this);
    $this->snapshots                  = new Snapshots($this);
    $this->stores                     = new Stores($this);
  }

  /**
   * Inits the Base Url by checking which one to use base on region
   */
  private function initBaseUrl() {
    if ($this->sandbox == true || empty($this->region)) {
      $this->baseUrl = self::BASE_URL_SANDBOX;
    } else {
      switch (strtoupper($this->region)) {
        case 'NA':
        case 'US':
        case 'CA':
        case 'MX':
        case 'BR':
          $this->baseUrl = self::BASE_URL_NA;
          break;
        case 'EU':
        case 'UK':
        case 'FR':
        case 'IT':
        case 'ES':
        case 'DE':
        case 'NL':
        case 'AE':
          $this->baseUrl = self::BASE_URL_EU;
          break;
        case 'FE':
        case 'JP':
        case 'AU':
        case 'SG':
          $this->baseUrl = self::BASE_URL_FE;
          break;
        default:
          $this->baseUrl = self::BASE_URL_SANDBOX;
          break;
      }
    }
  }

  /**
   * Init the request header
   */
  private function initHeader() {
    $this->requestHeader = [
      'Content-Type: application/json',
      'User-Agent: ' . $this->userAgent,
      'Authorization: Bearer ' . $this->accessToken,
      'Amazon-Advertising-API-ClientId: ' . $this->clientId
    ];
  }

  /**
   * Init the request base query
   */
  private function initQuery() {
    $this->requestQuery = [];
  }

  /**
   * @param array $query
   */
  protected function appendQuery($query = []) {
    $this->requestQuery += $this->wrap($query);
  }

  /**
   * @param array $header
   */
  protected function appendHeader($header = []) {
    $this->requestHeader = array_merge($this->requestHeader, $this->wrap($header));
  }

  /**
   * Append the customer Id (aka Scope) to the header
   * @param $customerId
   */
  public function setCustomerId($customerId) {
    $this->customerId = $customerId;

    // Reset the header, and apply the customer id scope
    $this->initHeader();
    $this->appendHeader(['Amazon-Advertising-API-Scope:' . $customerId]);
  }

  public function setUserAgent($userAgent) {
    $this->userAgent = $userAgent;
  }

  /**
   * @return mixed
   */
  public function getCustomerId() {
    return $this->getCustomerId();
  }

  /**
   * Check if the request was made in a sandbox mode
   *
   * @return bool
   */
  public function isSandbox() {
    return $this->sandbox;
  }

  /**
   * Refresh the token and store the new access token (return the info so it can be stored in DB)
   * @return mixed
   * @throws Exception
   */
  public function refreshToken() {
    // Reset temporarily the header
    $this->requestHeader = [
      'Content-Type: application/json',
    ];

    // Make the request to refresh the access token
    $this->baseUrl = self::BASE_REFRESH_TOKEN;
    $responseToken = $this->post([self::BASE_REFRESH_TOKEN], null, [
      'grant_type'    => 'refresh_token',
      'client_id'     => $this->clientId,
      'refresh_token' => $this->refreshToken,
      'client_secret' => $this->clientSecret
    ]);

    // Store the new token
    $this->accessToken  = $responseToken->access_token;
    $this->refreshToken = $responseToken->refresh_token;

    // (re)Init the url, header, query
    $this->initBaseUrl();
    $this->initHeader();
    $this->initQuery();

    // Return the newly created token
    return $responseToken;
  }

  /**
   * @param $method
   * @param $path
   * @param array $query
   * @param array $params
   * @return array|mixed|object
   * @throws Exception
   */
  protected function request($method, $path, $query = [], $params = []) {
    // Reset any previous request
    $this->curlClient = curl_init();

    // Create path
    if (is_array($path)) {
      $path = implode('/', $path);
    }

    // Append the query to the request base queries
    $query = array_merge($this->requestQuery, $query);

    // Add query params
    if (!empty(array_filter($query))) {
      $path .= '?' . http_build_query($query);
    }

    // Set the url to use for the request (creates exception for refresh token)
    $requestUrl = $this->baseUrl == self::BASE_REFRESH_TOKEN ? $this->baseUrl : $this->baseUrl . '/' . $path;

    // Set the request params
    curl_setopt($this->curlClient, CURLOPT_URL, $requestUrl);
    curl_setopt($this->curlClient, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->curlClient, CURLOPT_HEADER, true);
    curl_setopt($this->curlClient, CURLOPT_NOBODY, false);
    curl_setopt($this->curlClient, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($this->curlClient, CURLOPT_USERAGENT, $this->userAgent);
    curl_setopt($this->curlClient, CURLOPT_HTTPHEADER, $this->requestHeader);

    // Add params if any
    if (!empty($params)) {
      curl_setopt($this->curlClient, CURLOPT_POST, true);
      curl_setopt($this->curlClient, CURLOPT_POSTFIELDS, json_encode($params));
    }

    // Return headers seperatly from the Response Body
    $response     = curl_exec($this->curlClient);
    $header_size  = curl_getinfo($this->curlClient, CURLINFO_HEADER_SIZE);
    $httpcode     = curl_getinfo($this->curlClient, CURLINFO_HTTP_CODE);
    $headers      = $this->formatHeader(substr($response, 0, $header_size));
    $body         = json_decode(substr($response, $header_size));
    $responseInfo = curl_getinfo($this->curlClient);

    // Close the connection
    curl_close($this->curlClient);

    // If it's a 307 HTTP Status, redirect to download
    if ($httpcode == 307) {
      return $this->download($responseInfo["redirect_url"], true);
    }

    // If it's a 429 HTTP Status, wait the required time, and retry
    if ($httpcode == '429') {
      $this->retryAfter += 10;
      sleep($headers['Retry-After'] ?? $this->retryAfter);
      return $this->request($method, $path, $query, $params);
    } else {
      $this->retryAfter = 0;
    }

    // Return the response
    if (in_array($httpcode, [200, 201, 202, 203, 204, 205, 206, 207, 208, 210, 226])) {
      return $body;
    } else {
      throw new Exception($response, $httpcode);
    }
  }

  /**
   * GET Method
   *
   * @param $path
   * @param array $query
   * @param array $params
   * @return mixed
   * @throws Exception
   */
  public function get($path, $query = [], $params = []) {
    return $this->request('GET', $path, $this->wrap($query), $this->wrap($params));
  }

  /**
   * POST Method
   *
   * @param $path
   * @param array $query
   * @param array $params
   * @return mixed
   * @throws Exception
   */
  public function post($path, $query = [], $params = []) {
    return $this->request('POST', $path, $this->wrap($query), $this->wrap($params));
  }

  /**
   * PUT Method
   *
   * @param $path
   * @param array $query
   * @param array $params
   * @return mixed
   * @throws Exception
   */
  public function put($path, $query = [], $params = []) {
    return $this->request('PUT', $path, $this->wrap($query), $this->wrap($params));
  }

  /**
   * DELETE Method
   *
   * @param $path
   * @param array $query
   * @param array $params
   * @return mixed
   * @throws Exception
   */
  public function delete($path, $query = [], $params = []) {
    return $this->request('DELETE', $path, $this->wrap($query), $this->wrap($params));
  }

  /**
   * Process to request a download file and downloads it (mostly for reports)
   *
   * @param $url
   * @param bool $gunzip
   * @return mixed
   * @throws Exception
   */
  public function download($url, $gunzip = false) {
    if (!$gunzip) {
      $this->baseUrl = $url;
      return $this->get([]);
    } else {
      // Inits Curl with the necessary settings
      $this->curlClient = curl_init();
      curl_setopt($this->curlClient, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($this->curlClient, CURLOPT_URL, $url);
      curl_setopt($this->curlClient,CURLOPT_ENCODING , '');

      // Executes the request (and closes it)
      $response = curl_exec($this->curlClient);
      curl_close($this->curlClient);

      // (re)Init the base url
      $this->initBaseUrl();

      // Decode (gunzip) the response and return it as json
      return json_decode(gzdecode($response));
    }
  }

  /**
   * If the given value is not an array, wrap it in one.
   *
   * @param  mixed  $value
   * @return array
   */
  private function wrap($value) {
    return !is_array($value) ? [$value] : $value;
  }

  /**
   * Used to format the header into an array with key=>value
   *
   * @param array $headers
   * @return array
   */
  private function formatHeader($headers = []) {
    $arrHeader = [];
    foreach (explode("\r\n", trim($headers)) as $header) {
      if (preg_match('/(.*?): (.*)/', $header, $matches)) {
        $arrHeader[$matches[1]] = $matches[2];
      } else {
        $arrHeader['Http-Code'] = $header;
      }
    }

    // Return the header transformed to array
    return $arrHeader;
  }
}
