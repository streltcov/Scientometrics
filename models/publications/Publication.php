<?php

namespace app\models\publications;

// project classes
use app\interfaces\PublicationInterface;
use app\models\common\Languages;
use app\models\publications\traits\PublicationTrait;
use app\models\publications\traits\SchemeTrait;
// yii classes
use Yii;
use yii\db\ActiveRecord;

/**
 * Class Publication
 * Basic ActiveRecord class for publication models;
 * All other publication models MUST extend current class;
 */
class Publication extends ActiveRecord implements PublicationInterface
{

    // traits
    use PublicationTrait;
    use SchemeTrait;

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return parent::attributeLabels(); // TODO: Change the autogenerated stub
    } // end function


    /**
     * sets flash messages using Alert widget (yii2)
     *
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if ($this->isNewRecord) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Статья сохранена');
                return true;
            } else {
                Yii::$app->session->setFlash('danger', 'Сохранение не удалось');
                return false;
            }
        }

        return true;
    } // end function


    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // saving language
        $newlanguage = new Languages();
        $newlanguage->language = strtolower($this->language);
        $newlanguage->save();
    } // end function


    /**
     * uses SchemeTrait deleteLinkedData() method
     *
     * @inheritdoc
     */
    public function afterDelete()
    {
        parent::afterDelete();
        $this->deleteLinkedData();
    } // end function

} // end class
