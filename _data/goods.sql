
-- ----------------------------
-- Table structure for `t_goods`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods`;
CREATE TABLE `t_goods` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '��ƷID',
  `c_title` varchar(255) NOT NULL COMMENT '��Ʒ����',
  `c_short` varchar(150) NOT NULL DEFAULT '' COMMENT '������',
  `c_seo` varchar(255) NOT NULL DEFAULT '' COMMENT '�����Ż�',
  `c_keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '�ؼ���',
  `c_search_keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '��Ʒ�����ʿ� ���ŷָ�',
  `c_description` varchar(255) NOT NULL DEFAULT '' COMMENT '����',
  `c_picture` varchar(255) NOT NULL DEFAULT '' COMMENT '����ͼ',
  `c_number` varchar(50) NOT NULL DEFAULT '' COMMENT '��Ʒ����',
  `c_unit` varchar(10) NOT NULL DEFAULT '' COMMENT '������λ',
  `c_cost_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '�ɱ��۸�',
  `c_market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '�г��۸�',
  `c_sell_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '���ۼ۸�',
  `c_status` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '��Ʒ״̬ 1���ϼ� 2����� 3���¼�',
  `c_brand_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Ʒ��ID',
  `c_model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ģ��ID',
  `c_weight` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����',
  `c_exp` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ֵ',
  `c_point` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����',
  `c_favorite_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�ղش���',
  `c_grade_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��������',
  `c_sale_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��������',
  `c_comment_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '���۴���',
  `c_store_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�������',
  `c_hits_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�������',
  `c_sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����',
  `c_up_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�ϼ�ʱ��',
  `c_down_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�¼�ʱ��',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '������ʱ��',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='��Ʒ��';

-- ----------------------------
-- Records of t_goods
-- ----------------------------
INSERT INTO `t_goods` VALUES ('1', 'asdfasdf', '', '', '', '', '', '2017/07/29/07/ce5f7b739028c79b50584f048f619b20.jpg,2017/07/29/07/908d40c2c59319c302826a300f451a1d.jpg,2017/07/29/07/2d9f1c5cbdfcd3341fa9850dd05f327f.jpg,2017/07/29/07/1e1629d2d12d727ba85b9cbca6450916.jpg,2017/07/29/07/6a860c5156e308cc3d8a56b9a976286f.jpg,', 'JJ150128548591', '��', '0.00', '0.00', '0.00', '2', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1501285518', '2017-07-29 07:45:18');
INSERT INTO `t_goods` VALUES ('2', 'sadfadf', '', '', '', '', '', '2017/07/29/08/6262c3b321971492a78a321d3c4e06f5.jpg', 'JJ150128641241', '��', '0.00', '0.00', '0.00', '2', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1501286528', '2017-07-29 08:34:49');

-- ----------------------------
-- Table structure for `t_goods_attr`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_attr`;
CREATE TABLE `t_goods_attr` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '��������',
  `c_attr_value` varchar(255) NOT NULL DEFAULT '' COMMENT '����ֵ',
  `c_attr_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ID',
  `c_goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��ƷID',
  `c_model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ģ��ID',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='��Ʒ����ֵ��';

-- ----------------------------
-- Records of t_goods_attr
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_brand`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_brand`;
CREATE TABLE `t_goods_brand` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Ʒ��ID',
  `c_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ʒ������',
  `c_picture` varchar(255) NOT NULL DEFAULT '' COMMENT 'ͼƬ��ַ',
  `c_url` varchar(255) NOT NULL DEFAULT '' COMMENT '��ַ',
  `c_category_ids` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ʒ�����ID ���ŷָ�',
  `c_seo` varchar(255) NOT NULL DEFAULT '' COMMENT '�����Ż�',
  `c_keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '�ؼ���',
  `c_description` varchar(255) NOT NULL DEFAULT '' COMMENT '����',
  `c_sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '������ʱ��',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Ʒ�Ʊ�';

