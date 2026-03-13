<?php

/**
 * Blutic Cookie Consent System Plugin
 *
 * @package     Joomla.Plugin
 * @subpackage  System.bluticconsent
 * @author      Blutic Team
 * @copyright   Copyright (C) 2024 Blutic Team. All rights reserved.
 * @license     GPL v2 or later
 * @since       1.0.0
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

/**
 * System plugin for Blutic Cookie Consent Banner
 *
 * @since  1.0.0
 */
class PlgSystemBluticconsent extends CMSPlugin
{
    /**
     * Application object
     *
     * @var    \Joomla\CMS\Application\CMSApplication
     * @since  1.0.0
     */
    protected $app;

    /**
     * Adds the Blutic cookie consent script to the document head
     *
     * @return  void
     *
     * @since   1.0.0
     */
    public function onBeforeCompileHead()
    {
        $this->app = Factory::getApplication();

        // Only inject on the site frontend, not administrator
        if (!$this->app->isClient('site') || !$this->params->get('enabled', 1)) {
            $this->logMessage('Blutic Consent: Plugin disabled or not on frontend', 'info');
            return;
        }

        $domainId = $this->params->get('domain_id', '');

        // Validate domain ID
        if (empty($domainId) || !is_string($domainId)) {
            $this->logMessage('Blutic Consent: Domain ID is missing or invalid', 'error');
            return;
        }

        // Sanitize the domain ID to prevent XSS
        $domainId = htmlspecialchars(trim($domainId), ENT_QUOTES, 'UTF-8');

        if (empty($domainId)) {
            $this->logMessage('Blutic Consent: Domain ID is empty after sanitization', 'error');
            return;
        }

        $doc = Factory::getDocument();

        // Check if document is HTML type
        if ($doc->getType() !== 'html') {
            $this->logMessage('Blutic Consent: Document is not HTML type, skipping script injection', 'info');
            return;
        }

        try {
            // Build the script URL
            $scriptUrl = 'https://d18adlsf7yn9zn.cloudfront.net/blutic-cookie/banner-sdk.js?domainId=' . $domainId . '&plugin=joomla';

            // Add the script to document head
            $doc->addScript($scriptUrl, ['async' => true], ['async' => 'async']);

            $this->logMessage('Blutic Consent: Successfully added consent banner script for domain: ' . $domainId, 'success');
        } catch (Exception $e) {
            $this->logMessage('Blutic Consent: Failed to add script - ' . $e->getMessage(), 'error');
        }
    }

    /**
     * Log messages to console and/or Joomla log
     *
     * @param   string  $message  The message to log
     * @param   string  $type     The message type (success, error, info)
     *
     * @return  void
     *
     * @since   1.0.0
     */
    private function logMessage($message, $type = 'info')
    {
        // Log to Joomla system log
        if ($this->app) {
            switch ($type) {
                case 'error':
                    $this->app->enqueueMessage($message, 'error');
                    break;
                case 'success':
                    $this->app->enqueueMessage($message, 'success');
                    break;
                default:
                    $this->app->enqueueMessage($message, 'info');
                    break;
            }
        }

        // Add console logging for debug purposes
        if ($this->app && $this->app->get('debug')) {
            $doc = Factory::getDocument();
            if ($doc && $doc->getType() === 'html') {
                $consoleType = $type === 'error' ? 'error' : ($type === 'success' ? 'log' : 'info');
                $consoleScript = "console.{$consoleType}('" . addslashes($message) . "');";
                $doc->addScriptDeclaration($consoleScript);
            }
        }
    }
}
