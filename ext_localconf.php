<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'GdprExtensionsComVimeo',
        'Gdprvimeo',
        [
            \GdprExtensionsCom\GdprExtensionsComVimeo\Controller\GdprVimeoController::class => 'index'
        ],
        // non-cacheable actions
        [
            \GdprExtensionsCom\GdprExtensionsComVimeo\Controller\GdprVimeoController::class => '',
            \GdprExtensionsCom\GdprExtensionsComVimeo\Controller\GdprManagerController::class => 'create, update, delete'
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    // register plugin for cookie widget
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'GDPRExtensionsComVimeo',
        'Gdprcookiewidget',
        [
            \GdprExtensionsCom\GdprExtensionsComVimeo\Controller\GdprCookieWidgetController::class => 'index'
        ],
        // non-cacheable actions
        [],
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    gdprcookiewidget {
                        iconIdentifier = gdpr_extensions_com_vimeo-plugin-gdprvimeo
                        title = cookie
                        description = LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.description
                        tt_content_defValues {
                            CType = list
                            list_type = gdprextensionscomvimeo_gdprcookiewidget
                        }
                    }
                }
                show = *
            }
       }'
    );
    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.common {
                elements {
                    gdprvimeo {
                        iconIdentifier = gdpr_extensions_com_vimeo-plugin-gdprvimeo
                        title = LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.name
                        description = LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.description
                        tt_content_defValues {
                            CType = gdprextensionscomvimeo_gdprvimeo
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
