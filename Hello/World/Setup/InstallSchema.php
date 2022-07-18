<?php

namespace Hello\World\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
  public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
  {
    $installer = $setup;
    $installer->startSetup();
    if(!$installer->tableExists('hw_record')){
      $table = $installer->getConnection()->newTable(
        $installer->getTable('hw_record')
        )
        ->addColumn(
          'post_id',
          \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
          null,
          [
            'identity' => true,
            'nullable' => false,
            'primary' => true,
            'unsigned' => true,
          ],
          'Post ID'
          )
          ->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Post Name'
            )
            ->addColumn(
              'status',
              \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
              1,
              [],
              'Post Status'
              )
              ->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable'=> false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'Created At'
                )->addColumn(
                  'updated_at',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                   null,
                   ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                   'Updated At'
                  )
                  ->setComment('Post Table');
                  $installer->getConnection()->createTable($table);
                  $installer->getConnection()->addIndex(
                    $installer->getTable('hw_record'),
                    $setup->getIdxName(
                      $installer->getTable('hw_record'),
                    ['name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                  ),
                );
    }
    $installer->endSetup();
  }
}
