/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : jd

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-10-07 23:09:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jd_admin`
-- ----------------------------
DROP TABLE IF EXISTS `jd_admin`;
CREATE TABLE `jd_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `username` varchar(100) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT 'emial',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `auth_key` char(6) NOT NULL DEFAULT '' COMMENT '加密key',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示@radio|1=是,0=否',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='管理员';

-- ----------------------------
-- Records of jd_admin
-- ----------------------------
INSERT INTO `jd_admin` VALUES ('3', 'admin', '73c02667951f22e6672ad9240861d5ea', 'admin@admin.com', '1444027029', '1444037735', '2130706433', 'KEwFtc', '1');
INSERT INTO `jd_admin` VALUES ('5', '26546916', 'c1371e0e948c486ba254cbd00c9e0b19', '26546916@qq.com', '1444037839', '0', '0', 'QSnfgi', '1');

-- ----------------------------
-- Table structure for `jd_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `jd_attribute`;
CREATE TABLE `jd_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goodsType_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型Id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型@radio|1=唯一,2=多值',
  `input_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '录入类型@radio|1=手工写入,2=下拉选择,3=多行文本',
  `value` varchar(255) NOT NULL DEFAULT '' COMMENT '备选值@textarea',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示@radio|1=是,0=否',
  `intro` text COMMENT '描述',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='商品属性';

-- ----------------------------
-- Records of jd_attribute
-- ----------------------------
INSERT INTO `jd_attribute` VALUES ('4', '1', '华为', '1', '1', 'IOS,Android,WinPhone', '50', '0', '华为', '1443011099');
INSERT INTO `jd_attribute` VALUES ('5', '1', '操作系统', '1', '2', 'IOS,Android,WinPhone', '0', '1', '操作系统', '1443101685');
INSERT INTO `jd_attribute` VALUES ('6', '2', '华硕', '2', '2', '笔记本,台式机', '0', '1', '华硕', '1443103446');
INSERT INTO `jd_attribute` VALUES ('7', '1', '颜色', '2', '2', '白色,红色,黑色', '50', '1', '颜色', '1443103677');
INSERT INTO `jd_attribute` VALUES ('8', '1', '网络模式', '1', '1', '', '50', '1', '网络模式网络模式', '1443103856');
INSERT INTO `jd_attribute` VALUES ('9', '1', '尺码', '2', '2', '40,41,42', '50', '1', '尺码', '1443270312');

-- ----------------------------
-- Table structure for `jd_brand`
-- ----------------------------
DROP TABLE IF EXISTS `jd_brand`;
CREATE TABLE `jd_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `logo` varchar(200) NOT NULL DEFAULT '' COMMENT 'LOGO地址',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示1:显示,0:不显示,-1:删除',
  `intro` text COMMENT '简介',
  `createTime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='商品供应商';

-- ----------------------------
-- Records of jd_brand
-- ----------------------------
INSERT INTO `jd_brand` VALUES ('27', '宝宝11', '/uploads/5601578fafbe4.png', '3', '1', '宝宝11宝宝11', '1442928532');
INSERT INTO `jd_brand` VALUES ('26', '华为1', '/uploads/560157528dee3.png', '2', '1', '华为1', '1442928508');

-- ----------------------------
-- Table structure for `jd_category`
-- ----------------------------
DROP TABLE IF EXISTS `jd_category`;
CREATE TABLE `jd_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品分类名称',
  `parent_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '父分类ID',
  `lft` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '左边界',
  `rght` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '右边界',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示@radio|1=是,0=否',
  `intro` text COMMENT '描述@textarea',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='商品分类';

-- ----------------------------
-- Records of jd_category
-- ----------------------------
INSERT INTO `jd_category` VALUES ('1', '顶级分类', '0', '1', '20', '1', '', '1442138036');
INSERT INTO `jd_category` VALUES ('2', '大家电', '1', '2', '19', '1', '', '1442138036');
INSERT INTO `jd_category` VALUES ('3', '平板电视', '2', '3', '4', '1', '', '1442138036');
INSERT INTO `jd_category` VALUES ('4', '空调', '2', '5', '6', '1', '', '1442138036');
INSERT INTO `jd_category` VALUES ('5', '冰箱', '2', '7', '18', '1', '', '1442138036');
INSERT INTO `jd_category` VALUES ('6', '生活电器', '5', '8', '17', '1', '', '1442568672');
INSERT INTO `jd_category` VALUES ('7', '取暖器', '6', '9', '10', '1', '', '1442138036');
INSERT INTO `jd_category` VALUES ('8', '净化器', '6', '11', '12', '1', '', '1442138036');
INSERT INTO `jd_category` VALUES ('9', '加湿器', '6', '13', '14', '1', '', '1442138036');
INSERT INTO `jd_category` VALUES ('10', '小太阳', '7', '15', '16', '1', '', '1442138036');

-- ----------------------------
-- Table structure for `jd_goods`
-- ----------------------------
DROP TABLE IF EXISTS `jd_goods`;
CREATE TABLE `jd_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `sn` varchar(50) NOT NULL DEFAULT '' COMMENT '货号',
  `logo` varchar(100) NOT NULL DEFAULT '' COMMENT 'LOGO',
  `category_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '分类Id',
  `brand_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '品牌Id',
  `supplier_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '供应商Id',
  `goodsType_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品类型',
  `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `shop_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '本店价',
  `store_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '库存类型@radio|1=单品,2=多品(多属性统计)',
  `store_num` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '商品数量',
  `is_on_sale` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否上架@radio|1=上架,0=下架',
  `goods_status` int(11) NOT NULL DEFAULT '1' COMMENT '商品状态',
  `intro` text COMMENT '描述@textarea',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否删除,0表示删除,1表示正常',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of jd_goods
-- ----------------------------
INSERT INTO `jd_goods` VALUES ('1', '测试11', 'SA921030095082439', '/uploads/55ff6da537e56.gif', '3', '6', '6', '0', '222.00', '222.00', '1', '222', '1', '1', '<p>描述2222<br/></p>', '1', '1442826436');
INSERT INTO `jd_goods` VALUES ('2', '1添加的商品', 'SA921032359962027', '/uploads/55ff6e01004af.jpg', '8', '5', '5', '0', '1.00', '1.00', '1', '1', '1', '1', '<p>2222<br/></p>', '1', '1442803234');
INSERT INTO `jd_goods` VALUES ('7', '商品', 'SA921159512524788', '/uploads/55ff9fcbd2c2e.jpg', '1', '8', '8', '0', '12.00', '13.00', '1', '15', '1', '1', '<p>商品商品商品</p>', '1', '1442815950');
INSERT INTO `jd_goods` VALUES ('8', '', 'SA922864405742080', '', '1', '0', '0', '0', '0.00', '0.00', '1', '0', '1', '1', '', '1', '1442886440');
INSERT INTO `jd_goods` VALUES ('9', '添加商品', 'SA922914828156088', '', '8', '6', '6', '0', '5.00', '5.00', '2', '5', '1', '1', '<p>添加商品添加商品555</p>', '1', '1442891482');
INSERT INTO `jd_goods` VALUES ('10', '图片', 'SA922916300160272', '/uploads/5600c73f78732.jpg', '4', '22', '22', '0', '22.00', '22.00', '1', '22', '1', '1', '<p>图片<br/></p>', '1', '1442891629');
INSERT INTO `jd_goods` VALUES ('11', '中级测试', 'SA922917061393723', '', '3', '6', '6', '0', '2.00', '3.00', '1', '3', '1', '1', '<p>中级测试中级测试</p>', '1', '1442891706');
INSERT INTO `jd_goods` VALUES ('12', '手机', 'SA922103687518188', '/uploads/560110872764a.jpg', '3', '1', '6', '0', '2.00', '2.00', '2', '3', '1', '1', '<p>手机手机手机</p>', '1', '1442910368');
INSERT INTO `jd_goods` VALUES ('13', '相片', 'SA922111308124002', '/uploads/560113811b157.jpg', '4', '5', '5', '0', '2.00', '3.00', '1', '3', '1', '1', '<p>1111111<br/></p>', '1', '1442911130');
INSERT INTO `jd_goods` VALUES ('14', '商品', 'SA923153081364534', '/uploads/5602aa726705f.png', '3', '0', '6', '1', '3.00', '4.00', '1', '4', '1', '1', '', '1', '1443015308');
INSERT INTO `jd_goods` VALUES ('15', '商品测试', 'SA924044115223014', '', '3', '27', '6', '0', '2.00', '3.00', '1', '4', '1', '1', '', '1', '1443104411');
INSERT INTO `jd_goods` VALUES ('18', '测试2222', 'SA924054600962805', '', '4', '27', '6', '0', '3.00', '4.00', '1', '5', '1', '1', '', '1', '1443105460');
INSERT INTO `jd_goods` VALUES ('19', '123', 'SA924054872968388', '', '4', '0', '6', '1', '4.00', '5.00', '1', '6', '1', '1', '', '1', '1443105487');
INSERT INTO `jd_goods` VALUES ('20', '12', 'SA925825751243284', '', '1', '27', '5', '0', '3.00', '4.00', '1', '4', '1', '1', '', '0', '1443182575');
INSERT INTO `jd_goods` VALUES ('21', '12', 'SA925825848808831', '', '3', '27', '5', '0', '3.00', '4.00', '1', '4', '1', '1', '', '0', '1443182584');
INSERT INTO `jd_goods` VALUES ('22', '12', 'SA925825907732105', '', '3', '27', '5', '0', '3.00', '4.00', '1', '4', '1', '1', '', '0', '1443182590');
INSERT INTO `jd_goods` VALUES ('23', '12', 'SA925826185718049', '', '3', '27', '5', '0', '3.00', '4.00', '1', '4', '1', '1', '', '0', '1443182618');
INSERT INTO `jd_goods` VALUES ('24', '测试', 'SA925828260556789', '/uploads/560538d5e7d14.png', '4', '27', '6', '1', '4.00', '3.00', '1', '2', '1', '1', '<p>测试测试</p>', '1', '1443182826');

-- ----------------------------
-- Table structure for `jd_goodsgallery`
-- ----------------------------
DROP TABLE IF EXISTS `jd_goodsgallery`;
CREATE TABLE `jd_goodsgallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='商品相册';

