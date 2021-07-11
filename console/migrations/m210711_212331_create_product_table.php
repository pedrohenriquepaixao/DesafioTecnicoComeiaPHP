<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m210711_212331_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull(),
            'quantity' => $this->integer()->defaultValue(0),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-product-created_by', '{{%product}}', 'created_by');
        $this->addForeignKey('fk-product-created_by', '{{%product}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-product-updated_by', 'product', 'updated_by');
        $this->addForeignKey('fk-product-updated_by', '{{%product}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
