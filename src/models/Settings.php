<?php
/**
 * Bftr Craft Apsis plugin for Craft CMS 3.x
 *
 * Integrations between Craft and Apsis
 *
 * @link      http://bleed.com/
 * @copyright Copyright (c) 2018 Kristoffer Lundberg
 */

namespace bleed\bftrcraftapsis\models;

use bleed\bftrcraftapsis\BftrCraftApsis;

use Craft;
use craft\base\Model;

/**
 * @author    Kristoffer Lundberg
 * @package   BftrCraftApsis
 * @since     0.0.1
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $API_KEY = '';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['API_KEY', 'string'],
            ['API_KEY', 'default', 'value' => ''],
        ];
    }
}
