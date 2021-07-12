<?php

namespace common\models;

use arogachev\ManyToMany\behaviors\ManyToManyBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int|null $quantity
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property ProductCategory[] $productCategories
 * @property Category[] $categories
 */
class Product extends \yii\db\ActiveRecord
{
    public $categories_multiples;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public function behaviors(){
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
            [
                'class' => ManyToManyBehavior::className(),
                'relations' => [
                    [
                        'editableAttribute' => 'categories_multiples', // Editable attribute name
                        'table' => 'product_category', // Name of the junction table
                        'ownAttribute' => 'product_id', // Name of the column in junction table that represents current model
                        'relatedModel' => Category::className(), // Related model class
                        'relatedAttribute' => 'category_id', // Name of the column in junction table that represents related model
                    ],
                ],
            ]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //name
            ['name','required'],
            ['name','string','max'=>255],
            //quantity
            ['quantity','required'],
            ['quantity','integer'],
            // created_by

            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            //updated_by
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            //$categories_multiples
            ['categories_multiples','safe']
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'quantity' => 'Quantidade',
            'categories_multiples'=>'Categorias',
            'created_by' => 'Cadastrado por',
            'updated_by' => 'Atualizado Por',
            'created_at' => 'Cadastrado em',
            'updated_at' => 'Atualizado em',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[ProductCategories]].
     *
     * @return \yii\db\ActiveQuery|ProductCategoryQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery|CategoryQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('product_category', ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
