
-- ----------------------------
-- Table structure for `t_goods`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods`;
CREATE TABLE `t_goods` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `c_title` varchar(255) NOT NULL COMMENT '商品名称',
  `c_short` varchar(150) NOT NULL DEFAULT '' COMMENT '短名称',
  `c_seo` varchar(255) NOT NULL DEFAULT '' COMMENT '标题优化',
  `c_keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `c_search_keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '商品搜索词库 逗号分隔',
  `c_description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `c_picture` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
  `c_number` varchar(50) NOT NULL DEFAULT '' COMMENT '商品货号',
  `c_unit` varchar(10) NOT NULL DEFAULT '' COMMENT '计量单位',
  `c_cost_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成本价格',
  `c_market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `c_sell_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售价格',
  `c_status` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '商品状态 1已上架 2待审核 3已下架',
  `c_brand_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '品牌ID',
  `c_model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `c_weight` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '重量',
  `c_exp` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '经验值',
  `c_point` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `c_favorite_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `c_grade_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评分总数',
  `c_sale_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '销售总量',
  `c_comment_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论次数',
  `c_store_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存总量',
  `c_hits_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击总数',
  `c_sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `c_up_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上架时间',
  `c_down_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下架时间',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of t_goods
-- ----------------------------
INSERT INTO `t_goods` VALUES ('1', 'asdfasdf', '', '', '', '', '', '2017/07/29/07/ce5f7b739028c79b50584f048f619b20.jpg,2017/07/29/07/908d40c2c59319c302826a300f451a1d.jpg,2017/07/29/07/2d9f1c5cbdfcd3341fa9850dd05f327f.jpg,2017/07/29/07/1e1629d2d12d727ba85b9cbca6450916.jpg,2017/07/29/07/6a860c5156e308cc3d8a56b9a976286f.jpg,', 'JJ150128548591', '件', '0.00', '0.00', '0.00', '2', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1501285518', '2017-07-29 07:45:18');
INSERT INTO `t_goods` VALUES ('2', 'sadfadf', '', '', '', '', '', '2017/07/29/08/6262c3b321971492a78a321d3c4e06f5.jpg', 'JJ150128641241', '件', '0.00', '0.00', '0.00', '2', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1501286528', '2017-07-29 08:34:49');

-- ----------------------------
-- Table structure for `t_goods_attr`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_attr`;
CREATE TABLE `t_goods_attr` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `c_attr_value` varchar(255) NOT NULL DEFAULT '' COMMENT '属性值',
  `c_attr_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '属性ID',
  `c_goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `c_model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品属性值表';

-- ----------------------------
-- Records of t_goods_attr
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_brand`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_brand`;
CREATE TABLE `t_goods_brand` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '品牌ID',
  `c_title` varchar(255) NOT NULL DEFAULT '' COMMENT '品牌名称',
  `c_picture` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `c_url` varchar(255) NOT NULL DEFAULT '' COMMENT '网址',
  `c_category_ids` varchar(255) NOT NULL DEFAULT '' COMMENT '品牌类别ID 逗号分割',
  `c_seo` varchar(255) NOT NULL DEFAULT '' COMMENT '标题优化',
  `c_keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `c_description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `c_sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品牌表';

-- ----------------------------
-- Records of t_goods_brand
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_brand_category`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_brand_category`;
CREATE TABLE `t_goods_brand_category` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '品牌类别ID',
  `c_title` varchar(50) NOT NULL COMMENT '类别名称',
  `c_sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `c_goods_category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品类别ID',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品牌类别表';

-- ----------------------------
-- Records of t_goods_brand_category
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_category`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_category`;
CREATE TABLE `t_goods_category` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品类别ID',
  `c_title` varchar(50) NOT NULL COMMENT '类别名称',
  `c_short` varchar(150) NOT NULL DEFAULT '' COMMENT '短标题',
  `c_seo` varchar(255) NOT NULL DEFAULT '' COMMENT '标题优化',
  `c_keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `c_description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `c_picture` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图地址',
  `c_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1正常 2无效',
  `c_parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `c_sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品类别表';

-- ----------------------------
-- Records of t_goods_category
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_category_extend`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_category_extend`;
CREATE TABLE `t_goods_category_extend` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `c_goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `c_category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品类别ID',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品与商品类别对应扩展表';

-- ----------------------------
-- Records of t_goods_category_extend
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_group_price`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_group_price`;
CREATE TABLE `t_goods_group_price` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `c_goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `c_group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `c_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  PRIMARY KEY (`c_id`),
  KEY `c_goods_id` (`c_goods_id`),
  KEY `c_group_id` (`c_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优先权大于用户组设定的折扣率';

-- ----------------------------
-- Records of t_goods_group_price
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_model`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_model`;
CREATE TABLE `t_goods_model` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型ID',
  `c_title` varchar(50) NOT NULL COMMENT '模型名称',
  `c_sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品模型表';

-- ----------------------------
-- Records of t_goods_model
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_model_attr`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_model_attr`;
CREATE TABLE `t_goods_model_attr` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `c_title` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `c_value` text COMMENT '属性值 逗号分隔',
  `c_type` tinyint(1) unsigned NOT NULL DEFAULT '4' COMMENT '输入控件的类型 1单选 2复选 3下拉 4输入框',
  `c_search` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '搜索 1支持2不支持',
  `c_model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品模型ID',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品模型属性表';

-- ----------------------------
-- Records of t_goods_model_attr
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_notify`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_notify`;
CREATE TABLE `t_goods_notify` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `c_mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `c_email` varchar(50) NOT NULL DEFAULT '' COMMENT 'email',
  `c_status` tinyint(1) unsigned NOT NULL DEFAULT '3' COMMENT '状态 1成功 2失败 3未发送',
  `c_goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `c_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `c_notify_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '通知时间',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品到货通知表';

-- ----------------------------
-- Records of t_goods_notify
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_text`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_text`;
CREATE TABLE `t_goods_text` (
  `c_goods_id` int(10) unsigned NOT NULL COMMENT 'ID',
  `c_content` text COMMENT '商品正文',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`c_goods_id`),
  UNIQUE KEY `c_goods_id` (`c_goods_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品正文表';
