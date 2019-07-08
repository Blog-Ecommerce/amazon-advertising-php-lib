<?php

namespace CapsuleB\AmazonAdvertising;

use CapsuleB\AmazonAdvertising\Resources\AdGroups;
use CapsuleB\AmazonAdvertising\Resources\AdGroupsBiddableKeywords;
use CapsuleB\AmazonAdvertising\Resources\AdGroupsNegativeKeywords;
use CapsuleB\AmazonAdvertising\Resources\Campaigns;
use CapsuleB\AmazonAdvertising\Resources\CampaignsNegativeKeywords;
use CapsuleB\AmazonAdvertising\Resources\Portfolios;
use CapsuleB\AmazonAdvertising\Resources\ProductAds;
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
 * @property AdGroupsBiddableKeywords   $adGroupsBiddableKeywords
 * @property AdGroupsNegativeKeywords   $adGroupsNegativeKeywords
 * @property Campaigns                  $campaigns
 * @property CampaignsNegativeKeywords  $campaignsNegativeKeywords
 * @property Portfolios                 $portfolios
 * @property ProductAds                 $productAds
 * @property ProductTargeting           $productTargeting
 * @property Profiles                   $profiles
 * @property Reports                    $reports
 * @property Snapshots                  $snapshots
 * @property Stores                     $stores
 */
class Client {

  /**
   * Sandbox Environment. Covers all marketplaces
   */
  const BASE_URL_SANDBOX = 'https://advertising-api-test.amazon.com/v2';

  /**
   * North America (NA). Covers US and CA marketplaces
   */
  const BASE_URL_NA = 'https://advertising-api.amazon.com/v2';

  /**
   * Europe (EU). Covers UK, FR, IT, ES, and DE marketplaces
   */
  const BASE_URL_EU = 'https://advertising-api-eu.amazon.com/v2';

  /**
   * Far East (FE). Covers JP and AU marketplaces.
   */
  const BASE_URL_FE = 'https://advertising-api-fe.amazon.com/v2';

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
   * @var string $region
   */
  private $region;

  /**
   * @var bool $sandbox
   */
  private $sandbox;

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
    $this->adGroupsBiddableKeywords   = new AdGroupsBiddableKeywords($this);
    $this->adGroupsNegativeKeywords   = new AdGroupsNegativeKeywords($this);
    $this->campaigns                  = new Campaigns($this);
    $this->campaignsNegativeKeywords  = new CampaignsNegativeKeywords($this);
    $this->portfolios                 = new Portfolios($this);
    $this->productAds                 = new ProductAds($this);
    $this->productTargeting           = new ProductTargeting($this);
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
        case 'US':
        case 'CA':
          $this->baseUrl = self::BASE_URL_NA;
          break;
        case 'UK':
        case 'FR':
        case 'IT':
        case 'ES':
        case 'DE':
          $this->baseUrl = self::BASE_URL_EU;
          break;
        case 'JP':
        case 'AU':
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
    $this->appendHeader(['Amazon-Advertising-API-Scope:' . $customerId,]);
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
    if (!empty($query)) {
      $path .= '?' . http_build_query($query);
    }

    // Set the url to use for the request (creates exception for refresh token)
    $requestUrl = $this->baseUrl == self::BASE_REFRESH_TOKEN ? $this->baseUrl : $this->baseUrl . '/' . $path;

    // Set the request params
    curl_setopt($this->curlClient, CURLOPT_URL, $requestUrl);
    curl_setopt($this->curlClient, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($this->curlClient, CURLOPT_HEADER, FALSE);
    curl_setopt($this->curlClient, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($this->curlClient, CURLOPT_HTTPHEADER, $this->requestHeader);

    // Add params if any
    if (!empty($params)) {
      curl_setopt($this->curlClient, CURLOPT_POSTFIELDS, json_encode($params));
    }

    // Does the request
    $response = json_decode(curl_exec($this->curlClient));
    $httpcode = curl_getinfo($this->curlClient, CURLINFO_HTTP_CODE);
    curl_close($this->curlClient);

    // Return the response
    if ($httpcode == 200 || $httpcode == 201) {
      return $response;
    } else {
      return 'FAILURE';
      //throw new Exception($response->message);
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
   * If the given value is not an array, wrap it in one.
   *
   * @param  mixed  $value
   * @return array
   */
  private static function wrap($value) {
    return !is_array($value) ? [$value] : $value;
  }
}
