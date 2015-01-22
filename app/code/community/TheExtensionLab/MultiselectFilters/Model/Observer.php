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
}