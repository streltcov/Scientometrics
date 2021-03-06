<?php

namespace app\models\publications\articles\collections;

use yii\db\ActiveQuery;

/**
 * ActiveQuery class for ArticlesCitations;
 *
 * @see ArticlesCitations
 */
class CitationsQuery extends ActiveQuery
{

    /**
     * @inheritdoc
     * @return Citations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    } // end function


    /**
     * @inheritdoc
     * @return Citations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    } // end function

} // end class
