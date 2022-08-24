<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_files".
 *
 * @property int $id
 * @property int $post_id
 * @property string $file_name
 * @property string $creation_date
 *
 * @property Rooms $post
 */
class PostFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'file_name'], 'required'],
            [['post_id'], 'integer'],
            [['creation_date'], 'safe'],
            [['file_name'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'file_name' => 'File Name',
            'creation_date' => 'Creation Date',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'post_id']);
    }
}
