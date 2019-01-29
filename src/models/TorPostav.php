<?php

namespace voganu\tornado\models;

use Yii;

class TorPostav extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tor_postav';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name' ], 'required'],
            [['name', 'description', 'status_id'], 'safe'],
        ];
    }

//custom function
//    public function unic($attribute_name,$params)
//    {
//        if(!empty($this->postav_id) && !empty($this->prihod_date))
//        {
//            $this->addError($attribute_name,
//                'За эту дату и этому поставщику данные уже занесены');
//        }
//    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'имя',
            'description' => 'описание',
            'status_id' => 'статус',
        ];
    }
    public function getStatus()
    {
        return $this->hasOne(TorStatus::class, ['id' => 'status_id']);
    }

}
