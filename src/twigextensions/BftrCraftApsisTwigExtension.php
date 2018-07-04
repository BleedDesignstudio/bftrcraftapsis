<?php
/**
 * Bftr Craft Apsis plugin for Craft CMS 3.x
 *
 * Integrations between Craft and Apsis
 *
 * @link      http://bleed.com/
 * @copyright Copyright (c) 2018 Kristoffer Lundberg
 */

namespace bleed\bftrcraftapsis\twigextensions;

use bleed\bftrcraftapsis\BftrCraftApsis;

use Craft;

/**
 * @author    Kristoffer Lundberg
 * @package   BftrCraftApsis
 * @since     0.0.1
 */
class BftrCraftApsisTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'BftrCraftApsis';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('apsisAddSubscriber', [$this, 'apsisAddSubscriberInternal']),
        ];
    }

    /**
     * Add subscriber to Apsis
     * http://se.apidoc.anpdm.com/Browse/Method/SubscriberService/CreateSubscriber
     * 
     * @param null $id The subscriber group ID
     * @param null $subscriber Subscriber data
     * @param null $updateIfExists Whether or not to update subscriber information if it already exists
     *
     * @return string
     */
    public function apsisAddSubscriberInternal($id = null, $subscriber = null, $updateIfExists = true)
    {
        $pluginSettings = BftrCraftApsis::$plugin->getSettings();
        $api_key = $pluginSettings['API_KEY'];
        $subscriber_data = json_encode($subscriber);

        if ($api_key == "") {
            die("No API key specified!");
        }
        else if ($id == null) {
            die("You need to specify a mailing list ID!");
        }
        else if ($subscriber == null) {
            die("You need to add subscriber data!");
        }
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://".$api_key."@se.api.anpdm.com/v1/subscribers/mailinglist/".$id."/create?updateIfExists=".$updateIfExists,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $subscriber_data,
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Cache-Control: no-cache",
                "Content-Type: application/json"
            ),
        ));
         
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            return "cURL Error #:" . $err;
        }
        else {
            return "You are now added to our mailing list. Grazie!";
        }
    }
}
