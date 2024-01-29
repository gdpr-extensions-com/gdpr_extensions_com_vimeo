<?php

namespace GdprExtensionsCom\GdprExtensionsComVimeo\ViewHelpers;

use GdprExtensionsCom\GdprExtensionsComVimeo\Domain\Repository\GdprManagerRepository;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Package\PackageManager;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class GetTwoClickSolutionsViewHelper extends AbstractViewHelper
{

    /**
     * @var GdprManagerRepository
     */
    protected $gdprManagerRepository = null;


    /**
     * @return void
     */
    public function injectGdprManagerRepository(GdprManagerRepository $gdprManagerRepository)
    {
        $this->gdprManagerRepository = $gdprManagerRepository;
    }
    public function initializeArguments()
    {


    }

    public function render()
    {
        $packageManager = GeneralUtility::makeInstance(PackageManager::class);
        $extensions = ExtensionManagementUtility::getLoadedExtensionListArray();
        $extensionNames = [];

        foreach ($extensions as $extensionKey){
            if ($packageManager->isPackageAvailable($extensionKey)) {
                $extensionName = $packageManager->getPackage($extensionKey)->getPackageMetaData()->getTitle();
                array_push($extensionNames,$extensionName);
            }
        }

        $twoClickSolutions = array_values(array_filter($extensionNames, function ($ext) {
            return str_contains($ext, '2clicksolution');
        }));

        $gdprManagers = $this->gdprManagerRepository->findAll();

        $installedTwoClickSol = [];
        foreach ($gdprManagers as $twoClickSol){
            array_push($installedTwoClickSol,$twoClickSol->getExtensionTitle());
        }

        $missingExtensions = array_diff($twoClickSolutions, $installedTwoClickSol);

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_gdprextensionscomyoutube_domain_model_gdprmanager');

        foreach ($missingExtensions as $value) {
            $queryBuilder
                ->insert('tx_gdprextensionscomyoutube_domain_model_gdprmanager')
                ->values([
                    'extension_title' => $value,
                    'heading' => '', // Default empty string
                    'content' => '', // Default empty string
                    'button_text' => '', // Default empty string
                    'enable_background_image' => 0, // Default 0
                    'background_image' => '', // Default empty string
                    'background_image_color' => '', // Default empty string
                    'button_color' => '', // Default empty string
                    'text_color' => '', // Default empty string
                    'button_shape' => '' // Default empty string
                ])
                ->execute();
        }
        $gdprManagers = $this->gdprManagerRepository->findAll()->toArray();

        $normalizedGdprManagers = [];
        foreach ($gdprManagers as $gdprManager) {
//            dd($gdprManager->_getCleanProperties());
            // Clean properties should be an associative array which can be JSON encoded.
            if (is_array($gdprManager->_getCleanProperties())) {
                $properties = $gdprManager->_getCleanProperties();

                // Get the extensionTitle and split it to extract 'vimeo'
                $extensionTitleParts = explode('-', $properties['extensionTitle']);
                $key = $extensionTitleParts[3];

                // Use 'vimeo' as the key in the normalizedGdprManagers array
                $normalizedGdprManagers[$key] = $properties;
            }
        }


        $jsonString = json_encode($normalizedGdprManagers);

        return $jsonString;
    }

}
