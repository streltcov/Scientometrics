<?php

namespace app\models\units\articles\journals;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_types".
 *
 * @property int $id
 * @property string $type
 */
class Types extends ActiveRecord
{

    /**
     * @inheritdoc
     *
     * @return string
     */
    public static function tableName()
    {

        return 'article_types';

    } // end function



    /**
     * @inheritdoc
     *
     * @return array
     */
    public function rules()
    {

        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 255],
        ];

    } // end function



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {

        return [
            'id' => 'ID',
            'type' => 'Type',
        ];

    } // end function



    /**
     * @inheritdoc
     *
     * @return TypesQuery the active query used by this AR class.
     */
    public static function find()
    {

        return new TypesQuery(get_called_class());

    } // end function

} // end class