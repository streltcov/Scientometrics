<?php

namespace app\models\pnrd\facades;

// project classes
use app\models\pnrd\Units;
// yii classes
use yii\web\IdentityInterface;

/**
 * Class Indexes
 *
 * @package app\models\pnrd\facades
 */
class Indexes
{

    /**
     * @var \app\models\units\articles\journals\ArticleJournalQuery
     */
    private $journals;
    /**
     * @var \app\models\units\articles\conferencies\ArticleConferencyQuery
     */
    private $conference;
    /**
     * @var \app\models\units\articles\collections\ArticleCollectionQuery
     */
    private $collections;
    /**
     * @var \app\models\units\dissertations\DissertationTypesQuery
     */
    private $dissertations;

    public function __construct(Units $units)
    {

        $this->journals = $units->articlesJournals();
        $this->conference = $units->articlesConferences();
        $this->collections = $units->articlesCollections();
        $this->dissertations = $units->dissertations();

    } // end constructor



    /**
     * @param IdentityInterface $user
     */
    public function personal(IdentityInterface $user)
    {

    } // end function



    /**
     * calculates total PNRD index for all registered publications
     *
     * @return float
     */
    public function total()
    {

        $index = [];

        $journals = $this->journals->all();
        $conferencies = $this->conference->all();
        $collections = $this->collections->all();
        $dissertations = $this->dissertations->all();

        foreach ($journals as $journal) {
            $index[] = $journal->index();
        }

        foreach ($conferencies as $conference) {
            $index[] = $conference->index();
        }

        foreach ($collections as $collection) {
            $index[] = $collection->index();
        }

        foreach ($dissertations as $dissertation) {
            $index[] = $dissertation->index();
        }

        return (float)array_sum($index);

    } // end function

} // end class