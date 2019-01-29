<?php

namespace voganu\tornado\models;

use voganu\tornado\admin\Module;
use luya\admin\ngrest\base\NgRestModel;

/**
 * News Category Model
 *
 * @author Basil Suter <basil@nadar.io>
 */
class Procent extends NgRestModel
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
        return 'tor_procent';
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
            'name' => Module::t('name'),
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

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-tornado-procent';
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'name' => 'text',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            [['list', 'create', 'update'], ['name']],
            [['delete'], true],
        ];
    }
    
    /**
     * Get articles for this category.
     */
//    public function getArticles()
//    {
//        return $this->hasMany(Article::class, ['cat_id' => 'id']);
//    }
//
//    public function ngRestRelations()
//    {
//        return [
//           ['label' => 'Articles', 'apiEndpoint' => Article::ngRestApiEndpoint(), 'dataProvider' => $this->getArticles()],
//        ];
//    }
}
