<?php

namespace app\models\publications\articles\collections;

use yii\db\ActiveQuery;

/**
 * ActiveQuery class for Associations;
 *
 * @see Affilations
 */
class AssociationsQuery extends ActiveQuery
{

    /**
     * @inheritdoc
     * @return Associations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    } // end function


    /**
     * @inheritdoc
     * @return Associations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    } // end function

} // end class
