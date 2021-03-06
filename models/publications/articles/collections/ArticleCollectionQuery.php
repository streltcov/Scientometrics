<?php

namespace app\models\publications\articles\collections;

use app\models\publications\articles\ArticleQuery;

/**
 * ActiveQuery class for ArticleCollection;
 *
 * @see ArticleCollection
 */
class ArticleCollectionQuery extends ArticleQuery
{

    /**
     * @inheritdoc
     * @return ArticleCollection[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    } // end function


    /**
     * @inheritdoc
     * @return ArticleCollection|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    } // end function

} // end class
