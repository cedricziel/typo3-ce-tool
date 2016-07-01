<?php

call_user_func(
    function ($extensionName) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
            'tt_content',
            'CType',
            [
                'Revolutionslider',
                'revolutionslider',
                'content-revolutionslider-ce',
            ]
        );

        if (!is_array($GLOBALS['TCA']['tt_content']['types']['revolutionslider'])) {
            $GLOBALS['TCA']['tt_content']['types']['revolutionslider'] = [];
        }

        $GLOBALS['TCA']['tt_content']['types']['revolutionslider'] = array_replace_recursive(
            $GLOBALS['TCA']['tt_content']['types']['revolutionslider'],
            [
                'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;bootstrap_package_header,
            tx_revolutionslider_slide,
            --div--;Settings,
            pi_flexform;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:advanced,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
            categories
        ',
            ]
        );

        $GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
            $GLOBALS['TCA']['tt_content']['columns'],
            [
                'tx_revolutionslider_slide' => [
                    'label'  => 'Revolutionslider: Slide',
                    'config' => [
                        'type'          => 'inline',
                        'foreign_table' => 'tx_revolutionslider_slide',
                        'foreign_field' => 'tt_content',
                        'appearance'    => [
                            'useSortable'                     => true,
                            'showSynchronizationLink'         => true,
                            'showAllLocalizationLink'         => true,
                            'showPossibleLocalizationRecords' => true,
                            'showRemovedLocalizationRecords'  => false,
                            'expandSingle'                    => true,
                            'enabledControls'                 => [
                                'localize' => true,
                            ],
                        ],
                        'behaviour'     => [
                            'localizationMode'                     => 'select',
                            'mode'                                 => 'select',
                            'localizeChildrenAtParentLocalization' => true,
                        ],
                    ],
                ],
            ]
        );
    },
    'revolutionslider'
);
