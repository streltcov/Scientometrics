<?php

namespace app\modules\Control\modules\Admin\controllers;

// project classes
use app\models\common\Languages;
// yii classes
use app\models\common\Magazines;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Class LanguagesController
 *
 * @package app\modules\Control\modules\Admin\controllers
 */
class DataController extends Controller
{

    /**
     * @return string
     */
    public function actionLanguages()
    {

        $languages = new ActiveDataProvider([
            'query' => Languages::find()
        ]);
        return $this->renderAjax('languages', [
            'languages' => $languages,
        ]);

    } // end action



    public function actionAddlanguage()
    {
        $language = new Languages();

        if ($language->load(\Yii::$app->request->post()) && $language->save()) {
            $languages = new ActiveDataProvider([
                'query' => Languages::find()
            ]);
            return $this->redirect(['data/addlanguage']);
            /*return $this->renderAjax('languages', [
                'languages' => $languages
            ]);*/
        }
        return $this->renderAjax('languages_add', [
            'language' => $language
        ]);
    }



    /**
     *
     */
    public function actionMagazines()
    {

        $magazines = new ActiveDataProvider([
            'query' => Magazines::find()
        ]);
        return $this->renderAjax('magazines', [
            'model' => $magazines
        ]);

    } // end action

} // end class
