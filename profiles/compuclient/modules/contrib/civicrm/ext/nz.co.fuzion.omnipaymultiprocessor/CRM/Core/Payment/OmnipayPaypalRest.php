<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 5.5                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2018                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*/

use CRM_Omnipaymultiprocessor_ExtensionUtil as E;

/**
 * Class CRM_Core_Payment_PaypalRest.
 *
 * In general the OmnipayMultiProcessor class copes with vagaries of
 * payment processors. However sometime they have anomalies that
 * can't be dealt with by metadata
 *
 * Omnipay supports token payments but not recurring
 */
class CRM_Core_Payment_OmnipayPaypalRest extends CRM_Core_Payment_OmnipayMultiProcessor {

  /**
   * Do a token payment.
   *
   * We might have a token due to form tokenisation or because we are processing
   * a repeat payment against a payment token (ie this would be the case with some recurring payments).
   *
   * Currently used by:
   *
   * Authorize.net - supports javascript tokenised payments
   * Eway Rapid Shared WithClientSideEncryption - supports javascript tokenised payments
   * Eway - all forms - support tokenised recurring payments
   * Payment Express - all forms - support tokenised recurring payments
   * PaypalRest - supports javascript tokenised payments.
   *
   * @param array $params
   * @return array
   */
  protected function doTokenPayment(&$params) {
    // If it is not recurring we will have succeeded in an Authorize so we should capture.
    // The only recurring currently working with is_recur + pre-authorize is eWay rapid
    // and, at least in that case, the createCreditCard call ignores any attempt to authorise.
    // that is likely to be a pattern.
    $this->doPostApproval($params);
    $action = CRM_Utils_Array::value('payment_action', $params, empty($params['is_recur']) ? 'completePurchase' : 'purchase');
    $params['transactionReference'] = ($params['token']);
    $response = $this->gateway->$action($this->getCreditCardOptions(array_merge($params, ['cardTransactionType' => 'continuous'])))->send();
    $this->logHttpTraffic();
    if ($response->isSuccessful()) {
      $params['token'] = $response->getCardReference();
    }
    return $response;
  }

  /**
   * @param array $params
   * @return \Omnipay\Common\Message\ResponseInterface
   *
   * @throws \CRM_Core_Exception
   */
  protected function doPreApproveForRecurring($params) {
    $currency = $this->getCurrency($params);
    if (!$currency) {
      throw new CRM_Core_Exception(ts('No currency specified'));
    }

    // https://developer.paypal.com/docs/api/payments.billing-plans/v1/#definition-merchant_preferences
    /** @var \Omnipay\Paypal\Message\RestResponse $planResponse */
    $response = $this->gateway->createCard($this->getCreditCardOptions(array_merge($params, array('action' => 'Purchase')), 'contribute'))->send();
    $requests = $this->getRequestBodies();
    $responese = $this->getResponseBodies();
    if (!$response->isSuccessful()) {
      throw new CRM_Core_Exception($response->getMessage());
    }
    return $response;
  }

  /**
   * Function to action after pre-approval if supported
   *
   * @param array $params
   *   Parameters from the form
   *
   * Action to do after pre-approval. e.g. PaypalRest returns from offsite &
   * hits the billing plan url to confirm.
   *
   * @throws \CRM_Core_Exception
   */
  public function doPostApproval(&$params) {
    if (empty($params['post_authorize']) ) {
      return;
    }
    $planResponse = $this->gateway->completeCreateCard(array(
      'transactionReference' => $params['token'],
      'state' => 'ACTIVE',
    ))->send();
    if (!$planResponse->isSuccessful()) {
      throw new CRM_Core_Exception($planResponse->getMessage());
    }
    $params['token'] = $planResponse->getCardReference();
  }

}
