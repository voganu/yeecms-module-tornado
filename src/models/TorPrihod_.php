<?php

namespace voganu\tornado\models;

//use voganu\tornado\models\Postav;
//use voganu\tornado\models\Procent;
use Yii;

/**
 * This is the model class for table "tor_prihod".
 *
 * @property int $id
 * @property string $prihod_date
 * @property double $prihod_summa
 * @property int $procent_id
 * @property string $nakl
 * @property int $postav_id
 *
 * @property Postav $postav
 * @property Procent $procent
 */
class TorPrihod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tor_prihod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['prihod_date', 'prihod_summa', 'rashod_summa', 'procent_id'], 'required'],
            [['prihod_date', 'prihod_summa', 'rashod_summa', 'procent_id', 'nakl', 'postav_id'], 'safe'],
//            [['prihod_summa'], 'number'],
//            [['procent_id', 'postav_id'], 'integer'],
//            [['nakl'], 'string', 'max' => 50],
//            [['postav_id'], 'exist', 'skipOnError' => true, 'targetClass' => Postav::class, 'targetAttribute' => ['postav_id' => 'id']],
//            [['procent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procent::class, 'targetAttribute' => ['procent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prihod_date' => 'Prihod Date',
            'prihod_summa' => 'Prihod Summa',
            'procent_id' => 'Procent ID',
            'nakl' => 'Nakl',
            'postav_id' => 'Postav ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostav()
    {
        return $this->hasOne(Postav::class, ['id' => 'postav_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcent()
    {
        return $this->hasOne(Procent::class, ['id' => 'procent_id']);
    }
//    public function getRashod()
//    {
//        return $this->hasMany(Rashod::class, ['postav_id' => 'postav_id']);
//    }
    public function afterFind()
    {
        parent::afterFind();
        $phpdate = strtotime( $this->prihod_date);
        $this->prihod_date = date('d/m/Y',$phpdate);
    }
    public function beforeSave($insert) {
        if($this->prihod_date){
            $date = \DateTime::createFromFormat('d/m/Y', $this->prihod_date);
            $this->prihod_date = $date->format('Y-m-d');
        }
        return parent::beforeSave($insert);
    }
}
