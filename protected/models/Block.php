<?php

/**
 * This is the model class for table "block".
 *
 * The followings are the available columns in table 'block':
 * @property integer $id
 * @property string $alias
 * @property string $name
 * @property string $content
 * @property integer $publish
 * @property integer $publish_menu
 * @property string $background
 * @property integer $weight
 * @property integer $bg_style
 * @property integer $bg_color
 * @property integer $animate
 */
class Block extends CActiveRecord
{
	public static function getAll(){
		$dataProvider = new CActiveDataProvider('Block', array(
			'criteria'=>array(
    			'order'=>'weight ASC',
				),
			));
		$blocks	= $dataProvider->getData();
		return $blocks;
	}

	public static function buildStyle($id, $key){
		$block = Block::model()->findByPk($id);
		$image = ($block->background)?Yii::app()->request->baseUrl.'/images/bg_blocks/'.$block->background:'';
		
		$bg_image = 'background-image: url('.$image.'); '; 
		$bg_style = $block->bg_style;
		
		$bg_color = ($block->bg_color)?'background-color:'.$block->bg_color.'; ':'';
		$result = $bg_image.$bg_style.$bg_color;
		return $result;
	}
	
	public static function weightValue() {
		$blocks = Block::model()->findAll();
		if ($blocks){
			$weight = count($blocks)+1;
		} else {
			$weight = 1;
		}
		return $weight;
	}

	public static function weightMax() {
		$blocks = Block::model()->findAll();
		if ($blocks){
			$max = count($blocks)+1;
		} else {
			$max = 1;
		}
		return $max;
	}

	public static function weightMaxEdit() {
		$blocks = Block::model()->findAll();
		if ($blocks){
			$max = count($blocks);
		} else {
			$max = 1;
		}
		return $max;
	}

	public static function getByAlias($alias) {
		$block = Block::model()->findByAttributes(array('alias' => $alias));
		return $block;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'block';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('alias, name, content, publish, background, weight', 'required'),
			array('publish, publish_menu, weight', 'numerical', 'integerOnly'=>true),
			array('alias, name, background', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, alias, name, content, publish, publish_menu, background, bg_style, bg_color, animate, weight', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('publish',$this->publish);
		$criteria->compare('publish_menu',$this->publish_menu);
		$criteria->compare('background',$this->background,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('bg_style',$this->bg_style);
		$criteria->compare('bg_color',$this->bg_color);
		$criteria->compare('animate',$this->animate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Block the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
