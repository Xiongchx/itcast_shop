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
<div class="goodsinfo">
	<div class="now_cat">当前位置：<?php if(is_array($pcats)): foreach($pcats as $key=>$v): ?>&nbsp;<a 
		href="/shop/Home/Index/find/cid/<?php echo ($v["cid"]); ?>"><?php echo ($v["cname"]); ?></a>&nbsp;&gt;<?php endforeach; endif; ?>&nbsp;<?php echo ($goods["gname"]); ?></div>
	<div class="pic left"><?php if(empty($goods["thumb"])): ?><img src="/shop/Public/image/preview2.jpg" /><?php else: ?>
		<img src="/shop/Public/uploads/<?php echo ($goods["thumb"]); ?>" /><?php endif; ?></div>
	<div class="info left"><h1><?php echo ($goods["gname"]); ?></h1><table>
		<tr><th>售 价：</th><td><span>￥<?php echo ($goods["price"]); ?></span></td></tr>
		<tr><th>商品编号：</th><td><?php echo ($goods["identifier"]); ?></td></tr>
		<tr><th>累计销量：</th><td>1000</td></tr>
		<tr><th>评 价：</th><td>1000</td></tr>
		<tr><th>配送至：</th><td>北京（免运费）</td></tr>
		<tr><th>购买数量：</th><td>
			<input type="button" value="-" class="cnt-btn" />
			<input type="text" value="1" id="num" class="num-btn" />
			<input type="button" value="+" class="cnt-btn" />（库存：<?php echo ($goods["stock"]); ?>）</td></tr>
		<tr><td colspan="2" class="button"><a href="#">立即购买</a><a href="#" onclick="addCart()">加入购物车</a></td></tr>
		</table></div><div class="clear"></div>
	<div class="slide left">相关商品</div>
	<div class="desc left">
		<div class="attr"><p>商品属性</p><ul>
			<?php if(is_array($attr)): foreach($attr as $key=>$v): ?><li><?php echo ($v["aname"]); ?>：<?php echo ($v["avalue"]); ?></li><?php endforeach; endif; ?>
		<div class="clear"></div></ul></div>
	<?php echo (nl2br($goods["description"])); ?></div>
	<div class="clear"></div>
</div>
<script>
	//购买数量加减
	$(".cnt-btn").click(function(){
		var num = parseInt($("#num").val());
		if ($(this).val() === '-') {
			if ( num=== 1) return;
			$("#num").val(num-1);
		}else if ($(this).val() === '+') {
			if (num === <?php echo ($goods["stock"]); ?>) return;
			$("#num").val(num+1);
		}
	});
	//自动纠正购买数量
	$("#num").keyup(function(){
		var num = parseInt($(this).val());
		if(num<1){ 
			$(this).val(1);
		}else if(num > <?php echo ($goods["stock"]); ?>){
			$(this).val(<?php echo ($goods["stock"]); ?>);
		}
	});
	//添加购物车
	function addCart(){
		var num = $("#num").val();
		window.location.href = '/shop/Home/Cart/add/gid/<?php echo ($gid); ?>/num/'+num;
	}
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