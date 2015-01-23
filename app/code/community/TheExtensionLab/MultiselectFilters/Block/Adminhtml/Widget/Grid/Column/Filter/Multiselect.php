<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2014 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Select grid column filter
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class TheExtensionLab_MultiselectFilters_Block_Adminhtml_Widget_Grid_Column_Filter_Multiselect extends Mage_Adminhtml_Block_Widget_Grid_Column_Filter_Abstract
{
    protected function _getOptions()
    {
        $optionGroups = $this->getColumn()->getOptionGroups();
        if ($optionGroups) {
            array_unshift($optionGroups, $emptyOption);
            return $optionGroups;
        }

        $colOptions = $this->getColumn()->getOptions();
        if (!empty($colOptions) && is_array($colOptions) ) {
            foreach ($colOptions as $value => $label) {
                $options[] = array('value' => $value, 'label' => $label);
            }
            return $options;
        }
        return array();
    }

    /**
     * Render an option with selected value
     *
     * @param array $option
     * @param string $value
     * @return string
     */
    protected function _renderOption($option, $values)
    {
        $explodedValues = explode(',',$values);
        $selected = ((in_array($option['value'], $explodedValues) && (!is_null($explodedValues)) && ($values != "")) ? ' selected="selected"' : '' );
        return '<option value="'. $this->escapeHtml($option['value']).'"'.$selected.'>'.$this->escapeHtml($option['label']).'</option>';
    }

    public function getHtml()
    {
        $values = $this->getValue();
        $html = '<select name="'.$this->_getHtmlName().'" id="'.$this->_getHtmlId().'" class="no-changes" data-placeholder="'.$this->__('Click here to filter').'" multiple>';

        foreach ($this->_getOptions() as $option){
            if (is_array($option['value'])) {
                $html .= '<optgroup label="' . $this->escapeHtml($option['label']) . '">';
                foreach ($option['value'] as $subOption) {
                    $html .= $this->_renderOption($subOption, $values);
                }
                $html .= '</optgroup>';
            } else {
                $html .= $this->_renderOption($option, $values);
            }
        }
        $html.='</select>';
        return $html;
    }

    public function getCondition()
    {
        if (is_null($this->getValue())) {
            return null;
        }

        $values = explode(",",$this->getValue());
        return array('in' => $values);
    }

}
