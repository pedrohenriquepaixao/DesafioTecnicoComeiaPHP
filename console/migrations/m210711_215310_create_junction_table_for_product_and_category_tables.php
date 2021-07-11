<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_category}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 * - `{{%category}}`
 */
class m210711_215310_create_junction_table_for_product_and_category_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_category}}', [
            'product_id' => $this->integer(),
            'category_id' => $this->integer(),
            'PRIMARY KEY(product_id, category_id)',
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-product_category-product_id}}',
            '{{%product_category}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-product_category-product_id}}',
            '{{%product_category}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-product_category-category_id}}',
            '{{%product_category}}',
            'category_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-product_category-category_id}}',
            '{{%product_category}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_category}}');
    }
}
