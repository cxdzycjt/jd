/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : jd

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2015-09-22 17:14:12
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='商品供应商';

-- ----------------------------
-- Records of jd_brand
-- ----------------------------
INSERT INTO `jd_brand` VALUES ('1', '华1', '/uploads/55f5485446da8.png', '12', '1', '华为华为华为华为', '1442116076');
INSERT INTO `jd_brand` VALUES ('2', '华为1', '/uploads/55f5485446da8.png', '1', '1', '华为华为', '12');
INSERT INTO `jd_brand` VALUES ('3', '诺基亚1', '/uploads/55f5485446da8.png', '2', '1', '诺基亚诺基亚诺基亚诺基亚', '1442116508');
INSERT INTO `jd_brand` VALUES ('4', '三星1', '/uploads/55f5485446da8.png', '1', '1', '三星三星三星三星', '1442116547');
INSERT INTO `jd_brand` VALUES ('5', '移动', '/uploads/55f5485446da8.png', '1', '1', '移动移动移动移动', '1442116599');
INSERT INTO `jd_brand` VALUES ('6', '诺基亚1', '/uploads/55f5485446da8.png', '1', '1', '诺基亚1', '1442116884');
INSERT INTO `jd_brand` VALUES ('7', '移动', '/uploads/55f5485446da8.png', '1', '2', '移动', '1442116898');
INSERT INTO `jd_brand` VALUES ('8', '网页', '/uploads/55f5485446da8.png', '1', '1', '网页网页网页', '1442137776');
INSERT INTO `jd_brand` VALUES ('9', 'img成功', '/uploads/55f5485446da8.png', '1', '1', 'img成功img成功img成功img成功', '1442138036');
INSERT INTO `jd_brand` VALUES ('10', '华为', '/uploads/55f5485446da8.png', '1', '1', '123123', '1442138201');
INSERT INTO `jd_brand` VALUES ('11', '华为', '/uploads/55f54a2b2e6c6.png', '1', '1', '321321', '1442138673');
INSERT INTO `jd_brand` VALUES ('12', '华为', '/uploads/55f54a2b2e6c6.png', '1', '1', '111111111111', '1442138736');
INSERT INTO `jd_brand` VALUES ('13', '华为', '/uploads/55f54a2b2e6c6.png', '1', '1', '33333333333', '1442138746');
INSERT INTO `jd_brand` VALUES ('14', '华为', '/uploads/55f54abfc85ac.png', '1', '1', '7777777777777777777', '1442138821');
INSERT INTO `jd_brand` VALUES ('15', '12', '', '123', '0', '23', '1442138930');
INSERT INTO `jd_brand` VALUES ('16', '12', '', '12', '0', '12', '1442138981');
INSERT INTO `jd_brand` VALUES ('17', '123', '', '123', '0', '123', '1442139039');
INSERT INTO `jd_brand` VALUES ('18', '华为88888', '/uploads/55f54d2cdc41f.png', '1', '2', '华为88888', '1442139079');
INSERT INTO `jd_brand` VALUES ('19', '华为1111', '/uploads/55f54bdf3a20b.png', '1', '1', '华为111', '1442139105');
INSERT INTO `jd_brand` VALUES ('20', '华为', '', '12', '0', '1', '1442139166');
INSERT INTO `jd_brand` VALUES ('21', '2', '', '2', '0', '222', '1442139174');
INSERT INTO `jd_brand` VALUES ('22', '图片上传', '/uploads/55f632bc63cf5.gif', '11', '1', '图片上传图片上传图片上传', '1442198215');
INSERT INTO `jd_brand` VALUES ('23', '', '', '1', '1', null, '0');
INSERT INTO `jd_brand` VALUES ('24', '22222', '/uploads/55f68ef461711.jpg', '2', '1', '22222', '1442221906');
INSERT INTO `jd_brand` VALUES ('25', '123', '/uploads/55f68f7ec390d.jpg', '123', '0', '123', '1442221952');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of jd_goods
-- ----------------------------
INSERT INTO `jd_goods` VALUES ('1', '测试11', 'SA921030095082439', '/uploads/55ff6da537e56.gif', '3', '6', '6', '222.00', '222.00', '1', '222', '1', '1', '<p>描述2222<br/></p>', '1', '1442826436');
INSERT INTO `jd_goods` VALUES ('2', '1添加的商品', 'SA921032359962027', '/uploads/55ff6e01004af.jpg', '8', '5', '5', '1.00', '1.00', '1', '1', '1', '1', '<p>2222<br/></p>', '1', '1442803234');
INSERT INTO `jd_goods` VALUES ('7', '商品', 'SA921159512524788', '/uploads/55ff9fcbd2c2e.jpg', '1', '8', '8', '12.00', '13.00', '1', '15', '1', '1', '<p>商品商品商品</p>', '1', '1442815950');
INSERT INTO `jd_goods` VALUES ('8', '', 'SA922864405742080', '', '1', '0', '0', '0.00', '0.00', '1', '0', '1', '1', '', '1', '1442886440');
INSERT INTO `jd_goods` VALUES ('9', '添加商品', 'SA922914828156088', '', '8', '6', '6', '5.00', '5.00', '2', '5', '1', '1', '<p>添加商品添加商品555</p>', '1', '1442891482');
INSERT INTO `jd_goods` VALUES ('10', '图片', 'SA922916300160272', '/uploads/5600c73f78732.jpg', '4', '22', '22', '22.00', '22.00', '1', '22', '1', '1', '<p>图片<br/></p>', '1', '1442891629');
INSERT INTO `jd_goods` VALUES ('11', '中级测试', 'SA922917061393723', '', '3', '6', '6', '2.00', '3.00', '1', '3', '1', '1', '<p>中级测试中级测试</p>', '1', '1442891706');
INSERT INTO `jd_goods` VALUES ('12', '手机', 'SA922103687518188', '/uploads/560110872764a.jpg', '3', '1', '6', '2.00', '2.00', '2', '3', '1', '1', '<p>手机手机手机</p>', '1', '1442910368');
INSERT INTO `jd_goods` VALUES ('13', '相片', 'SA922111308124002', '/uploads/560113811b157.jpg', '4', '5', '5', '2.00', '3.00', '1', '3', '1', '1', '<p>1111111<br/></p>', '1', '1442911130');

-- ----------------------------
-- Table structure for `jd_goodsgallery`
-- ----------------------------
DROP TABLE IF EXISTS `jd_goodsgallery`;
CREATE TABLE `jd_goodsgallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='商品相册';

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

-- ----------------------------
-- Table structure for `jd_goodsmemberprice`
-- ----------------------------
DROP TABLE IF EXISTS `jd_goodsmemberprice`;
CREATE TABLE `jd_goodsmemberprice` (
  `goods_id` int(10) unsigned DEFAULT NULL,
  `rank_id` int(10) unsigned DEFAULT NULL,
  `price` decimal(10,2) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
