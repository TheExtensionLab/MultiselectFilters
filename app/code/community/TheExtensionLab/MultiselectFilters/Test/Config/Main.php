<?php class TheExtensionLab_MultiselectFilters_Test_Config_Main extends EcomDev_PHPUnit_Test_Case_Config
{
    public function testClassAsliases()
    {
        $this->assertModelAlias('theextensionlab_multiselectfilters/observer','TheExtensionLab_MultiselectFilters_Model_Observer');
        $this->assertBlockAlias('theextensionlab_multiselectfilters/example','TheExtensionLab_MultiselectFilters_Block_Example');
    }

    public function testObserverConfig()
    {
        $this->assertEventObserverDefined(
            'adminhtml',
            'core_block_abstract_to_html_before',
            'theextensionlab_multiselectfilters/observer',
            'coreBlockAbstractToHtmlBefore'
        );
    }

    public function testLayoutConfig()
    {
        $this->assertLayoutFileDefined('adminhtml','theextensionlab/multiselectfilters.xml');
        $this->assertLayoutFileExists('adminhtml','theextensionlab/multiselectfilters.xml');
    }
}