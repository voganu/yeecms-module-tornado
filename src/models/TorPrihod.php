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
 * @property double $rashod_summa
 * @property double $rashod_summa_proc
 * @property double $rashod_summa_total
 * @property int $procent_id
 * @property string $nakl
 * @property int $postav_id
 *
 * @property Postav $postav
 * @property Procent $procent
 */
class TorPrihod extends \yii\db\ActiveRecord
{
    public $dolg;
    public $prihod_summa_proc;
    public $prihod_summa_total;
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
            [['prihod_date', 'postav_id' ], 'required'],
//            [['postav_id'], 'unique',
//                'targetAttribute' => [ 'postav_id']],
            [['prihod_date', 'prihod_summa','rashod_summa', 'vozvrat_dolga','procent_id'], 'safe'],
            [['prihod_summa', 'rashod_summa', 'vozvrat_dolga'], 'number'],
            [['procent_id', 'postav_id'], 'integer'],
            [['nakl'], 'string', 'max' => 50],
//            [['postav_id'], 'exist', 'skipOnError' => true, 'targetClass' => Postav::class, 'targetAttribute' => ['postav_id' => 'id']],
//            [['procent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procent::class, 'targetAttribute' => ['procent_id' => 'id']],
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
            'prihod_date' => 'дата прихода',
            'prihod_summa' => 'приход',
            'prihod_summa_proc' => 'приход %',
            'prihod_summa_total' => 'приход всего',
            'rashod_summa' => 'расход',
            'procent_id' => 'процент',
            'nakl' => 'накладная',
            'vozvrat_dolga' => 'возврат долга',
            'postav_id' => 'поставщик',
            'dolg' => 'долг',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostav()
    {
        return $this->hasOne(TorPostav::class, ['id' => 'postav_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcent()
    {
        return $this->hasOne(TorProcent::class, ['id' => 'procent_id']);
    }
    public function afterFind()
    {
        parent::afterFind();
        $phpdate = strtotime( $this->prihod_date);
        $this->prihod_date = date('d/m/Y',$phpdate);
        $this->dolg = $this->prihod_summa - $this->rashod_summa;
        $this->prihod_summa_proc = $this->prihod_summa*($this->procent->name)/100;
        $this->prihod_summa_total = $this->prihod_summa + $this->prihod_summa_proc;
    }
    public function beforeSave($insert) {
        if($this->prihod_date){
            $date = \DateTime::createFromFormat('d/m/Y', $this->prihod_date);
            $this->prihod_date = $date->format('Y-m-d');
        }
        return parent::beforeSave($insert);
    }
}
