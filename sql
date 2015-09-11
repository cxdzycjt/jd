#1.创建供应商表
create table jd_supplier(
  id int unsigned primary key auto_increment comment '编号',
  name varchar(50) not null default '' comment '名字',
  sort tinyint not null default 50  comment '排序',
  status tinyint not null default 1 comment '是否显示1:表示显示,0: 表示不显示,-1:表示删除',
  intro text not null comment '简介'
)engine=MyISAM default charset utf8 comment '供应商';

#2.商品品牌表
create table jd_brand(
 id int UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'Id',
 brand_name varchar(50) not null default '' comment '商品分类名称',
 sort_order tinyint not null default 0 comment '品牌排序',
 is_show tinyint not null default 0 comment '是否显示@radio|1=是,0=否',
 brand_desc text comment '描述'
)engine=MyISAM default charset utf8 comment '商品品牌';

alter table jd_brand add column brand_logo varchar(150) not null default '' comment 'LOGO地址' after brand_name;

#3.商品表
CREATE TABLE jd_goods(
 goods_id int UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT '商品编号',
 goods_name VARCHAR(50) not null default '' comment '商品名称',
 goods_sn varchar(50) not null default 0 comment '商品货号',
 goods_classify smallint not null default 0 comment '商品分类',
 goods_brand varchar(50) not null default '' comment '商品品牌',
 goods_shop_price tinyint not null default 0 comment '商品本店售价',
 goods_number smallint not null default 0 comment '商品数量',
 goods_status tinyint not null default 1 comment '是否上架1:表示显示,0: 表示不显示,-1:表示删除',
 goods_recommend tinyint not null default 0 comment '是否加入推荐1:精品,2:新品,3:热销',
 goods_sort tinyint not null default 0 comment '商品排序',
 goods_bazaar_price tinyint not null default 0 comment '市场价格',
 goods_keywords varchar(100) not null default '' comment '商品关键字(用逗号隔开)',
 goods_logo varchar(100) not null default '' comment '商品LOGO',
 goods_intro text comment '商品描述'
)engine=INNODB default charset utf8 comment '商品表';