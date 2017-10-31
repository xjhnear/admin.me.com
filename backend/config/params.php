<?php
return [
    'adminEmail' => 'admin@example.com',
    //user_utype
    'user_utype' => [
    '0' => 'N/A',
    '1' => '大哥',
    '2' => '大姐',
    '3' => '帅哥',
    '4' => '美女',
    '' => 'N/A',
    ],
    //user_sex
    'user_sex' => [
    '0' => 'N/A',
    '1' => '男',
    '2' => '女',
    '' => 'N/A',
    ],
    //diamond_order_payment_method
    'diamond_order_payment_method' => [
    'alipay' => '支付宝',
    'wechat' => '微信',
    'apple' => 'APPStore',
    '' => 'N/A',
    ],
    //diamond_order_status
    'diamond_order_status' => [
    'success' => '充值成功',
    'pending' => '充值中',
    'failed' => '充值失败',
    'refund' => '退款',
    '' => 'N/A',
    ],
    //Notice
    'Notice' => [
    'Notice_cert_success_title' => '审核已通过',
    'Notice_cert_pass' => '太赞了！您的%s认证已通过审核，获得了%s哦！',
    'Notice_cert_pass_nopoint' => '太赞了！您的%s认证已通过审核！',
    'Notice_cert_fail_title' => '审核未通过',
    'Notice_cert_unpass' => '很遗憾，您提交的%s认证审核未通过！',
    'Notice_cert_unpass_reason' => '很遗憾，您提交的%s认证审核未通过！被拒原因：%s',
    'Notice_withdraw_success_title' => '提现成功',
    'Notice_withdraw_pass' => '收钱啦！您于%s提交的提现请求，已成功提现%s钻石，扣除手续费%s元，实际到账%s元哦',
    'Notice_withdraw_fail_title' => '提现未成功',
    'Notice_withdraw_unpass' => '很遗憾！您于%s提交的提现请求未成功，钻石已退还到您的账号中，请仔细核对您的信息后重试！',
    'Notice_withdraw_unpass_reason' => '很遗憾！您于%s提交的提现请求未成功，钻石已退还到您的账号中，请仔细核对您的信息后重试！失败原因：%s',

    'Notice_level_grade_baby' => '你好棒！信用等级提升至%s！信用评价达到%s！',
    'Notice_level_baby' => '你好棒！信用等级提升至%s！',
    'Notice_level_title_baby' => '信用等级提升',
    'Notice_level_grade_boss' => '你好棒！VIP等级提升至%s！VIP评价达到%s！',
    'Notice_level_boss' => '你好棒！ VIP等级提升至%s！',
    'Notice_level_down' => '哎呀，您的信用等级下降为%s级，以后要注意诚信约见哟！',
    'Notice_level_title_boss' => 'VIP等级提升',
   
    'Notice_blacklisted_title' => '违规警告',
    'Notice_blacklisted' => '您好，经用户举报，您所发布的内容涉嫌违规、诈骗等操作，已做删除，请共创绿色社交环境，如再次违规或将进行封号处理。如果您有异议，可发起申诉。',
    'Notice_blacklisted_reason' => '您好，经用户举报，您所发布的内容%s，已做删除，请共创绿色社交环境，如再次违规或将进行封号处理。如果您有异议，可发起申诉。',
    ],
    //report_cat
    'report_cat' => [
    'porn' => '色情',
    'harass' => '骚扰',
    'theft' => '盗用',
    'misinfo' => '错误信息',
    '' => 'N/A',
    ],
    //point_history_type
    'point_history_type' => [
    'add_friend' => '加好友',
    'video' => 'video',
    'unmakup' => 'unmakup',
    'contact' => 'contact',
    'part' => 'part',
    '' => 'N/A',
    ],
    //see_report_category
    'see_report_category' => [
    'porn' => '色情',
    'harass' => '骚扰',
    'theft' => '盗用',
    'misinfo' => '错误信息',
    'see' => '约见',
    '' => 'N/A',
    ],
    //see_report_status
    'see_report_status' => [
    'waiting' => '等待中',
    'success' => '处理成功',
    '' => 'N/A',
    ],
    //withdraw_status
    'withdraw_status' => [
    'success' => '提现成功',
    'pending' => '处理中',
    'failed' => '提现失败',
    '' => 'N/A',
    ],
    //diamond_history_type
    'diamond_history_type' => [
    'add_friend' => '好友添加',
    'video' => '视频认证信息查看',
    'id'=> '身份认证信息查看',
    'unmakeup' => '素颜认证查看',
    'contact' => '联系信息查看',
    'part' => '身材认证查看',
    'dating' => '约见',
    'match' => '匹配',
    'see' => '约见',
    'dating_timeout' => '绝见迟到',
    'dating_cancel' => '约见取消',
    'private' => '私密照查看',
    'refund' => '偿还',
    'recharge' => '充值',
    'showgirl' => '圣诞红人投票',
    'hotgirl' => '圣诞红人投票',
    'comment' => '打赏',
    'withdraw' => '提现',
    'admin' => '后台调整',
    'inviting' => '邀请',
    'girlsday' => '女生节',
    'white' => '白色情人节',
    '' => 'N/A',
    ],
    //diamond_history_status
    'diamond_history_status' => [
    'success' => '成功',
    'failure' => '失败',
    'freeze' => '冻结',
    'unfreeze' => '解冻',
    'invited' => '邀请',
    '' => 'N/A',
    ],
    //qa_type
    'qa_type' => [
    '0' => '全部',
    '1' => '老板',
    '2' => '宝贝',
    '' => 'N/A',
    ],
    //qa_category
    'qa_category' => [
    'see' => '约见',
    '' => 'N/A',
    ],
    //notification_key
    'notification_key' => [
    'avatar' => '头像',
    'car' => '汽车',
    'unmakeup' => '素颜',
    'video' => '视频',
    'id' => '身份',
    'part' => '身材',
    'photo' => '宣言',
    'reportphoto' => '宣言',
    'open' => '公开照',
    'private' => '私密照',
    '' => 'N/A',
    ],
    //see_status
    'see_status' => [
    '0' => '参与',
    '1' => '公示中',
    '2' => '参与中',
    '3' => '已达成',
    '4' => '约见成功',
    '5' => '约见取消',
    '-1' => '系统取消',
    '7' => '爽约取消',
    '8' => '约见失败',
    '-2' => '超时',
    '-3' => '自行取消',
    '' => 'N/A',
    ],
    //see_status
    'seejoin_status' => [
    '0' => '参与',
    '1' => '公示中',
    '2' => '参与中',
    '3' => '已达成',
    '4' => '对方爽约',
    '5' => '自身爽约',
    '6' => '约见取消',
    '7' => '约见成功',
    '8' => '对方取消',
    '9' => '自身取消',
    '10' => '系统取消',
    '-1' => '系统取消',
    '-2' => '超时',
    '' => 'N/A',
    ],
    //see_status
    'seejoin_is_arrive' => [
    '0' => '未到达',
    '1' => '已到达',
    '' => 'N/A',
    ],
    //blacklisted_option
    'blacklisted_option' => [
    '1' => '警告',
    '2' => '封停1天',
    '3' => '封停3天',
    '4' => '封停7天',
    '5' => '封停30天',
    '6' => '永久封停',
    '7' => '账号解封',
    '' => 'N/A',
    ],
    
    //test_user
    'test_user' => [
    '1018',
    '1045',
    '1',
    '4',
    '1003',
    '1826',
    ],
    
    //bot_nickname1
    'bot_nickname1' => [
    '大方','年轻','聪明','雪白','漂亮','笔直','固定','平等','优秀','慌张','俗气','马虎','博学','主观','明快','高兴','幸福','清楚','明确','结实','具体','伟大 ','勇敢 ','坚强 ','温柔','平淡',' 简单','固执','醒目',' 干净','傲慢','倔强','脆弱','乐观。爽朗','豪放','开朗。爱笑','娇柔','友好。活泼','昂贵','孤独','好动','愉快','热情','可亲','健谈','轻松','机敏','外向','兴奋。强烈','率直','语言','行动','善良','文雅','整洁','内向','沉静','稳重','顺从','温和','老实','沉著','和平','体贴','忠诚','知足','果断','首领','喜爱','善变','细节','保守','忠心','调解','自信','独立','不凡','悠然','从容','迷人','淡定','海涵。洋气','高雅','风度','随和','王者','潇洒','宽容','迷茫','困惑 ','乏困 ','疲倦',
    ],
    
    //bot_nickname2
    'bot_nickname2' => [
    '似水情','柔情控','淡雅芯','烟墨染','暖色系','冷色调','温暖心','曼陀罗','千百度','微博控','不煽情','奈何桥','忆逝逝','月孤悬','欺负我','蔓层生','薄荷梦','离魂曲','三人游','尘瞒面','仰泳角','薄雪草','那时候','恋飘雪','冷雨夜','七宗罪','溢孤清','若相惜','泰山颓','白玉咒','世俗缘','忆往昔','幻想爱','半面妆','背离我','假戒指','魔域非','梦回中','小铁塔','昏言难','辜塞人','血玲珑','浮梦儿','双眸中','惟美伤','柔素年','瞬间爱','人如故','离人节','清新记','时光眠','刀疤六','心剩半','旧年华','深水涉','敷陋恋','孤寐语','慌昧心','谨冥欲','漌生死','宽真心','空城计','唱情歌','真忐忑',
    ],
    
    //bot_province
    'bot_province' => [
    '上海','北京','广州',
    ],
    
    //bot_industry
    'bot_industry' => [
    '计算机','互联网','通信','电子','会计','金融','银行','保险','贸易','消费','制造','医疗','广告','媒体','房地产','建筑','教育','培训','服务业','物流','运输','能源','原材料','政府','其他',
    ],
    
    //bot_relationship
    'bot_relationship' => [
    '离异','分居','已婚','恋爱','单身','暧昧',
    ],
    
    //bot_starsign
    'bot_starsign' => [
    '白羊座','金牛座','双子座','巨蟹座','狮子座','处女座','天秤座','天蝎座','射手座','摩羯座','水瓶座','双鱼座',
    ],
    
    //bot_utype
    'bot_utype' => [
    '1','4',
    ],
    
    //bot_botav
    'bot_botav1' => [
    'botav1_1.jpg',
    'botav1_10.jpg',
    'botav1_100.jpg',
    'botav1_101.jpg',
    'botav1_102.jpg',
    'botav1_103.jpg',
    'botav1_104.jpg',
    'botav1_105.jpg',
    'botav1_106.jpg',
    'botav1_107.jpg',
    'botav1_108.jpg',
    'botav1_109.jpg',
    'botav1_11.jpg',
    'botav1_110.jpg',
    'botav1_111.jpg',
    'botav1_112.jpg',
    'botav1_113.jpg',
    'botav1_114.jpg',
    'botav1_115.jpg',
    'botav1_116.jpg',
    'botav1_12.jpg',
    'botav1_13.jpg',
    'botav1_14.jpg',
    'botav1_15.jpg',
    'botav1_16.jpg',
    'botav1_17.jpg',
    'botav1_18.jpg',
    'botav1_19.jpg',
    'botav1_2.jpg',
    'botav1_20.jpg',
    'botav1_22.jpg',
    'botav1_23.jpg',
    'botav1_24.jpg',
    'botav1_25.jpg',
    'botav1_26.jpg',
    'botav1_27.jpg',
    'botav1_28.jpg',
    'botav1_29.jpg',
    'botav1_3.jpg',
    'botav1_30.jpg',
    'botav1_31.jpg',
    'botav1_32.jpg',
    'botav1_33.jpg',
    'botav1_34.jpg',
    'botav1_35.jpg',
    'botav1_36.jpg',
    'botav1_37.jpg',
    'botav1_38.jpg',
    'botav1_39.jpg',
    'botav1_4.jpg',
    'botav1_40.jpg',
    'botav1_42.jpg',
    'botav1_43.jpg',
    'botav1_44.jpg',
    'botav1_45.jpg',
    'botav1_46.jpg',
    'botav1_47.jpg',
    'botav1_48.jpg',
    'botav1_49.jpg',
    'botav1_5.jpg',
    'botav1_50.jpg',
    'botav1_51.jpg',
    'botav1_52.jpg',
    'botav1_53.jpg',
    'botav1_54.jpg',
    'botav1_55.jpg',
    'botav1_56.jpg',
    'botav1_57.jpg',
    'botav1_58.jpg',
    'botav1_59.jpg',
    'botav1_6.jpg',
    'botav1_60.jpg',
    'botav1_61.jpg',
    'botav1_62.jpg',
    'botav1_63.jpg',
    'botav1_64.jpg',
    'botav1_65.jpg',
    'botav1_67.jpg',
    'botav1_68.jpg',
    'botav1_69.jpg',
    'botav1_7.jpg',
    'botav1_70.jpg',
    'botav1_71.jpg',
    'botav1_72.jpg',
    'botav1_73.jpg',
    'botav1_74.jpg',
    'botav1_75.jpg',
    'botav1_76.jpg',
    'botav1_77.jpg',
    'botav1_78.jpg',
    'botav1_79.jpg',
    'botav1_8.jpg',
    'botav1_80.jpg',
    'botav1_81.jpg',
    'botav1_82.jpg',
    'botav1_83.jpg',
    'botav1_84.jpg',
    'botav1_85.jpg',
    'botav1_86.jpg',
    'botav1_87.jpg',
    'botav1_88.jpg',
    'botav1_89.jpg',
    'botav1_9.jpg',
    'botav1_90.jpg',
    'botav1_91.jpg',
    'botav1_92.jpg',
    'botav1_93.jpg',
    'botav1_94.jpg',
    'botav1_95.jpg',
    'botav1_96.jpg',
    'botav1_97.jpg',
    'botav1_98.jpg',
    'botav1_99.jpg',
    ],
    
    'bot_botav4' => [
    'botav4_10.jpg',
    'botav4_100.jpg',
    'botav4_101.jpg',
    'botav4_102.jpg',
    'botav4_103.jpg',
    'botav4_104.jpg',
    'botav4_105.jpg',
    'botav4_106.jpg',
    'botav4_107.jpg',
    'botav4_108.jpg',
    'botav4_109.jpg',
    'botav4_11.jpg',
    'botav4_110.jpg',
    'botav4_111.jpg',
    'botav4_112.jpg',
    'botav4_113.jpg',
    'botav4_114.jpg',
    'botav4_115.jpg',
    'botav4_116.jpg',
    'botav4_117.jpg',
    'botav4_118.jpg',
    'botav4_119.jpg',
    'botav4_12.jpg',
    'botav4_120.jpg',
    'botav4_121.jpg',
    'botav4_122.jpg',
    'botav4_123.jpg',
    'botav4_124.jpg',
    'botav4_13.jpg',
    'botav4_14.jpg',
    'botav4_15.jpg',
    'botav4_16.jpg',
    'botav4_17.jpg',
    'botav4_18.jpg',
    'botav4_19.jpg',
    'botav4_20.jpg',
    'botav4_21.jpg',
    'botav4_22.jpg',
    'botav4_23.jpg',
    'botav4_24.jpg',
    'botav4_25.jpg',
    'botav4_26.jpg',
    'botav4_27.jpg',
    'botav4_28.jpg',
    'botav4_29.jpg',
    'botav4_30.jpg',
    'botav4_31.jpg',
    'botav4_32.jpg',
    'botav4_33.jpg',
    'botav4_34.jpg',
    'botav4_35.jpg',
    'botav4_36.jpg',
    'botav4_37.jpg',
    'botav4_38.jpg',
    'botav4_39.jpg',
    'botav4_4.jpg',
    'botav4_40.jpg',
    'botav4_41.jpg',
    'botav4_42.jpg',
    'botav4_43.jpg',
    'botav4_44.jpg',
    'botav4_45.jpg',
    'botav4_46.jpg',
    'botav4_47.jpg',
    'botav4_48.jpg',
    'botav4_49.jpg',
    'botav4_5.jpg',
    'botav4_50.jpg',
    'botav4_51.jpg',
    'botav4_52.jpg',
    'botav4_53.jpg',
    'botav4_54.jpg',
    'botav4_55.jpg',
    'botav4_56.jpg',
    'botav4_57.jpg',
    'botav4_58.jpg',
    'botav4_59.jpg',
    'botav4_6.jpg',
    'botav4_60.jpg',
    'botav4_61.jpg',
    'botav4_62.jpg',
    'botav4_63.jpg',
    'botav4_64.jpg',
    'botav4_65.jpg',
    'botav4_66.jpg',
    'botav4_67.jpg',
    'botav4_68.jpg',
    'botav4_69.jpg',
    'botav4_7.jpg',
    'botav4_70.jpg',
    'botav4_71.jpg',
    'botav4_72.jpg',
    'botav4_73.jpg',
    'botav4_74.jpg',
    'botav4_75.jpg',
    'botav4_76.jpg',
    'botav4_77.jpg',
    'botav4_78.jpg',
    'botav4_79.jpg',
    'botav4_8.jpg',
    'botav4_80.jpg',
    'botav4_81.jpg',
    'botav4_82.jpg',
    'botav4_83.jpg',
    'botav4_84.jpg',
    'botav4_85.jpg',
    'botav4_86.jpg',
    'botav4_87.jpg',
    'botav4_88.jpg',
    'botav4_89.jpg',
    'botav4_9.jpg',
    'botav4_90.jpg',
    'botav4_91.jpg',
    'botav4_92.jpg',
    'botav4_93.jpg',
    'botav4_94.jpg',
    'botav4_95.jpg',
    'botav4_96.jpg',
    'botav4_97.jpg',
    'botav4_98.jpg',
    'botav4_99.jpg',
    ],
    
    //bot_utype
    'bot_business_id' => [
	'500542'=>'透明思考新天地餐厅(新天地北里店)','501350'=>'东亚潮州酒楼(虹桥友谊店)','502908'=>'新蓝天餐厅','566514'=>'翡翠36餐厅','578453'=>'马里昂巴咖啡馆','579030'=>'老镇玫瑰法式餐厅','584350'=>'La Verbena','1796965'=>'UME国际影城(新天地店)','1796980'=>'和平影都','1796995'=>'SFC上影(上海影城店)','1895536'=>'星光小吃','1898185'=>'悦榕庄温泉SPA','2014663'=>'CH2 by WHISK','2023867'=>'小肥羊(延安西路店)','2134921'=>'Tomato Korean Restaurant','2224159'=>'海底捞火锅店(海宁路店)','2414902'=>'爱茜茜里意大利健康冰淇淋(东方商厦店)','2432146'=>'静安寺','2509660'=>'堂屋咖啡','2608402'=>'Mokkos','2644510'=>'前川','2645452'=>'东北农家菜','2662717'=>'blue frog蓝蛙(三里屯太古里店)','2745640'=>'Hatsune隐泉日式料理(三里屯太古里店)','2802772'=>'王府井希尔顿酒店','2852977'=>'Aqua restaurant and bar','2868934'=>'大吉(虹梅路店)','2922115'=>'Karaiya辣屋湖南料理','3089860'=>'健一公馆','3098707'=>'王廷饭店(原王子饭店)','3212818'=>'博纳国际影城(悠唐店)','3371062'=>'星巴克(西藏中路店)','3513403'=>'半岛酒店艾利爵士餐厅&露台','3531196'=>'汉舍中国菜馆(悦达889店)','3654745'=>'寿司工厂(江城路店)','3867145'=>'安薇塔英国茶屋','3888574'=>'荷风轩铁板烧(悦达889店)','4065124'=>'Costa Coffee(万象城店)','4067443'=>'汉泰东南亚风味餐厅(武宁店)','4078315'=>'王鼎铁板烧精致料理(世茂商都店)','4128399'=>'云闽煲仔菜','4132319'=>'鹿港小镇(星展店)','4175402'=>'鱼町居酒屋','4228029'=>'MODO Urban Deli','4290816'=>'华尔道夫酒店廊吧','4296435'=>'松临日本料理(悦达889店)','4517201'=>'The Monkey Champagne','4529794'=>'金逸影城(苏州乐园店)','4551072'=>'红宝石(长海店)','4619894'=>'香满园(金沙店)','4693592'=>'沃歌斯(悦达889店)','4747215'=>'海底捞火锅店(邯郸路店)','5193973'=>'秦香阁(我格广场店)','5249540'=>'西九巷咖啡(人民广场店)','5255433'=>'Bule Fron','5259360'=>'网鱼网咖(兰溪路店)','5284507'=>'网鱼网咖(大华店)','5284511'=>'网鱼网咖(田林店)','5372525'=>'柒寿司(富民路店)','5414740'=>'FENNEL 回香西餐厅及鸡尾酒吧','5464107'=>'千屋拉面(华江路店)','5527477'=>'九久日本料理(静安店)','5530450'=>'煲宫(人民广场店)','5573597'=>'8 1/2 Otto e Mezzo BOMBANA','5622418'=>'LAGOON Bar&Dinning','5660455'=>'M55','5660730'=>'万藏燒肉屋(古羊路店)','5714662'=>'鹿港小镇(三里屯太古里店)','5906938'=>'板门店自动烧烤','6093369'=>'爱琴海咖啡','6111629'=>'小背篓餐厅','6147305'=>'上岛咖啡(北宝兴路店)','6184500'=>'Ultraviolet by Paul Pairet','6265493'=>'Fat Mama','6438113'=>'MustGuette 红邮筒餐厅','6642441'=>'灰狗·潮泰意·餐厅(三里屯店)','8014348'=>'早陆晚玖(长宁支路一店)','8020067'=>'The Little Onion 意厨坊','8065738'=>'猫饭堂','8406311'=>'炭宝贝(三号湾店)','8530356'=>'王子公主奇遇记主题KTV(金平店)','8550672'=>'招财猫寿司吧','8736993'=>'空蝉怀石料理','8760163'=>'Cantina Agave龙舌兰小馆','8821432'=>'田季干锅牛蛙主题餐厅(仓场路店)','8844957'=>'洋房火锅(新天地店)','8901754'=>'COSTA COFFEE(月星环球港店)','8936499'=>'添香小厨','8981501'=>'孔雀川菜(MAURYA)','8995571'=>'平壤高丽馆','9008408'=>'K歌之王旗舰店','9029614'=>'辣府(打浦店)','9034676'=>'候场','9108498'=>'缘作居酒屋(上海路店)','9293914'=>'CAFÉ DE PARIS理查1892','9477677'=>'The Woodhouse','9952123'=>'百丽宫影城(环贸iapm店)','9964442'=>'重庆高老九火锅(人民广场店)','10017328'=>'海上国际影城(月星环球港店)','10022372'=>'J-Space','10029786'=>'智博娱乐会所','10329824'=>'Opress零压力桌游吧','10350335'=>'彼德西餐 Peter&apos;s(月星环球港店)','10521560'=>'鱼宴','10646409'=>'唐香村风味烤鱼坊','10654959'=>'小南国烧烤(来福士店)','10659387'=>'歌成','11269335'=>'静慧平棋牌室','11547161'=>'小辉哥火锅(月星环球港店)','11547192'=>'小辉哥火锅(悦达889店)','11574402'=>'MYST Club','12286665'=>'居食屋和民(月星环球港店)','12592185'=>'王记盱眙十三香龙虾','12593305'=>'天家•金枪鱼世家(月星环球港店)','12594274'=>'OUTBACK 澳拜客(月星环球港店)','13719840'=>'泉之隐-日本锅物料理&居酒屋','13743311'=>'Let&apos;s Pasta','13803854'=>'四川香天下火锅(延安西路店)','13820247'=>'极食(芮欧百货店)','13828817'=>'蜜色咖啡','13836621'=>'金牛苑(港汇广场店)','13858134'=>'清源私房菜','13871615'=>'Penny家常菜','13876883'=>'万岛日本料理铁板烧(外滩店)','13890396'=>'颐和养生会所','13891922'=>'浦江游览龙船自助餐','14073894'=>'奕鑫棋牌室','14688753'=>'蟹蚝庭CRAB YARD','14701707'=>'得一鲜面馆(里河店)','14881792'=>'新世界酒店印酒吧','14889805'=>'天阙酒吧','14904820'=>'上上谦串串香火锅(普陀我格广场店)','14956512'=>'亚地网咖','15031373'=>'浅水湾荔苑','15865274'=>'江桥万达','15871238'=>'蜜路夏威夷','15872042'=>'皇朝大酒店','15992261'=>'哈尔滨船长烧烤','15992364'=>'港悦茶餐厅(百汇街店)','16286804'=>'鸡尾酒吧','16969751'=>'Korean Tteokbokki Food','17153031'=>'Linx CLUB','17203036'=>'来福士美食b1韩国料理','17622893'=>'顺捷服务式公寓','17654452'=>'K.pasta小厨工坊','17656814'=>'灰姑娘酒吧Cinderella','17660269'=>'新元素(悦达889店)','17669996'=>'西北狼烧烤','17695809'=>'V西食主义餐厅','17820144'=>'Harry&apos;s mini Bar','17892587'=>'海底捞火锅店(芳汇广场店)','17990017'=>'CJY MOO寿司','18003626'=>'蔓图咖啡店','18072019'=>'俏江龙(俏江龙宝山店)','18101512'=>'星巴克(东方商厦杨浦店)','18106405'=>'陀螺小灶','18242256'=>'韩时烤肉(悠唐广场店)','18390520'=>'虾启哄','18421600'=>'牛尖角创意烧肉(我格广场店)','18434228'=>'COSTACOFFEE(太古里店)','18448164'=>'顺风大酒店','18529321'=>'浦东金叶商务酒店','18554949'=>'小希尔顿万通酒店','18657864'=>'一品江湖','19226253'=>'微园阁','19236780'=>'野兽派小镇','19287141'=>'澳派牛排','19290716'=>'AMANDA 餐厅','19325286'=>'LUCE 意大利餐厅','19373473'=>'汉庭酒店(竹园路店)','19575634'=>'魔石咕噜鱼(新源路店)','19614662'=>'磨咖小镇','19620746'=>'瓦伦丁酒吧 V Bar','19671618'=>'Full House桌游密室棋牌(南京西路店)','19689610'=>'牛皮老爸','19697935'=>'Cafe de L’Avenue Pizza & Bistro(碧云店)','19811792'=>'Flask','19826603'=>'京樱日本料理','20677935'=>'满回轩火锅&炙子烤肉','20686021'=>'辣蝶重庆美蛙火锅','20831943'=>'蒸之馆','20842584'=>'溪雨观酸菜鱼(康桥店)','20939012'=>'板川寿司','21043893'=>'Light NightClub','21047943'=>'鱼蹦咖啡西餐厅','21084544'=>'西堤厚牛排(悦达889店)','21173802'=>'Finca 芬咖啡工作室','21182142'=>'川妹火锅(宁乡店)','21213105'=>'MENG CAFE','21278545'=>'1989烤坊','21284553'=>'木餐厅 WOOD Restaurant and Bar','21289332'=>'K歌之王(静安店)','21301762'=>'赫马汽车主题乐园','21310086'=>'caffebene','21383042'=>'利贞会法式铁板烧','21396434'=>'立丰','21404319'=>'MAGO KTV','21598402'=>'奥斯卡国际影城(金地广场)','21632771'=>'望海海鲜楼','21649203'=>'荣新馆.2号店','21662748'=>'Modo Ultra Club','21707216'=>'掌柜的店纯朴中原菜(江桥店)','21783146'=>'云港酒家','21824352'=>'HELLO，王鼎','21974439'=>'胡蝶正宗湘粉桌','22048686'=>'活力一番','22142132'=>'Thinker Cafe&Bar思想家咖啡书廊','22142687'=>'米+Mall日食料理所','22181024'=>'鼎王无老锅(静安店)','22249773'=>'明洞邦酒吧','22420608'=>'缘喜外带寿司(安亭店)','22444874'=>'Somm Wine Gallery红酒吧','22636012'=>'莎加soup saga','22725341'=>'imiss爱密室创意剧场','22733719'=>'云尊府(五道口)','22806540'=>'罗港园(虹口龙之梦店)','22882403'=>'美尚日本料理','22912244'=>'万岛日本料理铁板烧(吴中店)','23000744'=>'御青项记原味牛肉火锅(周浦店)','23080725'=>'江桥万达','23130614'=>'三人行精致日料','23162954'=>'小辉哥火锅(江桥万达店)','23217918'=>'牛德喜火锅食府','23308024'=>'Godiva(新天地店)','23327084'=>'鱼主义','23349119'=>'津城串吧JIN CHENG B.B.Q','23349663'=>'小胖烧烤','23422524'=>'烤鸡','23594453'=>'禅溪茶馆zenjoy','23603279'=>'极道真人密室逃脱(虹口足球场店)','23627205'=>'威尼斯西餐吧','23652451'=>'龙虾宝宝(上海旗舰店)','23749871'=>'多肉的下午茶时光','24071682'=>'石屋料理','24072335'=>'外婆家','24101534'=>'酒吧 衡山路','24509713'=>'好乐迪','24592521'=>'吃这里浓汤海鲜面','24748018'=>'五星海南鸡饭(新天地店)',
	],
];
