<?php
/**
 * @file
 * This file provides a small extension over the Summon.class.php available from Serials Solutions.
 * Much of the code here derives from that file either being used as a reference, or copied nearly verbatim.
 *
 */

if (module_load_include('php', 'article_discovery', 'Summon.class'))  {
  class SummonClient extends Summon {
    public $version;
    public function __construct($apiId, $apiKey) {
      $this->version = '2.0.0';
      return parent::__construct($apiId, $apiKey);
    }
    public function session($sessionId = NULL) {
      if (!is_null($sessionId)) {
        $this->sessionId = $sessionId;
      }
      return $this->sessionId;
    }
    public function query($queries = NULL, $facets = NULL, $filter = NULL, $start = 1, $limit = 20, $sort = NULL, $options = NULL) {
      //We want to check all the inputs and go from there.
      if (is_null($options) || !is_array($options)) {
        $options = array();
      }
      if (!is_null($queries)) {
        $options['s.q'] = $queries;
      }
      if (!is_null($facets)) {
        $options['s.ff'] = $facets;
      }
      if (!is_null($filter)) {
        $options['s.fq'] = $filter;
      }
      if (!is_null($sort)) {
        $options['s.sort'] = $sort;
      }
      $options['s.ps'] = $limit;
      $options['s.pn'] = $start;

      //And now for checking on defaults.
      if (!isset($options['s.ho'])) {
        $options['s.ho'] = 'true';
      }
      elseif ($options['s.ho'] == FALSE || $options['s.ho'] == 'false' || $options['s.ho'] == 'f') {
        unset($options['s.ho']);
      }
      if (!isset($options['s.hl'])) {
        $options['s.hl'] = 'false';
      }
      $options['s.debug'] = 'false';

      $result = $this->call($options);
      if (@PEAR::isError($result)) {
        PEAR::raiseError($result);
      }
      return $result;

    }

    //This is replicated from the base class.
    private function call($params = array(), $service = 'search', $method = 'POST', $raw = FALSE) {
      $this->client->setURL($this->host . "/{$this->version}/" . $service);
      $this->client->setMethod('GET');

      // Build Query String
      $query = array();
      foreach ($params as $function => $value) {
        if (is_array($value)) {
          foreach ($value as $additional) {
            $additional = urlencode($additional);
            $query[] = "$function=$additional";
          }
        }
        else {
          $value = urlencode($value);
          $query[] = "$function=$value";
        }
      }
      asort($query);
      $queryString = implode('&', $query);
      $this->client->addRawQueryString($queryString);
      // Build Authorization Headers
      $headers = array(
        'Accept' => 'application/json',
        'x-summon-date' => date('D, d M Y H:i:s T'),
        'Host' => 'api.summon.serialssolutions.com'
      );
      $data = implode($headers, "\n") . "\n/{$this->version}/$service\n" . urldecode($queryString) . "\n";
      $hmacHash = $this->hmacsha1($this->apiKey, $data);
      foreach ($headers as $key => $value) {
        $this->client->addHeader($key, $value);
      }
      $this->client->addHeader('Authorization', "Summon $this->apiId;$hmacHash");
      if ($this->sessionId) {
        $this->client->addHeader('x-summon-session-id', $this->sessionId);
      }
      // Send Request
      $result = @$this->client->sendRequest($service);
      if (!@PEAR::isError($result)) {
        return $this->_process($this->client->getResponseBody());
      }
      else {
        return $result;
      }
    }
    //Also largely gathered from the reference API:
    function _process($result) {
      // Unpack JSON Data
      if ($result = json_decode($result)) {
        // Catch errors from Summon
        if (!$result) {
          PEAR::raiseError(new PEAR_Error('Unable to process query<br />Server Returned:' . $errorMsg));
        }
      }
      else {
        return NULL;
      }

      return $result;
    }


    /* Someday we may want to access the availability API */
    public function availability($token) {
      return NULL;
    }
  }
}
else {
  watchdog(
    'article_discovery',
    'Unable to load Summon API library, see: @url',
    array('@url' => 'http://api.summon.serialssolutions.com/help/api/code'),
    WATCHDOG_ERROR,
    NULL
  );
  drupal_set_message(t('Failed to load Summon API library, see: http://api.summon.serialssolutions.com/help/api/code.'), 'error', FALSE);
}
