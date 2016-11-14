<?php

/**
 * This is the model class for table "setting".
 *
 * The followings are the available columns in table 'setting':
 * @property integer $id
 * @property string $sitename
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property integer $bootstrap_theme
 * @property integer $navbar_position
 * @property integer $navbar_theme
 * @property integer $password
 * @property integer $super_password
 * @property integer $email
 * @property integer $articles
 */
class Setting extends CActiveRecord
{
	public static function getData($param){
		$setting = Setting::model()->findByPk(1);
		return $setting->$param;
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('sitename, seo_title, seo_description, seo_keywords', 'required'),
			array('sitename, seo_title, bootstrap_theme, navbar_position, navbar_theme, password, super_password, email', 'length', 'max'=>255),
			array('articles', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sitename, seo_title, seo_description, seo_keywords, bootstrap_theme, navbar_position, navbar_theme, password, super_password, email, articles', 'safe', 'on'=>'search'),
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
		$criteria->compare('sitename',$this->sitename,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('bootstrap_theme',$this->bootstrap_theme);
		$criteria->compare('navbar_position',$this->navbar_position);
		$criteria->compare('navbar_theme',$this->navbar_theme);
		$criteria->compare('password',$this->password);
		$criteria->compare('super_password',$this->super_password);
		$criteria->compare('email',$this->email);
		$criteria->compare('articles',$this->articles);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Setting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
