<?php

declare(strict_types=1);

namespace GdprExtensionsCom\GdprExtensionsComVimeo\Domain\Repository;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * This file is part of the "gdpr-extensions-com-vimeo-2clicksolution" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023
 */

/**
 * The repository for GdprManagers
 */
class GdprManagerRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function initializeObject()
    {
        /** @var QuerySettingsInterface $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        // Show comments from all pages
        $querySettings->setRespectStoragePage(false);

        $this->setDefaultQuerySettings($querySettings);
    }

    public function findSomethingFromCustomTable() {
        $query = $this->createQuery();
        $query->statement('SELECT * FROM tx_gdprextensionscomyoutube_domain_model_gdprmanager'); // replace 'your_table_name' with your actual table name
        return $query->execute();
    }
}
