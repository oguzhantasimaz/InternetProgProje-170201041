<?php

namespace kouosl\notetaking\models;

use Yii;
//use

/**
 * This is the model class for table "notetaking_keywords".
 *
 * @property string $not_id
 * @property string $key
 *
 * @property NotetakingNotes $not
 */
class NotetakingKeywords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notetaking_keywords';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['not_id', 'key'], 'required'],
            [['not_id'], 'integer'],
            [['key'], 'string', 'max' => 255],
            [['not_id', 'key'], 'unique', 'targetAttribute' => ['not_id', 'key']],
            [['not_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotetakingNotes::className(), 'targetAttribute' => ['not_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'not_id' => 'Not ID',
            'key' => 'Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNot()
    {
        return $this->hasOne(NotetakingNotes::className(), ['id' => 'not_id']);
    }
}
