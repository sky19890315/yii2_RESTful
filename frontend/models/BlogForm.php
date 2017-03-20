<?php

namespace frontend\models;

use Yii;
//调用父类
use common\models\Blog;


/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $create_time
 */
class BlogForm extends Blog
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     *
     */
    public function rules()
    {
        return [
            [['content'], 'string', 'max' => 1000 ],
            ['content', 'required', 'message' => '内容不能为空'],
            [['create_time'], 'safe'],
            [['title'], 'string', 'max' => 100],
            ['title', 'required', 'message' => '标题不能为空'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        /*修改成中文显示*/
        return [
            'id'            =>      'ID',
            'title'         =>      '标题',
            'content'       =>      '内容',
            'create_time'   =>      '创建时间',
        ];
    }
}
