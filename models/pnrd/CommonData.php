<?php

namespace app\models\pnrd;

// project classes
use app\models\identity\Users;
use app\models\opendata\Data;
use app\models\pnrd\facades\Indexes;
use app\models\publications\articles\journals\ArticleJournal;
use app\models\publications\articles\collections\ArticleCollection;
use app\models\publications\articles\conferences\ArticleConference;
use app\models\publications\dissertations\Dissertations;
use app\models\identity\Personnel;

/**
 * Class CommonData
 * Provides methods for collecting data on published articles, dissertations etc.
 *
 * @since 0.4.60
 * @package app\models\pnrd
 */
class CommonData
{

    public $users;
    public $authors;
    public $employees;
    public $articles;
    public $dissertations;

    public function __construct()
    {

        $this->users = Users::find();
        $this->employees = Personnel::find();

        $this->articles = new \stdClass();
        $this->articles->journals = ArticleJournal::find();
        $this->articles->collections = ArticleCollection::find();
        $this->articles->conferency = ArticleConference::find();
        $this->dissertations = Dissertations::find();

    } // end construct



    /**
     * calculates total index for publications associated with organisation
     *
     * @return int
     */
    public static function total()
    {

        $index = new Indexes(new Units());
        return (int)$index->total();

    } // end function


    /**
     * COUNTERS
     */


    /**
     * Counts all published articles
     *
     * @return integer
     */
    public function countArticles()
    {

        return count(Data::getArticles());

    } // end function



    /**
     * @return mixed
     */
    public function countArticlesCollection()
    {

        return $this->articles->collections->count();

    } // end function




    /**
     * Counts all added dissertations
     *
     * @return integer
     */
    public function countDissertations()
    {

        return $this->dissertations->count();

    } // end function

    /**
     * ENDCOUNTERS
     */


} // end class
