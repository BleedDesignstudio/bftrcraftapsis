<?php
/**
 * Bftr Craft Apsis plugin for Craft CMS 3.x
 *
 * Integrations between Craft and Apsis
 *
 * @link      http://bleed.com/
 * @copyright Copyright (c) 2018 Kristoffer Lundberg
 */

namespace bleed\bftrcraftapsis\assetbundles\BftrCraftApsis;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Kristoffer Lundberg
 * @package   BftrCraftApsis
 * @since     0.0.1
 */
class BftrCraftApsisAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@bleed/bftrcraftapsis/assetbundles/bftrcraftapsis/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/BftrCraftApsis.js',
        ];

        $this->css = [
            'css/BftrCraftApsis.css',
        ];

        parent::init();
    }
}
