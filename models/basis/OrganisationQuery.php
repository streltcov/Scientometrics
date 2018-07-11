<?php

namespace app\models\basis;

/**
 * This is the ActiveQuery class for [[Organisation]].
 *
 * @see Organisation
 */
class OrganisationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Organisation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Organisation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}