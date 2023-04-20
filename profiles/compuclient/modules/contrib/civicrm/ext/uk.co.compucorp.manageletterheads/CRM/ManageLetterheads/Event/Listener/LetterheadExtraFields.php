<?php

use Civi\API\Event\RespondEvent;

/**
 * Listener class for adding Extra/derived fields to the letterhead entity.
 */
class CRM_ManageLetterheads_Event_Listener_LetterheadExtraFields {

  /**
   * Runs when the letterhead result set is returned.
   *
   * The function addss the derived fields for the letterhead entity
   * such as `available_for` if necessary.
   *
   * @param \Civi\API\Event\RespondEvent $event
   *   API Respond Event Object.
   */
  public static function onRespond(RespondEvent $event) {
    $apiRequest = $event->getApiRequest();

    if ($apiRequest['version'] != 3) {
      return;
    }

    if (!self::shouldRun($apiRequest)) {
      return;
    }

    $responseParams = $event->getResponse();
    self::addAvailableForField($apiRequest, $responseParams);
    $event->setResponse($responseParams);

  }

  /**
   * If available for fielddata should be added or not.
   *
   * @param array $apiRequest
   *   API request array.
   *
   * @return bool
   *   If available for fielddata should be added or not.
   */
  private static function shouldAddAvailableFor($apiRequest) {
    $options = _civicrm_api3_get_options_from_params($apiRequest['params']);
    $returnParams = array_keys($options['return']);

    return empty($returnParams) || !empty($returnParams['available_for']);
  }

  /**
   * Add the Available For Data for each letterhead.
   *
   * @param array $apiRequest
   *   API request.
   * @param array $responseParams
   *   API response parameters.
   */
  private static function addAvailableForField($apiRequest, &$responseParams) {
    if (!self::shouldAddAvailableFor($apiRequest)) {
      return;
    }
    foreach ($responseParams['values'] as $key => $value) {
      $result = civicrm_api3('LetterheadAvailability', 'get', ['letterhead_id' => $value['id']]);
      $responseParams['values'][$key]['available_for'] = array_column($result['values'], 'available_for');
    }
  }

  /**
   * Determines if the processing will run.
   *
   * @param array $apiRequest
   *   Api request data.
   *
   * @return bool
   *   TRUE if processing should run, FALSE otherwise.
   */
  protected static function shouldRun(array $apiRequest) {
    return $apiRequest['entity'] == 'Letterhead' && $apiRequest['action'] == 'get';
  }

}
