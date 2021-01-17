<?php

use yii\db\Migration;

class m191227_010918_notetable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    
        $this->createTable('notetaking_notes', [
            'id' => "bigint(20) unsigned NOT NULL AUTO_INCREMENT",
            'user_id'=>$this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'status'=>$this->boolean(),
            "PRIMARY KEY (`id`,`user_id`)",
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        
        
        $this->addForeignKey(
            'fk-notetaking_notes_user_id',
            'notetaking_notes',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createTable('notetaking_keywords', [
            'not_id'=>"bigint(20) unsigned NOT NULL",
            'key' => $this->string()->notNull(),
            "PRIMARY KEY (`not_id`,`key`)",
    
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        
        
       $this->addForeignKey(
        'fk-notetaking_keywords_not_id',
        'notetaking_keywords',
        'not_id',
        'notetaking_notes',
        'id',
        'CASCADE'
    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-notetaking_notes_user_id',
            'notetaking_notes'
        );
        $this->dropForeignKey(
            'fk-notetaking_keywords_not_id',
            'notetaking_keywords'
        );
        $this->dropTable('notetaking_notes');
        $this->dropTable('notetaking_keywords');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191227_010918_notetable cannot be reverted.\n";

        return false;
    }
    */
}
