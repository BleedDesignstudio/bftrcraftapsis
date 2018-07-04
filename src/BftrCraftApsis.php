<?php
/**
 * Bftr Craft Apsis plugin for Craft CMS 3.x
 *
 * Integrations between Craft and Apsis
 *
 * @link      http://bleed.com/
 * @copyright Copyright (c) 2018 Kristoffer Lundberg
 */

namespace bleed\bftrcraftapsis;

use bleed\bftrcraftapsis\twigextensions\BftrCraftApsisTwigExtension;
use bleed\bftrcraftapsis\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class BftrCraftApsis
 *
 * @author    Kristoffer Lundberg
 * @package   BftrCraftApsis
 * @since     0.0.1
 *
 */
class BftrCraftApsis extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var BftrCraftApsis
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '0.0.1';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Craft::$app->view->registerTwigExtension(new BftrCraftApsisTwigExtension());

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'bftr-craft-apsis',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'bftr-craft-apsis/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
