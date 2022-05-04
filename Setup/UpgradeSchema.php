<?php

namespace Mageplaza\HelloWorld\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface {

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.4.0', '<')) {
            if (!$installer->tableExists('mageplaza_helloworld_post')) {
                $table = $installer->getConnection()->newTable(
                                $installer->getTable('mageplaza_helloworld_post')
                        )
                        ->addColumn(
                                'joke_id',
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
                                'icon_url',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                255,
                                ['nullable' => false],
                                'Post Name'
                        )
                        ->addColumn(
                                'url',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                255,
                                ['nullable' => false],
                                'Post URL Key'
                        )
                        ->addColumn(
                                'value',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                '64k',
                                ['nullable' => false],
                                'Post Post Content'
                        )
                        ->addColumn(
                                'categories',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                255,
                                [],
                                'Post Tags'
                        )
                        ->addColumn(
                                'id',
                                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                1,
                                ['nullable' => false],
                                'Post Status'
                        )
                        ->addColumn(
                                'created_at',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                null,
                                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                                'Created At'
                        )->addColumn(
                                'updated_at',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                null,
                                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                                'Updated At')
                        ->setComment('Post Table');
                $installer->getConnection()->createTable($table);

                $installer->getConnection()->addIndex(
                        $installer->getTable('mageplaza_helloworld_post'),
                        $setup->getIdxName(
                                $installer->getTable('mageplaza_helloworld_post'),
                                ['icon_url', 'url', 'id', 'url', 'value'],
                                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                        ),
                        ['icon_url', 'url', 'id', 'url', 'value'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }
        }

        $installer->endSetup();
    }

}
