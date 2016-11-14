<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $id
 * @property string $name
 * @property string $mail
 * @property string $password
 * @property string $phone
 * @property string $position_lg
 * @property string $position_lt
 */
class Customer extends CActiveRecord
{


	public static function TotalSum($id){
		$user = Customer::model()->findByPk($id);
		// total_sum criteria
		$criteria=new CDbCriteria;
		$criteria->select='sum(sum) as sum'; 
		$criteria->condition='customer_id=:customer_id';
		$criteria->params=array(':customer_id'=>$user->id);
		$total_sum = Order::model()->find($criteria)->getAttribute('sum'); 
		if ($total_sum) {
			echo $total_sum;
		} else {
			echo 0;
		}
	}

	public static function NotApplyOrders($id){
		$not_apply_orders = Order::model()->findAllByAttributes(array('status' => '0', 'customer_id' => $id)); 
		return count($not_apply_orders);
	}

	public static function ApplyOrders($id){
		$not_apply_orders = Order::model()->findAllByAttributes(array('status' => '1', 'customer_id' => $id)); 
		return count($not_apply_orders);
	}

	public static function getData($param){
		$user = Customer::model()->findByPk(Yii::app()->user->id);
		return $user->$param;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('name, mail, password, phone, position_lg, position_lt', 'required'),
			array('name, mail, password, phone, position_lt, position_lg', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, mail, password, phone, position_lg, position_lt', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'mail' => 'Mail',
			'password' => 'Password',
			'phone' => 'Phone',
			'position_lg' => 'Position Lg',
			'position_lt' => 'Position Lt',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('position_lg',$this->position_lg,true);
		$criteria->compare('position_lt',$this->position_lt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
