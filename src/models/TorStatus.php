<?php

namespace voganu\tornado\models;

use voganu\tornado\admin\Module;
use luya\admin\ngrest\base\NgRestModel;

/**
 * News Category Model
 *
 * @author Basil Suter <basil@nadar.io>
 */
class TorStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
//    public $i18n = ['name'];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tor_status';
    }
    /**
     * @inheritdoc
     */
//    public function init()
//    {
//        parent::init();
//        $this->on(self::EVENT_BEFORE_DELETE, [$this, 'eventBeforeDelete']);
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function eventBeforeDelete($event)
//    {
//        if (count($this->articles) > 0) {
//            $this->addError('id', Module::t('cat_delete_error'));
//            $event->isValid = false;
//        }
//    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'название',
            'description' => 'описание',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }

}
