<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%dianping}}".
 *
 * @property integer $business_id
 * @property string $name
 * @property integer $avg_price
 * @property integer $review_count
 * @property string $business_url
 * @property string $photo_url
 * @property string $s_photo_url
 * @property integer $photo_count
 * @property integer $has_coupon
 * @property integer $has_deal
 * @property integer $has_online_reservation
 * @property string $online_reservation_url
 * @property string $branch_name
 * @property string $address
 * @property string $telephone
 * @property string $city
 * @property string $regions
 * @property string $categories
 * @property double $latitude
 * @property double $longitude
 * @property double $avg_rating
 * @property string $rating_img_url
 * @property string $rating_s_img_url
 * @property integer $product_grade
 * @property integer $decoration_grade
 * @property integer $service_grade
 * @property double $product_score
 * @property double $decoration_score
 * @property double $service_score
 * @property integer $created_at
 * @property integer $updated_at
 */
class Dianping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lbs.dianping';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('apiDb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['business_id'], 'required'],
            [['business_id', 'avg_price', 'review_count', 'photo_count', 'has_coupon', 'has_deal', 'has_online_reservation', 'product_grade', 'decoration_grade', 'service_grade', 'created_at', 'updated_at'], 'integer'],
            [['latitude', 'longitude', 'avg_rating', 'product_score', 'decoration_score', 'service_score'], 'number'],
            [['name', 'business_url', 'photo_url', 's_photo_url', 'online_reservation_url', 'branch_name', 'address', 'telephone', 'city', 'regions', 'categories', 'rating_img_url', 'rating_s_img_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'business_id' => 'Business ID',
            'name' => '商户名',
            'avg_price' => '人均价格，单位:元，若没有人均，返回-1',
            'review_count' => '点评数量',
            'business_url' => '商户页面链接',
            'photo_url' => '照片链接，照片最大尺寸700×700',
            's_photo_url' => '小尺寸照片链接，照片最大尺寸278×200',
            'photo_count' => '照片数量',
            'has_coupon' => '是否有优惠券，0:没有，1:有',
            'has_deal' => '是否有团购，0:没有，1:有',
            'has_online_reservation' => '是否有在线预订，0:没有，1:有',
            'online_reservation_url' => '在线预订页面链接，目前仅返回HTML5站点链接',
            'branch_name' => '分店名',
            'address' => '地址',
            'telephone' => '带区号的电话',
            'city' => '所在城市',
            'regions' => '所在区域信息列表，如[徐汇区，徐家汇]',
            'categories' => '所属分类信息列表，如[宁波菜，婚宴酒店]',
            'latitude' => '纬度坐标',
            'longitude' => '经度坐标',
            'avg_rating' => '星级评分，5.0代表五星，4.5代表四星半，依此类推',
            'rating_img_url' => '星级图片链接',
            'rating_s_img_url' => '小尺寸星级图片链接',
            'product_grade' => '产品/食品口味评价，1:一般，2:尚可，3:好，4:很好，5:非常好',
            'decoration_grade' => '环境评价，1:一般，2:尚可，3:好，4:很好，5:非常好',
            'service_grade' => '服务评价，1:一般，2:尚可，3:好，4:很好，5:非常好',
            'product_score' => '产品/食品口味评价单项分，精确到小数点后一位（十分制）',
            'decoration_score' => '环境评价单项分，精确到小数点后一位（十分制）',
            'service_score' => '服务评价单项分，精确到小数点后一位（十分制）',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