-- ----------------------------
-- Records of jd_goodsgallery
-- ----------------------------
INSERT INTO `jd_goodsgallery` VALUES ('2', '11', '/uploads/56010d7120c17.jpg');
INSERT INTO `jd_goodsgallery` VALUES ('6', '12', '/uploads/5601109e215dc.jpg');
INSERT INTO `jd_goodsgallery` VALUES ('12', '2', '/uploads/560112f40b32b.jpg');
INSERT INTO `jd_goodsgallery` VALUES ('13', '2', '/uploads/560112f43475c.jpg');
INSERT INTO `jd_goodsgallery` VALUES ('14', '2', '/uploads/560112f459155.jpg');
INSERT INTO `jd_goodsgallery` VALUES ('15', '2', '/uploads/5601134eb2f7e.jpg');
INSERT INTO `jd_goodsgallery` VALUES ('16', '2', '/uploads/5601134ee7762.jpg');
INSERT INTO `jd_goodsgallery` VALUES ('17', '13', '/uploads/560113943346b.jpg');
INSERT INTO `jd_goodsgallery` VALUES ('18', '14', '/uploads/5602aa8a61be2.png');
INSERT INTO `jd_goodsgallery` VALUES ('19', '15', '/uploads/560406986caca.png');
INSERT INTO `jd_goodsgallery` VALUES ('20', '24', '/uploads/560538e29152f.png');

