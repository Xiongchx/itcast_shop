<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>传智商城</title>
	<link href="/shop/Public/css/home.css" rel="stylesheet" />
	<script src="/shop/Public/js/jquery.min.js"></script>
</head>
<body>
	<div id="top">
		<div class="top_nav">
		<ul><li>收藏本站</li><li>关注本站</li></ul>
		<ul class="right">
			<?php if(isset($mid)): ?><li><?php echo ($mname); ?>，欢迎来到传智商城！[<a href="/shop/Home/User/logout">退出</a>]<li>
			<?php else: ?>
			<li>您好，欢迎来到传智商城！[<a href="/shop/Home/User/login">登录</a>][<a href="/shop/Home/User/register">免费注册</a>]</li><?php endif; ?>
			<li class="line">|</li><li>我的订单</li>
			<li class="line">|</li><li><a href="/shop/Home/User/index">会员中心</a></li>
			<li class="line">|</li><li><a href="/shop/Home/Cart/index">我的购物车</a></li>
			<li class="line">|</li><li>联系客服</li>
		</ul>
		</div>
	</div>
	<div id="box">
		<div id="header">
			<a class="left" href="/shop/"><div id="logo"></div></a>
			<div id="search" class="left">
				<input type="text" class="left" />
				<input class="search_btn" type="button" value="搜索" />
				<p id="search_hot">热门搜索：PHP培训　大学教材　智能手机　平板电脑</p>
			</div>
			<div id="info" class="left">
				<input type="button" value="会员中心" />
				<input type="button" value="去购物车结算" />
			</div>
		</div>
		<div class="clear"></div>
		<div id="nav">
			<ul><li class="category"><a href="#">全部商品分类</a></li><li class="curr"><a href="/shop/">首页</a></li>
				<li><a href="#">PHP</a></li><li><a href="#">Java</a></li><li><a href="#">安卓</a></li>
				<li><a href="#">.Net</a></li><li><a href="#">C/C++</a></li><li><a href="#">IOS</a></li>
			</ul>
		</div>
<div class="left" id="find-left">相关分类、相关推荐</div>
<div class="left" id="find-right">
	<ul class="filter">
		<li class="filter-title"><?php echo ($cname); ?>分类 商品筛选</li>
		<li><p>价格：</p><a
			href="<?php echo mkFilterURL('price', '0-0');?>" <?php if(empty($_GET['min_p'])&&empty($_GET['max_p'])): ?>class="curr"<?php endif; ?> >全部</a><a
			href="<?php echo mkFilterURL('price', '0-49');?>" <?php if(isset($_GET['max_p'])&&$_GET['max_p']==49): ?>class="curr"<?php endif; ?> >0-49</a><a
			href="<?php echo mkFilterURL('price', '50-99');?>" <?php if(isset($_GET['max_p'])&&$_GET['max_p']==99): ?>class="curr"<?php endif; ?> >50-99</a><a
			href="<?php echo mkFilterURL('price', '100-299');?>" <?php if(isset($_GET['max_p'])&&$_GET['max_p']==299): ?>class="curr"<?php endif; ?> >100-299</a><a
			href="<?php echo mkFilterURL('price', '300-0');?>" <?php if(isset($_GET['min_p'])&&$_GET['min_p']==300): ?>class="curr"<?php endif; ?> >300以上</a></li>
		<li><p>排序：</p><a
			href="<?php echo mkFilterURL('order');?>" <?php if(empty($_GET['order'])): ?>class="curr"<?php endif; ?> >最新上架</a><a 
			href="<?php echo mkFilterURL('order','price_asc');?>" <?php if(isset($_GET['order'])&&$_GET['order']=='price_asc'): ?>class="curr"<?php endif; ?> >价格升序</a><a
			href="<?php echo mkFilterURL('order','price_desc');?>" <?php if(isset($_GET['order'])&&$_GET['order']=='price_desc'): ?>class="curr"<?php endif; ?> >价格降序</a></li>
		<?php if(is_array($attr)): foreach($attr as $key=>$v1): ?><li><p><?php echo ($v1["aname"]); ?>：</p><a
			href="<?php echo mkFilterURL('aid'.$v1['aid']);?>" <?php if(!isset($_GET['aid'.$v1['aid']])): ?>class="curr"<?php endif; ?> >全部</a><?php if(is_array($v1["a_def_val"])): foreach($v1["a_def_val"] as $key=>$v2): ?><a
			href="<?php echo mkFilterURL('aid'.$v1['aid'],$v2);?>" <?php if(isset($_GET['aid'.$v1['aid']])&&$_GET['aid'.$v1['aid']]==$v2): ?>class="curr"<?php endif; ?> ><?php echo ($v2); ?></a><?php endforeach; endif; ?>
		</li><?php endforeach; endif; ?>
	</ul>
	<div class="find-item">
		<?php if(is_array($goods["list"])): foreach($goods["list"] as $key=>$v): ?><ul class="item left">
			<li><a href="/shop/Home/Index/goods/id/<?php echo ($v["gid"]); ?>" target="_blank"><?php if(empty($v["thumb"])): ?><img src="/shop/Public/image/preview.jpg"><?php else: ?><img src="/shop/Public/uploads/thumb/<?php echo ($v["thumb"]); ?>"><?php endif; ?></a></li>
			<li class="goods"><a href="/shop/Home/Index/goods/id/<?php echo ($v["gid"]); ?>" target="_blank"><?php echo ($v["gname"]); ?></a></li>
			<li class="price">￥<?php echo ($v["price"]); ?></li>
		</ul><?php endforeach; endif; ?>
		<div class="clear"></div>
		<div class="pagelist"><?php echo ($goods["page"]); ?></div>
	</div>
</div>
<div class="clear"></div>
		<div id="service">
			<ul><li>购物指南</li><li>配送方式</li><li>支付方式</li>
				<li>售后服务</li><li>特色服务</li><li>网络服务</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="footer">传智商城·本项目仅供学习使用</div>
	</div>
</body>
</html>