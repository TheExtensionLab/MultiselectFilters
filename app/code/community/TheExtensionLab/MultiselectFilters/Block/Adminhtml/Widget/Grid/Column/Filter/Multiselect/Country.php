<?php
/**
 * Country Select Block
 *
 * @category    TheExtensionLab
 * @package     TheExtensionLab_MultiselectFilters
 * @copyright   Copyright (c) TheExtensionLab (http://www.theextensionlab.com)
 * @license     Open Software License (OSL 3.0)
 * @author      James Anelay @ TheExtensionLab <james@theextensionlab.com>
 */
class TheExtensionLab_MultiselectFilters_Block_Adminhtml_Widget_Grid_Column_Filter_Multiselect_Country
    extends TheExtensionLab_MultiselectFilters_Block_Adminhtml_Widget_Grid_Column_Filter_Multiselect
{
    protected function _getOptions()
    {
        $options = Mage::getResourceModel('directory/country_collection')->load()->toOptionArray(false);
        array_unshift($options, array('value'=>'', 'label'=>Mage::helper('cms')->__('All Countries')));
        return $options;
    }
}
