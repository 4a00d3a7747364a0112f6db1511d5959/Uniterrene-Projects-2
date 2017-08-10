<?php
/**
 * Adds Thumbnail Image back to category entities
 */

$this->startSetup();

$attributes = array(
    'thumbnail' => array(
        'type'       => 'varchar',
        'label'      => 'Thumbnail Image',
        'input'      => 'image',
        'backend'    => 'catalog/category_attribute_backend_image',
        'required'   => false,
        'sort_order' => 5,
        'global'     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'group'      => 'General Information',
    ),
);

foreach ($attributes as $code => $data) {
    $this->addAttribute(Mage_Catalog_Model_Category::ENTITY, $code, $data);
}

$this->endSetup();

