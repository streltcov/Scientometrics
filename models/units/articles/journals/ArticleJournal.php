<?php

namespace app\models\units\articles\journals;

// project classes
use app\interfaces\ArticleInterface;
use app\interfaces\UnitInterface;
use app\models\pnrd\indexes\IndexesArticles;
use app\models\units\articles\ArticlesAuthors;
use app\models\common\Languages;
use app\models\units\articles\traits\ArticleQueryTrait;
use app\models\units\articles\traits\ArticleTrait;
use app\models\units\articles\traits\SchemeTrait;
use app\models\units\articles\traits\UnitTrait;
use app\modules\Control\models\Authors;
// yii classes
use Yii;
use yii\db\ActiveRecord;

/**
 * ActiveRecord class for table "articles".
 *
 * @property int $id
 * @property int $type
 * @property string $title
 * @property string $magazine
 * @property int $number
 * @property int $direct_number
 * @property int $pages
 * @property int $year
 * @property string $language
 * @property string $doi
 * @property int $created_at
 * @property string $annotation
 * @property string $index
 * @property string $link
 * @property resource $file
 */
class ArticleJournal extends ActiveRecord implements UnitInterface
{

    use SchemeTrait;
    use UnitTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {

        return 'articles_journal';

    } // end function



    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
            [['type', 'title', 'number', 'class', 'year', 'language'], 'required'],
            [['type', 'number', 'direct_number', 'class', 'pages', 'year', 'created_at'], 'integer'],
            [['title', 'annotation', 'index', 'file'], 'string'],
            [['magazine', 'language', 'doi', 'link'], 'string', 'max' => 255],
        ];

    } // end function



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {

        return [
            'id' => 'ID',
            'type' => 'Тип',
            'class' => 'Категория ПНРД',
            'pnrdindex' => 'Индекс ПНРД',
            'title' => 'Заголовок',
            'magazine' => 'Журнал',
            'number' => 'Номер',
            'direct_number' => 'Сквозной номер',
            'pages' => 'Страницы',
            'year' => 'Год',
            'language' => 'Язык',
            'doi' => 'ЦИО',
            'created_at' => 'Created At',
            'annotation' => 'Аннотация',
            'index' => 'Полнотекстовый индекс',
            'link' => 'Ссылка',
            'file' => 'Файл',
            'authors' => 'Авторы'
        ];

    } // end function



    /**
     * GETTERS
     */


    /**
     * TODO: Complete method getUnitauthors()
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {

        return $this->hasMany(Authors::className(), ['id' => 'author_id'])
            ->viaTable('articles_authors', ['article_id' => 'id']);

    } // end function



    /**
     * returns language value for current model
     *
     * @return string
     */
    public function getLanguage()
    {

        $language = $this->hasOne(Languages::className(), ['id' => 'language']);

        return $language->language;

    } // end function



    /**
     * returns pnrd index for current article
     *
     * @return float
     */
    public function getIndex()
    {

        $current_year = date('Y');

        if (($current_year - $this->year) < 5) {
            return 0;
        }

        $base_index = IndexesArticles::find()->where(['id' => $this->class])->one();

        return $base_index->value;

    } // end function



    public function getPublicationclass()
    {
        return $this->hasOne(IndexesArticles::className(), ['id' => 'class']);
    }



    /**
     * TODO: complete
     */
    public function getAffilations()
    {

        return $this->hasMany(Affilations::classname(), ['article_id' => 'id']);
        return 'affilations';

    } // end function



    /**
     * END GETTERS
     */


    /**
     * sets flash messages using Alert widget (yii2)
     *
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {

            if ($this->isNewRecord) {
                if ($insert) {
                    Yii::$app->session->setFlash('success', 'Статья сохранена');
                    return true;
                } else {
                    Yii::$app->session->setFlash('danger', 'Сохранение не удалось');
                    return false;
                }
            } else {
                if ($insert) {
                    Yii::$app->session->setFlash('danger', 'Обновление данных не удалось');
                    return false;
                } else {
                    Yii::$app->session->setFlash('success', 'Данные обновлены');
                    return true;
                }
            }
        }

        return true;

    } // end function



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



    /**
     * @inheritdoc
     * @return ArticleJournalQuery the active query used by this AR class.
     */
    public static function find()
    {

        return new ArticleJournalQuery(get_called_class());

    } // end function

} // end class