-- ----------------------------
-- Table structure for `jd_goodsmemberprice`
-- ----------------------------
DROP TABLE IF EXISTS `jd_goodsmemberprice`;
CREATE TABLE `jd_goodsmemberprice` (
  `goods_id` int(10) unsigned DEFAULT NULL,
  `rank_id` int(10) unsigned DEFAULT NULL,
  `price` decimal(10,2) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员价格表';

-- ----------------------------
-- Records of jd_goodsmemberprice
-- ----------------------------
INSERT INTO `jd_goodsmemberprice` VALUES ('1', '1', '10.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('1', '2', '20.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('1', '3', '30.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('9', '6', '30.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('9', '7', '20.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('9', '8', '10.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('11', '6', '100.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('11', '7', '90.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('11', '8', '80.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('12', '6', '45.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('12', '7', '44.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('12', '8', '43.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('2', '6', '1.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('2', '7', '2.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('2', '8', '3.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('13', '6', '22.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('13', '7', '33.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('13', '8', '44.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('14', '6', '12.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('14', '7', '23.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('14', '8', '34.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('15', '6', '4.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('15', '7', '4.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('15', '8', '4.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('18', '6', '3.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('18', '7', '3.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('18', '8', '3.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('24', '6', '1.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('24', '7', '2.00');
INSERT INTO `jd_goodsmemberprice` VALUES ('24', '8', '3.00');

-- ----------------------------
-- Table structure for `jd_goodstype`
-- ----------------------------
DROP TABLE IF EXISTS `jd_goodstype`;
CREATE TABLE `jd_goodstype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示@radio|1=是,0=否',
  `intro` text COMMENT '描述',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商品类型';

-- ----------------------------
-- Records of jd_goodstype
-- ----------------------------
INSERT INTO `jd_goodstype` VALUES ('1', '手机', '50', '1', '手机', '1442929018');
INSERT INTO `jd_goodstype` VALUES ('2', '电脑', '50', '1', '电脑', '1442929118');
INSERT INTO `jd_goodstype` VALUES ('3', '相机', '50', '1', '相机', '1442929129');
INSERT INTO `jd_goodstype` VALUES ('4', '衣服', '50', '1', '衣服', '1442929140');

-- ----------------------------
-- Table structure for `jd_particulars`
-- ----------------------------
DROP TABLE IF EXISTS `jd_particulars`;
CREATE TABLE `jd_particulars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品Id',
  `attribute_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '属性Id',
  `value` varchar(255) NOT NULL DEFAULT '' COMMENT '属性值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='货品属性';

-- ----------------------------
-- Records of jd_particulars
-- ----------------------------
INSERT INTO `jd_particulars` VALUES ('9', '14', '5', 'IOS');
INSERT INTO `jd_particulars` VALUES ('10', '14', '7', '白色');
INSERT INTO `jd_particulars` VALUES ('11', '14', '7', '红色');
INSERT INTO `jd_particulars` VALUES ('12', '14', '8', 'CDMA');
INSERT INTO `jd_particulars` VALUES ('47', '24', '5', 'Android');
INSERT INTO `jd_particulars` VALUES ('48', '24', '7', '白色');
INSERT INTO `jd_particulars` VALUES ('49', '24', '7', '红色');
INSERT INTO `jd_particulars` VALUES ('50', '24', '8', 'CDMA');
INSERT INTO `jd_particulars` VALUES ('51', '24', '9', '40');
INSERT INTO `jd_particulars` VALUES ('52', '24', '9', '41');

-- ----------------------------
-- Table structure for `jd_permission`
-- ----------------------------
DROP TABLE IF EXISTS `jd_permission`;
CREATE TABLE `jd_permission` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT 'URL',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父权限',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT '左边界',
  `rght` int(11) NOT NULL DEFAULT '0' COMMENT '右边界',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '级别',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示@radio|1=启用,0=禁用',
  `createTime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of jd_permission
-- ----------------------------
INSERT INTO `jd_permission` VALUES ('2', '最大权限', '', '0', '1', '18', '0', '1', '1444222257');
INSERT INTO `jd_permission` VALUES ('3', '商品管理', '', '2', '4', '17', '0', '1', '1444223385');
INSERT INTO `jd_permission` VALUES ('4', '商品列表', '/goods/index', '3', '5', '10', '0', '1', '1444222462');
INSERT INTO `jd_permission` VALUES ('5', '订单管理', '', '2', '0', '3', '0', '1', '1444222502');
INSERT INTO `jd_permission` VALUES ('6', '订单列表', '/order/index', '5', '1', '2', '0', '1', '1444222530');
INSERT INTO `jd_permission` VALUES ('7', '商品分类', '/category/index', '3', '11', '16', '0', '1', '1444223960');
INSERT INTO `jd_permission` VALUES ('8', '添加修改商品', '/goods/edit', '4', '6', '7', '0', '1', '1444224183');
INSERT INTO `jd_permission` VALUES ('9', '删除商品', '/goods/del', '4', '8', '9', '0', '1', '1444224281');
INSERT INTO `jd_permission` VALUES ('10', '添加修改分类', '/category/edit', '7', '12', '13', '0', '1', '1444224337');
INSERT INTO `jd_permission` VALUES ('11', '删除商品分类', '/category/del', '7', '14', '15', '0', '1', '1444225795');

-- ----------------------------
-- Table structure for `jd_product`
-- ----------------------------
DROP TABLE IF EXISTS `jd_product`;
CREATE TABLE `jd_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品Id',
  `goods_attribute_ids` varchar(100) NOT NULL DEFAULT '0' COMMENT '商品组合Id',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `stock` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='产品';

-- ----------------------------
-- Records of jd_product
-- ----------------------------
INSERT INTO `jd_product` VALUES ('5', '24', '48,51', '11.00', '1');
INSERT INTO `jd_product` VALUES ('6', '24', '48,52', '22.00', '2');
INSERT INTO `jd_product` VALUES ('7', '24', '49,51', '22.00', '3');

-- ----------------------------
-- Table structure for `jd_rank`
-- ----------------------------
DROP TABLE IF EXISTS `jd_rank`;
CREATE TABLE `jd_rank` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `score_bottom` int(11) NOT NULL DEFAULT '0' COMMENT '经验值下限',
  `score_top` int(11) NOT NULL DEFAULT '0' COMMENT '经验值上限',
  `discount` int(11) NOT NULL DEFAULT '0' COMMENT '折扣率%',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示@radio|1=是,0=否',
  `createTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='会员级别';

-- ----------------------------
-- Records of jd_rank
-- ----------------------------
INSERT INTO `jd_rank` VALUES ('6', '注册会员', '0', '10000', '100', '1', '1442891394');
INSERT INTO `jd_rank` VALUES ('7', '中级会员', '10001', '40000', '90', '1', '1442891412');
INSERT INTO `jd_rank` VALUES ('8', '高级会员', '40001', '100000', '80', '1', '1442891429');

-- ----------------------------
-- Table structure for `jd_role`
-- ----------------------------
DROP TABLE IF EXISTS `jd_role`;
CREATE TABLE `jd_role` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示@radio|1=启用,0=禁用',
  `intro` text COMMENT '描述',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of jd_role
-- ----------------------------
INSERT INTO `jd_role` VALUES ('20', '货品管理员', '1', '货品管理员', '1444230283');

-- ----------------------------
-- Table structure for `jd_rolepermission`
-- ----------------------------
DROP TABLE IF EXISTS `jd_rolepermission`;
CREATE TABLE `jd_rolepermission` (
  `role_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `permission_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权限ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限和角色中间表';

-- ----------------------------
-- Records of jd_rolepermission
-- ----------------------------
INSERT INTO `jd_rolepermission` VALUES ('20', '3');
INSERT INTO `jd_rolepermission` VALUES ('20', '4');
INSERT INTO `jd_rolepermission` VALUES ('20', '8');
INSERT INTO `jd_rolepermission` VALUES ('20', '9');
INSERT INTO `jd_rolepermission` VALUES ('20', '7');
INSERT INTO `jd_rolepermission` VALUES ('20', '10');
INSERT INTO `jd_rolepermission` VALUES ('20', '11');

-- ----------------------------
-- Table structure for `jd_supplier`
-- ----------------------------
DROP TABLE IF EXISTS `jd_supplier`;
CREATE TABLE `jd_supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '供应商Id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '供应商名称',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(10) NOT NULL DEFAULT '1' COMMENT '是否显示1:显示,0:不显示,-1:删除',
  `intro` text COMMENT '供应商简介',
  `createTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='商品供应商';

-- ----------------------------
-- Records of jd_supplier
-- ----------------------------
INSERT INTO `jd_supplier` VALUES ('6', '捷利1', '11', '1', '捷利捷利捷利', '1441984766');
INSERT INTO `jd_supplier` VALUES ('5', '供应商1', '4', '1', '供应商供应商', '1441984029');
INSERT INTO `jd_supplier` VALUES ('4', '成都供应商2', '11', '2', '成都商家', '1441979522');
INSERT INTO `jd_supplier` VALUES ('8', '北京1', '22', '1', '北京北京北京', '1441985160');
INSERT INTO `jd_supplier` VALUES ('9', '天津2', '333', '1', '北京北京北京北京北京', '1441985178');
INSERT INTO `jd_supplier` VALUES ('10', '上海1', '3', '1', '北京北京北京', '1441985192');
INSERT INTO `jd_supplier` VALUES ('11', '重庆2', '1', '1', '重庆重庆重庆重庆', '1441985204');
INSERT INTO `jd_supplier` VALUES ('12', '上海', '6', '1', '上海上海上', '1442072863');
INSERT INTO `jd_supplier` VALUES ('14', '123123', '1', '1', '12312312', '1442197825');
INSERT INTO `jd_supplier` VALUES ('13', '12312', '1', '1', '123123213', '1442196631');
INSERT INTO `jd_supplier` VALUES ('15', '123', '1', '1', '123123', '1442209361');
INSERT INTO `jd_supplier` VALUES ('16', '12312', '1', '1', '3123123', '1442209396');
INSERT INTO `jd_supplier` VALUES ('17', '22222', '1', '1', '2222', '1442220872');
INSERT INTO `jd_supplier` VALUES ('18', '测试', '1', '1', '测试测试', '1442213090');
INSERT INTO `jd_supplier` VALUES ('19', '1111111111', '1', '1', '1111111111111', '1442220884');
INSERT INTO `jd_supplier` VALUES ('20', '8888888', '1', '1', '8888', '1442221286');
INSERT INTO `jd_supplier` VALUES ('21', '测试合并代码1', '1', '1', '测试合并代码测试合并代码1', '1442221378');
INSERT INTO `jd_supplier` VALUES ('22', 'img测试', '1', '1', 'img测试img测试', '1442221420');
INSERT INTO `jd_supplier` VALUES ('23', '添加测试', '1', '1', '添加测试', '1442305492');
