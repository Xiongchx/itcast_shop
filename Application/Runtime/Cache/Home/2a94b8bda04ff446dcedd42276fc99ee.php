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
<div id="slide">
	<?php if(is_array($cate)): $i = 0; $__LIST__ = array_slice($cate,0,9,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><div class="cate">
		<div class="cate1 left"><a href="/shop/Home/Index/find/cid/<?php echo ($v1["cid"]); ?>"><?php echo ($v1["cname"]); ?></a></div>
		<div class="subitem" style="display:none;">
			<?php if(isset($v1["child"])): if(is_array($v1["child"])): $i = 0; $__LIST__ = array_slice($v1["child"],0,7,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><dl><dt><a href="/shop/Home/Index/find/cid/<?php echo ($v2["cid"]); ?>"><?php echo ($v2["cname"]); ?></a></dt><dd>
				<?php if(isset($v2["child"])): if(is_array($v2["child"])): $i = 0; $__LIST__ = array_slice($v2["child"],0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v3): $mod = ($i % 2 );++$i;?>|<a href="/shop/Home/Index/find/cid/<?php echo ($v3["cid"]); ?>"><?php echo ($v3["cname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; ?></dd>
			</dl><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		</div>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="clear"></div>
</div>
<div id="hot" class="left"></div>
<div id="news" class="right">新闻列表</div>
<div class="clear"></div>
<div id="best">
	<div class="best-img left"></div>
	<?php if(is_array($best)): foreach($best as $key=>$v): ?><ul class="item left">
		<li><a href="/shop/Home/Index/goods/id/<?php echo ($v["gid"]); ?>" target="_blank"><?php if(empty($v["thumb"])): ?><img src="/shop/Public/image/preview.jpg"><?php else: ?><img src="/shop/Public/uploads/thumb/<?php echo ($v["thumb"]); ?>"><?php endif; ?></a></li>
		<li class="goods"><a href="/shop/Home/Index/goods/id/<?php echo ($v["gid"]); ?>" target="_blank"><?php echo ($v["gname"]); ?></a></li>
		<li class="price">￥<?php echo ($v["price"]); ?></li>
	</ul><?php endforeach; endif; ?>
	<div class="clear"></div>
</div>
<script>
	$(".cate").hover(function(){
		$(this).find(".subitem").show();
		$(this).find("a").addClass("on");
	},function(){
		$(this).find(".subitem").hide();
		$(this).find("a").removeClass("on");
	});
</script>
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