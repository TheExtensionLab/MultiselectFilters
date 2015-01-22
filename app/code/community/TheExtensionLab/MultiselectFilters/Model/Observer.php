<?php class TheExtensionLab_MultiselectFilters_Model_Observer
{
    //getColumnFilters
    public function coreBlockAbstractToHtmlBefore(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();

        if ($block instanceof Mage_Adminhtml_Block_Widget_Grid) {
            $filters = array();
            $filters['options'] = "theextensionlab_multiselectfilters/adminhtml_widget_grid_column_filter_multiselect";
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

            //render the block
            $newHtml = $block->getLayout()->createBlock('adminhtml/template')
                ->setTemplate('theextensionlab/multiselectfilters/chosen/init-js.phtml')->toHtml();

            $transport->setHtml($html.' '.$newHtml);
        }
    }
}