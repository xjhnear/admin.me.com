<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $mobile
 * @property string $nickname
 * @property string $password
 * @property integer $utype
 * @property integer $sex
 * @property string $avatar
 * @property string $avatar_lg
 * @property string $qq
 * @property string $phone
 * @property string $wechat
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $homeland
 * @property integer $height
 * @property string $industry
 * @property string $post
 * @property string $relationship
 * @property string $birthday
 * @property integer $age
 * @property string $starsign
 * @property integer $figure
 * @property integer $life_level
 * @property string $optional_sex
 * @property string $optional_love
 * @property string $hobby
 * @property integer $is_mobile_open
 * @property string $education
 * @property integer $is_car_certificated
 * @property integer $car_certification_stage
 * @property integer $avatar_certification_stage
 * @property integer $id_certification_stage
 * @property integer $video_certification_stage
 * @property integer $unmakeup_certification_stage
 * @property integer $part_certification_stage
 * @property integer $is_id_certificated
 * @property integer $is_video_certificated
 * @property integer $completion
 * @property integer $is_active
 * @property integer $blacklisted
 * @property integer $is_photo_open
 * @property integer $level
 * @property string $level_name
 * @property integer $credit_grade
 * @property string $grade_name
 * @property string $signature
 * @property string $created
 * @property string $updated
 * @property integer $month_cancel
 * @property string $completion_fields
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
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
            [['utype', 'sex', 'height', 'age', 'figure', 'car_certification_stage', 'avatar_certification_stage', 'id_certification_stage', 'video_certification_stage', 'unmakeup_certification_stage', 'part_certification_stage',  'completion', 'is_active', 'level', 'credit_grade', 'month_cancel'], 'integer'],
            [['industry', 'relationship', 'hobby', 'education'], 'string'],
            [['birthday', 'created', 'updated', 'blacklisted'], 'safe'],
            [['level_name'], 'required'],
            [['mobile'], 'string', 'max' => 11],
            [['nickname'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 32],
            [['avatar', 'completion_fields'], 'string', 'max' => 100],
            [['qq', 'wechat'], 'string', 'max' => 30],
            [['province', 'city', 'district', 'homeland', 'level_name', 'grade_name'], 'string', 'max' => 10],
            [['starsign'], 'string', 'max' => 3],
            [['optional_sex', 'optional_love', 'signature'], 'string', 'max' => 255],
            [['mobile'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户ID',
            'mobile' => '联系电话',
            'nickname' => '昵称',
            'password' => 'Password',
            'utype' => '用户种类 1.大哥 2.大姐 3.帅哥 4.美女',
            'sex' => '性别1：男，2：女',
            'avatar' => 'Avatar',
            'qq' => 'QQ',
            'wechat' => '微信',
            'province' => '城市',
            'city' => '城市',
            'district' => '行政区',
            'homeland' => '家乡',
            'height' => '身高',
            'industry' => '行业',
            'relationship' => '感情状态',
            'birthday' => '生日',
            'age' => '年龄',
            'starsign' => '星座',
            'figure' => '体型 男性: 1.偏瘦 2.匀称 3.健硕 女性: 1.偏瘦 2.匀称 3.丰满',
            'optional_sex' => '性趣',
            'optional_love' => '爱情观',
            'hobby' => '爱好',
            'education' => '教育程度',
            'is_car_certificated' => '汽车是否已经认证',
            'car_certification_stage' => '汽车认证状态',
            'avatar_certification_stage' => '头像认证状态',
            'id_certification_stage' => '身份认证状态',
            'video_certification_stage' => '视频认证状态',
            'unmakeup_certification_stage' => '素颜认证状态',
            'part_certification_stage' => '身材认证状态',
            'is_id_certificated' => '身份是否已经认证',
            'is_video_certificated' => '视频是否已经认证',
            'completion' => '资料是否已经完善',
            'is_active' => '是否激活',
            'blacklisted' => '是否是黑名单',
            'level' => '等级',
            'level_name' => '等级',
            'credit_grade' => '用户等级：较为信任',
            'grade_name' => '会员等级',
            'signature' => '用户签名',
            'created' => '创建时间',
            'updated' => '更新时间',
            'month_cancel' => '本月取消次数',
            'completion_fields' => 'Completion Fields',
            'userextra.diamond' => '剩余钻石',
            'useracclog.ip' => '登陆IP',
            'useracclog.url' => '登陆URL',
            'useracclog.created' => '登陆时间',
            'userextra.hot_ranking' => '热度排名',
            'device.udid' => '设备号',
        ];
    }

    /**
     *     'car_certification_stage' => '汽车认证阶段',
    'avatar_certification_stage' => '头像认证',
    'id_certification_stage' => '身份认证阶段',
    'video_certification_stage' => '视频认证阶段',
    'unmakeup_certification_stage' => '素颜认证阶段',
    'part_certification_stage' => '身材认证阶段',
     * @return $this
     */
    public function getCarCertification()
    {
        $result= $this->hasMany(UserUpload::className(), ['user_id' => 'id'])->andWhere(['module' => 'car']);
        return $result;
    }

    /**
     * 头像认证
     * @return $this
     */
    public function getAvatarCertification()
    {
        return $this->hasOne(UserUpload::className(), ['user_id' => 'id'])->andWhere(['module' => 'avatar']);
    }

    /**
     * 身份认证阶段
     * @return $this
     */
    public function getIdCertification()
    {
        return $this->hasMany(UserUpload::className(), ['user_id' => 'id'])->andWhere(['module' => 'id']);
    }

    /**
     * 视频认证阶段
     * @return $this
     */
    public function getVideoCertification()
    {
        return $this->hasMany(UserUpload::className(), ['user_id' => 'id'])->andWhere(['module' => 'video']);
    }

    /**
     * 素颜认证阶段
     * @return $this
     */
    public function getUnmakeupCertification()
    {
        return $this->hasMany(UserUpload::className(), ['user_id' => 'id'])->andWhere(['module' => 'unmakeup']);
    }

    /**
     * 身材认证阶段
     */
    public function getPartCertification()
    {
        return $this->hasMany(UserUpload::className(), ['user_id' => 'id'])->andWhere(['module' => 'part']);
    }
    
    /**
     * 获取用户扩展信息
     * @return \yii\db\ActiveQuery
     */
    public function getUserextra()
    {
    	return $this->hasOne(UserExtra::className(), ['id' => 'id']);
    }
    
    /**
     * 获取用户设备信息
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
    	return $this->hasOne(Device::className(), ['user_id' => 'id']);
    }
    
    /**
     * 获取用户登陆信息
     * @return \yii\db\ActiveQuery
     */
    public function getUseracclog()
    {
    	return $this->hasOne(AccessLog::className(), ['user_id' => 'id']);
    }
    
    
    public function isBoss()
    {
    	return $this->utype==1 || $this->utype==2;
    }
    
    
    public function getAttrConfig()
    {
    	if ($this->isBoss()) {
    		$VipConfig = new VipConfig();
    		$model=$VipConfig->findByNo($this->level);
    	} else {
    		// code...
    		$CreditConfig = new CreditConfig();
    		$model=$CreditConfig->findByNo($this->level);
    	}
    	return $model;
    }
    
}
