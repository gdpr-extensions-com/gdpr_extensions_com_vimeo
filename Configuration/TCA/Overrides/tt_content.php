<?php
defined('TYPO3') || die();

$frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GdprExtensionsComVimeo',
    'Gdprvimeo',
    'Vimeo'
);

$fields = [
    'gdpr_vm_url' => [
        'exclude' => true,
        'label' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vid_url',
        'description' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vid_url.description',
        'config' => [
            'type' => 'input',
            'renderType' => 'inputLink',
            'eval' => 'required'
        ]
    ],

    'gdpr_vm_options' => [
        'exclude' => true,
        'label' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vid_options',
        'description' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vid_options.description',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['-- Label --', 0],
            ],
            'size' => 1,
            'maxitems' => 1,
            'eval' => ''
        ],
    ],
    'gdpr_vm_start_time' => [
        'exclude' => true,
        'label' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vid_start_time',
        'description' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vid_start_time.description',
        'config' => [
            'type' => 'input',
            'renderType' => 'inputDateTime',
            'dbType' => 'time',
            'size' => 4,
            'eval' => 'time,int',
            'default' => null
        ]

    ],
    'gdpr_vm_end_time' => [
        'exclude' => true,
        'label' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vid_end_time',
        'description' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vid_end_time.description',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],

    'gdpr_vm_autoplay' => [
        'exclude' => true,
        'label' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vm_autoplay',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [0 => '', 1 => '']
            ],
        ],
    ],
    'gdpr_vm_show_captions' => [
        'exclude' => true,
        'label' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vm_show_captions',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',

        ],
    ],
    'gdpr_vm_disable_annotations' => [
        'exclude' => true,
        'label' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vm_disable_annotations',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [0 => '', 1 => '']
            ],
        ],
    ],
    'gdpr_vm_disable_keyboard' => [
        'exclude' => true,
        'label' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vm_disable_keyboard',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [0 => '', 1 => '']
            ],
        ],
    ],
    'gdpr_vm_display_fs' => [
        'exclude' => true,
        'label' => 'LLL:EXT:gdpr_extensions_com_vimeo/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_vimeo_gdprvimeo.gdpr_vm_display_fs',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [0 => '', 1 => '']
            ],
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $fields);

$GLOBALS['TCA']['tt_content']['types']['gdprextensionscomvimeo_gdprvimeo'] = [
    'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                gdpr_vm_url,
                gdpr_vm_review_image,
                gdpr_vm_autoplay,
                gdpr_vm_show_captions,
                gdpr_vm_disable_annotations,
                gdpr_vm_disable_keyboard,
                gdpr_vm_display_fs,
                --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
                --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        ',
];
