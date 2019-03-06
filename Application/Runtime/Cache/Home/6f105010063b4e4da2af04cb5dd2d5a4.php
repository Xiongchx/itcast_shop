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
<div class="usercenter">
<ul class="menu left">
	<li><a href="/shop/Home/User/index" id="User_index">个人信息</a></li>
	<li>我的订单</li>
	<li>我的关注</li>
	<li><a href="/shop/Home/User/addr" id="User_addr">收货地址</a></li>
	<li>消费记录</li>
	<li><a href="/shop/Home/Cart/index" id="Cart_index">购物车</a></li>
</ul>
<script>
$("#<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>").addClass("curr");
</script>
	<div class="content left">我的购物车
		<form method="post">
		<table border="1" id="shopcart">
			<tr class="tr-tit"><th class="w50"><a href="javascript:void(0);" onclick="checkedAll()">全选</a></th><th>商品</th><th class="w50">单价</th><th class="w92">数量</th><th class="w50">操作</th></tr>
			<?php if(is_array($cart)): foreach($cart as $key=>$v): ?><tr class="item">
				<td class="center"><input type="checkbox" class="check"/></td>
				<td><a href="/shop/Home/Index/goods/id/<?php echo ($v["gid"]); ?>" target="_blank"><?php echo ($v["gname"]); ?></a></td>
				<td class="center"><span class="item-price"><?php echo ($v["price"]); ?></span></td>
				<td><input class="setNum" type="button" value="-" /><input class="item-num" onkeyup="checkNum(this)" type="text" value="<?php echo ($v["num"]); ?>" name="num[]"/><input class="setNum"  type="button" value="+" /></td>
				<td class="center"><a href="/shop/Home/Cart/del/scid/<?php echo ($v["scid"]); ?>" />删除</a></td>
			</tr><?php endforeach; endif; ?>
			<tr><th><a href="javascript:void(0);" onclick="checkedAll()">全选</a></th><td colspan="4">删除选中的商品&nbsp;&nbsp;继续购物&nbsp;&nbsp;
				共<span id="num"></span>件商品 总计：<span class="price">￥<span id="monery"></span></span><input type="hidden" id="totalPrice" name="totalPrice"/>
				<input type="submit" value="提交订单" class="order-btn" />
			</td></tr>
		</table>
		</form>
	</div>
	<div class="clear"></div>
</div>
<script>
	//点击修改数量
	$(".setNum").click(function () {
		if ($(this).val() === '-') {
			if ($(this).next().val() !== '1') {
				var num = $(this).next().val() - 1;
				$(this).next().attr("value", num);
				$(this).next().val(num);
			}
		}else if ($(this).val() === '+') {
			if ($(this).prev().val() !== '100') {
				var num = parseInt($(this).prev().val()) + parseInt(1);
				$(this).prev().attr("value", num);
				$(this).prev().val(num);
			}
		}
		func();
	});
	//键盘修改数量
	function checkNum(obj) {
		//判断当前值是否合法   凡是不合法的都重置为1
		var num = $(obj).val();
		if (num <= 1 || num >= 100) {
			$(obj).val(1);
		}
		func();
	}
	//默认情况下，设置为全选状态
	$(function () {
		$(":checkbox").prop("checked", true);
		$(":checkbox").attr("checked", true);
		func();
	});
	//全选
	function checkedAll() {
		$(":checkbox").each(function () {
			if (this.checked) {
				$(this).prop("checked", false);
				$(this).attr("checked", false);
			} else {
				$(this).prop("checked", true);
				$(this).attr("checked", true);
			}
		});
		func();
	}
	//单个选择时的状态设置
	$(".check").click(function () {
		$(this).each(function (i, v) {
			if (!v.checked) {
				$(this).prop("checked", false);
				$(this).attr("checked", false);
			} else {
				$(this).prop("checked", true);
				$(this).attr("checked", true);
			}
		});
		func();
	});
	//计算总价
	function func() {
		var price = 0;
		var num = 0;
		var totalnum = 0;
		$(".item").find(":checkbox:checked").each(function () {
			$(this).closest("tr").find(".item-num").each(function () {
				totalnum += parseInt($(this).val());
				num = parseInt($(this).val());
				$(this).closest("tr").find(".item-price").each(function () {
					price += parseInt($(this).text()) * num;
				});
			});
		});
		$("#monery").text(price);
		$("#num").text(totalnum);
		$("#totalPrice").attr("value",price);
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