-- ----------------------------
-- Records of t_goods_brand
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_brand_category`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_brand_category`;
CREATE TABLE `t_goods_brand_category` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Ʒ�����ID',
  `c_title` varchar(50) NOT NULL COMMENT '�������',
  `c_sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����',
  `c_goods_category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��Ʒ���ID',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '������ʱ��',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Ʒ������';

-- ----------------------------
-- Records of t_goods_brand_category
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_category`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_category`;
CREATE TABLE `t_goods_category` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '��Ʒ���ID',
  `c_title` varchar(50) NOT NULL COMMENT '�������',
  `c_short` varchar(150) NOT NULL DEFAULT '' COMMENT '�̱���',
  `c_seo` varchar(255) NOT NULL DEFAULT '' COMMENT '�����Ż�',
  `c_keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '�ؼ���',
  `c_description` varchar(255) NOT NULL DEFAULT '' COMMENT '����',
  `c_picture` varchar(255) NOT NULL DEFAULT '' COMMENT '����ͼ��ַ',
  `c_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '״̬ 1���� 2��Ч',
  `c_parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ID',
  `c_sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '������ʱ��',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='��Ʒ����';

-- ----------------------------
-- Records of t_goods_category
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_category_extend`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_category_extend`;
CREATE TABLE `t_goods_category_extend` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '��������',
  `c_goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��ƷID',
  `c_category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��Ʒ���ID',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='��Ʒ����Ʒ����Ӧ��չ��';

-- ----------------------------
-- Records of t_goods_category_extend
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_group_price`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_group_price`;
CREATE TABLE `t_goods_group_price` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '��������',
  `c_goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��ƷID',
  `c_group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�û���ID',
  `c_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '�۸�',
  PRIMARY KEY (`c_id`),
  KEY `c_goods_id` (`c_goods_id`),
  KEY `c_group_id` (`c_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='����Ȩ�����û����趨���ۿ���';

-- ----------------------------
-- Records of t_goods_group_price
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_model`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_model`;
CREATE TABLE `t_goods_model` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ģ��ID',
  `c_title` varchar(50) NOT NULL COMMENT 'ģ������',
  `c_sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '������ʱ��',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='��Ʒģ�ͱ�';

-- ----------------------------
-- Records of t_goods_model
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_model_attr`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_model_attr`;
CREATE TABLE `t_goods_model_attr` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '��������',
  `c_title` varchar(255) NOT NULL DEFAULT '' COMMENT '����',
  `c_value` text COMMENT '����ֵ ���ŷָ�',
  `c_type` tinyint(1) unsigned NOT NULL DEFAULT '4' COMMENT '����ؼ������� 1��ѡ 2��ѡ 3���� 4�����',
  `c_search` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '���� 1֧��2��֧��',
  `c_model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��Ʒģ��ID',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '������ʱ��',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='��Ʒģ�����Ա�';

-- ----------------------------
-- Records of t_goods_model_attr
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_notify`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_notify`;
CREATE TABLE `t_goods_notify` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '��������',
  `c_mobile` char(11) NOT NULL DEFAULT '' COMMENT '�ֻ�',
  `c_email` varchar(50) NOT NULL DEFAULT '' COMMENT 'email',
  `c_status` tinyint(1) unsigned NOT NULL DEFAULT '3' COMMENT '״̬ 1�ɹ� 2ʧ�� 3δ����',
  `c_goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��ƷID',
  `c_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `c_notify_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '֪ͨʱ��',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='��Ʒ����֪ͨ��';

-- ----------------------------
-- Records of t_goods_notify
-- ----------------------------

-- ----------------------------
-- Table structure for `t_goods_text`
-- ----------------------------
DROP TABLE IF EXISTS `t_goods_text`;
CREATE TABLE `t_goods_text` (
  `c_goods_id` int(10) unsigned NOT NULL COMMENT 'ID',
  `c_content` text COMMENT '��Ʒ����',
  `c_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `c_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '������ʱ��',
  PRIMARY KEY (`c_goods_id`),
  UNIQUE KEY `c_goods_id` (`c_goods_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='��Ʒ���ı�';
