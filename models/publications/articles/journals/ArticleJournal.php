<?php

namespace app\models\publications\articles\journals;

// project classes
use app\models\common\Languages;
use app\models\publications\articles\Article;
// yii classes
use Yii;
use yii\db\ActiveRecord;

/**
 * ActiveRecord class for table "articles";
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
 * @property int $updated_at
 * @property string $annotation
 * @property string $index
 * @property string $link
 * @property resource $file
 */
class ArticleJournal extends Article
{

    /**
     * redefined from parent class Article
     *
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles_journals';
    } // end function


    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ],
        ];
    } // end function


    /**
     * not defined in parent class Article
     *
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'title', 'number', 'class', 'year', 'language'], 'required'],
            [['type', 'number', 'direct_number', 'class', 'year', 'created_at', 'updated_at'], 'integer'],
            [['title', 'annotation', 'index', 'file'], 'string'],
            [['magazine', 'language', 'doi', 'link'], 'string', 'max' => 255],
        ];
    } // end function


    /**
     * not defined in parent class Article
     *
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'class' => 'Категория ПНРД',
            'title' => 'Заголовок',
            'magazine' => 'Журнал',
            'number' => 'Номер',
            'direct_number' => 'Сквозной номер',
            'pages' => 'Страницы',
            'year' => 'Год',
            'language' => 'Язык',
            'doi' => 'ЦИО',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
            'annotation' => 'Аннотация',
            'index' => 'Полнотекстовый индекс',
            'Pnrdindex' => 'Индекс ПНРД',
            'link' => 'Ссылка',
            'file' => 'Файл',
            'authors' => 'Авторы'
        ];
    } // end function


    /**
     * @inheritdoc
     * @return ArticleJournalQuery the active query used by this AR class;
     */
    public static function find()
    {
        return new ArticleJournalQuery(get_called_class());
    } // end function

} // end class
