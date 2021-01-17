<?php

namespace kouosl\notetaking\models;

use Yii;
//use Yii

/**
 * This is the model class for table "notetaking_notes".
 *
 * @property int $user_id
 * @property int $id
 * @property string $title
 * @property string $content
 *
 * @property NotetakingKeywords[] $notetakingKeywords
 * @property User $user
 */
class NotetakingNotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notetaking_notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','status'], 'required'],
            [['user_id', 'id'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['user_id', 'id'], 'unique', 'targetAttribute' => ['user_id', 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'status'=>'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotetakingKeywords()
    {
        return $this->hasMany(NotetakingKeywords::className(), ['not_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
