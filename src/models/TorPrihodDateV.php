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
class TorPrihodDateV extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tor_prihod_date_v';
    }

    public static function primaryKey(){
    return ['prihod_date'];
    }

    public function rules()
    {
        return [
            [['prihod_date', 'prihod_summa', 'postav_id'], 'required'],
            [['prihod_date'], 'date'],
            [['prihod_summa'], 'number'],
            [[ 'postav_id'], 'integer'],
            [['prihod_date'], 'safe'],
        ];
    }
    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prihod_date' => 'дата прихода',
            'prihod_summa' => 'приход',
            'rashod_summa' => 'расход',
            'prihod_summa_proc' => 'приход %',
            'prihod_summa_total' => 'приход всего',
            'dolg' => 'долг',
            'kassa' => 'касса',
            'terminal' => 'терминал',
            'kassaterm' => 'касса+терм',
            'vozvrat_dolga' => 'возврат долга',
        ];
    }
    public function afterFind()
    {
        parent::afterFind();
        $date = \DateTime::createFromFormat('Y-m-d', $this->prihod_date);
        $this->prihod_date = $date->format('d/m/Y');
    }
}
