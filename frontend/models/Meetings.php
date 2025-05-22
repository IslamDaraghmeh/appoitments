<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "meetings".
 *
 * @property int $id
 * @property string $title
 * @property string $location
 * @property string|null $url
 * @property string $meeting_date
 * @property string $meeting_time
 * @property string $created_at
 * @property int $created_by
 */
class Meetings extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meetings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'default', 'value' => null],
            [['title', 'location', 'meeting_date', 'created_by'], 'required'],
            [['url'], 'string'],
            [['meeting_date', 'meeting_time', 'created_at'], 'safe'],
            [['created_by'], 'integer'],
            [['title', 'location'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'location' => 'Location',
            'url' => 'Url',
            'meeting_date' => 'Meeting Date',
            'meeting_time' => 'Meeting Time',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

}
