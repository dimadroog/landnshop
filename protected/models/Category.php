<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 */
class Category extends CActiveRecord
{

    public static function tree($root = false){ /*FOR TREE*/
		$categories = Category::model()->findAll();
		$result_array = Category::getMenu($categories);
		if ($root) {
			array_push($result_array, array('id'=> 0, 'name'=> 'Корневая категория', 'full_name'=> 'Корневая категория'));
		}
		return $result_array;
	}

	public static function getMenu($categories) { /*FOR TREE*/
	    $output_array = array();
	    $parent_id = 0; 
	    $lvl = -1;
	    $cat = Category::prepareTree($categories);
	    Category::buildTree($cat, $parent_id, $output_array, $lvl);
	    return $output_array;
	}

	public static function prepareTree($categories){  /*FOR TREE*/
	    $arr = array();
	    foreach($categories as $category)
	    {
	        if (!$category->parent_id)
	            $category->parent_id = 0;
	        if(empty($arr[$category->parent_id]))
	            $arr[$category->parent_id] = array();
	        $arr[$category->parent_id][] = $category;
	    }
	    return $arr;    
	}

	public static function buildTree($arr, $parent_id, &$output_array, $lvl) { /*FOR TREE*/
	    $lvl = $lvl+1;
	    if(empty($arr[$parent_id])) { //escape from recursion
	        return;
	    }
	    for($i = 0; $i < count($arr[$parent_id]);$i++) {
	        $output_array[]= array(
	        	'id' => $arr[$parent_id][$i]->id,
	        	'parent_id' => $arr[$parent_id][$i]->parent_id,
	        	'name' => $arr[$parent_id][$i]->name,
	        	'full_name' => Category::fullName($arr[$parent_id][$i]->id),
	        	'level' => $lvl,
	        	'arr_names' => Category::arrNames($arr[$parent_id][$i]->id),
	        	);
	        Category::buildTree($arr, $arr[$parent_id][$i]->id, $output_array, $lvl);
	    }
	}

	public static function fullName($id, $root=false){
		if ($id > 0) {
			$cat = Category::model()->findByPk($id);
			$str = '';
			$current_cat = $cat->name;
			$arr = array();
			do {
				$cat = Category::model()->findByPk($cat->parent_id);
				if ($cat){
					$arr[] = $cat->name; 
				}
			}
			while ($cat->parent_id > 0);
			if (count($arr) > 0) {;
				$str .= implode(array_reverse($arr), ' > ');
				$str .= ' > ';
			}
			$result = $str.$current_cat;
		} else {
			if ($root) {
				$result = 'Корневая категория';
			} else {
				$result = '';
			}
		}
		return $result;
	}

	public static function arrNames($id){
		$cat = Category::model()->findByPk($id);
		$str = '';
		$current_cat = $cat->name;
		$arr = array($cat->id => $cat->name);
		do {
			$cat = Category::model()->findByPk($cat->parent_id);
			if ($cat){
				$arr[$cat->id] = $cat->name; 
			}
		}
		while ($cat->parent_id > 0);
		$result = array_reverse($arr, true);
		return $result;
	}

	public static function name($id){
		$cat = Category::model()->findByPk($id);
		return $cat->name;
	}

    public static function repeatLevelSymbol($lvl){        
        $str = '';
        for ($i=0; $i < $lvl+1; $i++) { 
            $str .= '-&nbsp';
        } 
        return $str;
    }


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('parent_id, name', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, name', 'safe', 'on'=>'search'),
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
			'categoryArticle' => array(self::MANY_MANY, 'Article', 'article_category(category_id, article_id)'),
            'childs'=>array(self::HAS_MANY, get_class($this), 'parent_id'),
            'parent'=>array(self::BELONGS_TO, get_class($this), 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'name' => 'Name',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
