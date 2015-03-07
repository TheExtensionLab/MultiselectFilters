<?php 
/**
 * MultiselectFilters Observer Model
 *
 * @category    TheExtensionLab
 * @package     TheExtensionLab_MultiselectFilters
 * @copyright   Copyright (c) TheExtensionLab (http://www.theextensionlab.com)
 * @license     Open Software License (OSL 3.0)
 * @author      James Anelay @ TheExtensionLab <james@theextensionlab.com>
 */
class TheExtensionLab_MultiselectFilters_Model_Observer
{
    //getColumnFilters
    public function coreBlockAbstractToHtmlBefore(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();

        if ($block instanceof Mage_Adminhtml_Block_Widget_Grid) {
            $filters = array();
            $filters['options'] = "theextensionlab_multiselectfilters/adminhtml_widget_grid_column_filter_multiselect";
            $filters['country'] = "theextensionlab_multiselectfilters/adminhtml_widget_grid_column_filter_multiselect_country";
            $block->setColumnFilters($filters);
        }
    }

    public function coreBlockAbstractToHtmlAfter(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();

        if ($block instanceof Mage_Adminhtml_Block_Widget_Grid) {
            $transport = $observer->getTransport();
            //get the HTML
            $html = $transport->getHtml();

            //Get container so that js is only fired on this grid
            $uniqIdClass = 'grid-container-'.uniqid();

            //render the block
            $newHtml = $block->getLayout()->createBlock('adminhtml/template')
                ->setTemplate('theextensionlab/multiselectfilters/chosen/init-js.phtml')->setUniqId($uniqIdClass)->toHtml();

            $transport->setHtml('<div class="'.$uniqIdClass.'">'.$html.' '.$newHtml.'</div>');
        }
    }
}