<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品评价-{$tpshop_config['shop_info_store_title']}</title>
    <meta http-equiv="keywords" content="{$tpshop_config['shop_info_store_keyword']}" />
    <meta name="description" content="{$tpshop_config['shop_info_store_desc']}" />
    <link rel="stylesheet" href="{{URL::asset('Static/css/index.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('Static/css/page.css')}}" type="text/css">
    <script src="{{URL::asset('Static/js/jquery-1.10.2.min.js"')}}"></script>
    <script src="{{URL::asset('Static/js/slider.js')}}"></script>
	<script src="{{URL::asset('js/global.js')}}"></script>
    <script src="{{URL::asset('js/pc_common.js')}}"></script>
	<script src="{{URL::asset('js/layer/layer.js')}}"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
</head>

<body>
<!--------头部开始-------------->
{{--<include file="Public/header" />--}}
@include('Home.Public.header')
<!--------头部结束-------------->

<div class="layout ov-hi">
    <div class="breadcrumb-area">    
	    <foreach name="navigate_user" key="k" item="v">
	        <if condition="$k neq '首页'"> > </if>  
            <a href="{$v}">{$k}</a> 
        </foreach>
    </div>
</div>
<div class="layout pa-to-10 fo-fa-ar">
    <!--菜单-->
    {{--<include file="User/menu" />--}}
    @include('Home.User.menu')
    <!--菜单-->
    <div class="fr wi940">
        <div class="he50 wddd">
            <div class="fl ddd-h2">
                <h2><span>商品评价</span></h2>
            </div>
            <div class="fr">
                <div class="po-re zjs">
                    <ul>
                        <li id="q-s" class="fl <if condition="$_GET['status'] neq '0' and $_GET['status'] neq '1'">cullent</if>"><a href="{:U('Home/User/comment')}"><span>全部&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a></li>
                        <li id="h-s" class="fl <if condition="$_GET['status'] eq '0'">cullent</if>"><a href="{:U('Home/User/comment',array('status'=>0))}"><span>待评价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a></li>
                        <li id="j-s" class="fl <if condition="$_GET['status'] eq '1'">cullent</if>"><a href="{:U('Home/User/comment',array('status'=>1))}"><span>已评价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a></li>
                    </ul>
                    <div class="ec-ta-x wi82" style="left:0"></div>
                </div>
            </div>
        </div>
        <div class="wddd-js ov-in">     
            <div class="list-group-title">
                <table class="merge-tab" border="0" cellpadding="0" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="col-pro">商品</th>
                        <th class=" wi240">状态</th>
                        <th class="col-operate">操作</th>
                    </tr>
                    </thead>
                </table>
            </div>
 <if condition="empty($comment_list)"><!--没查询到数据-->
     <p style="text-align:center"><img src="{{URL::asset('Static/images/null_data.jpg')}}" width="400"  /></p>
 </if>                 
            <volist name="comment_list" id="list">
            <div class="merge-list">
                <div class="ma-0--1">
                    <div class="o-info o-inff">
                        <div class="fl">
                            <input class="o-ch ve-al-mi" type="checkbox" />
                            <span class=" ma-ri-15 co-888 fo-si-14">{$list.add_time|date='Y-m-d H:i:s',###}</span>
                            <span class="ma-ri-15 co-888 fo-si-14">订单号：<a class="co-36c" href="">{$list.order_sn}</a></span>
                        </div>
                        <!--<div class="fr te-al co-888 wi138 fo-si-14">审核通过&nbsp;|&nbsp;待支付</div>-->
                    </div>
                    <div class="o-pro">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td class="col-pro-img">
                                    <p>
                                        <a title="{$list.goods_name}" href="" target="_blank">
                                            <img alt="{$list.goods_name}" src="{$list.goods_id|goods_thum_images=80,80}">
                                        </a>
                                    </p>
                                </td>
                                <td class="col-pro-info te-al-le"><p class="p-name">
                                    <a title="" target="_blank" href="">
                                        {$list.goods_name}
                                    </a>
                                </p></td>
                                <td class="wi240">
                                    <if condition="$list['is_comment'] eq 1">已评价<else/>未评价</if>
                                </td>
                                <td rowspan="1" class="col-operate">
                                    <if condition="$list['is_comment'] eq 0">
                                        <p class="p-link"><a onClick="comment({$list.order_id},{$list.goods_id})">立即评价</a></p>
                                    </if>
                                    <if condition="$list['is_comment'] eq 1">
                                        <p class="p-link"><a href="{:U('Home/Goods/goodsInfo',array('id'=>$list['goods_id']))}">查看评价</a></p>
                                    </if>
                                    <!--<p class="p-link" style="display:none"><a href="" >追评</a></p>-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <!--判断是否已经评论过-->
                <if condition="$list['is_comment'] eq 0">
                    <!--添加评论区域-->
                    <div class="eval-pj pa-to-20 ov-hi" id="div_{$list.order_id}_{$list.goods_id}" style="display: none">
                        <form action="{:U('Home/User/add_comment')}" data-test="formtest" method="post">
                            <input type="hidden" name="order_id" value="{$list.order_id}">
                            <input type="hidden" name="goods_id" value="{$list.goods_id}">
                            <div class="fwypj"><p>评价与晒图</p></div>
                            <div class="fl">
                                <div class="bd-fuwo pa-to-10">
                                    <textarea placeholder="可输入1-200字符" name="content" id="content" cols="70" rows="12"></textarea>                                    
                                    <!--<div onMouseOut="settext()" name="saytext" id="saytext" contenteditable="true" style="width: 509px;height: 257px;border: solid 1px #f2f4ff; background-color: #f5f5f5;color: #888;"></div>-->
                                </div>
                                <div class="eval-img ov-hi wi457 he130" id="img_container">
                                    <div class="ev-img po-re fl" id="add_img">
                                        <img src="" border="0" alt="" onClick="uploadimg('#div_{$list.order_id}_{$list.goods_id}')">
                                    </div>

                                </div>
                            </div>
                            <div class="fl pa-le-30">
                                <div class="pro-user-score cu-po">
                                    <span class="sf">商品与描述相符：</span>
                            <span>
                                <span class="starRating-area">
                                    <img onMouseMove="c(this,event)" src="{{URL::asset('Static/images/start/stars0.gif')}}" alt="">
                                    <input type="hidden" id="goods_rank" name="goods_rank" value="0">
                                </span>
                            </span>
                                </div>
                                <div class="pro-user-score cu-po">
                                    <span class="sf">客服服务质量：</span>
                            <span>
                                <span class="starRating-area">
                                    <img onMouseMove="c(this,event)" src="{{URL::asset('Static/images/start/stars0.gif')}}" alt="">
                                    <input type="hidden" id="service_rank" name="service_rank" value="0">
                                </span>
                            </span>
                                </div>
                                <div class="pro-user-score cu-po">
                                    <span class="sf">物流服务质量：</span>
                            <span>
                                <span class="starRating-area">
                                   <img onMouseMove="c(this,event)" src="{{URL::asset('Static/images/start/stars0.gif')}}" alt="">
                                    <input type="hidden" id="deliver_rank" name="deliver_rank" value="0">
                                </span>
                            </span>
                                </div>
                                <div class="merge ma-to-80 ma-le-7">
                                    <a class=" di-in-bl hb-merge" onClick="comment_submit(this)">提交</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--添加评论区域结束-->
                </if>
                <!--判断是否已经评论过结束-->

                <!--已经评论过-->
                <!--已经评论过结束-->

            </volist>

        </div>
        <div class="merge pager-paging fr">
        	{$page}
    	</div>
    </div>
    
</div>
<div class="he80"></div>
<!--------footer-开始-------------->
{{--<include file="Public/footer2" />--}}
@include('Home.Public.footer2')
<!--------footer-结束-------------->

<!--评论JS-->
<script>
    function c(obj,event){
        //var obj = $(obj);
        var objTop = getOffsetTop(obj);//对象x位置
        var objLeft = getOffsetLeft(obj);//对象y位置

        var mouseX = event.clientX+document.body.scrollLeft;//鼠标x位置
        var mouseY = event.clientY+document.body.scrollTop;//鼠标y位置
        //计算点击的相对位置
        var objX = mouseX-objLeft;
        var objY = mouseY-objTop;
        clickObjPosition = objX + "," + objY;
        if(objX < 13 && objX > 0){
            $(obj).attr('src','__STATIC__/images/start/stars1.gif');
            $(obj).next().val(1);
        }
        if(objX < 28 && objX > 13){
            $(obj).attr('src','__STATIC__/images/start/stars2.gif');
            $(obj).next().val(2);
        }
        if(objX < 43 && objX > 28){
            $(obj).attr('src','__STATIC__/images/start/stars3.gif');
            $(obj).next().val(3);
        }
        if(objX < 58 && objX > 43){
            $(obj).attr('src','__STATIC__/images/start/stars4.gif');
            $(obj).next().val(4);
        }
        if(objX < 74 && objX > 58){
            $(obj).attr('src','__STATIC__/images/start/stars5.gif');
            $(obj).next().val(5);
        }
        //alert(clickObjPosition);
    }

    function getOffsetTop(obj){
        var tmp = obj.offsetTop;
        var val = obj.offsetParent;
        while(val != null){
            tmp += val.offsetTop;
            val = val.offsetParent;
        }
        return tmp;
    }

    function getOffsetLeft(obj){
        var tmp = obj.offsetLeft;
        var val = obj.offsetParent;
        while(val != null){
            tmp += val.offsetLeft;
            val = val.offsetParent;
        }
        return tmp;
    }
</script>
<!--评论JS结束-->

<!--上传图片JS-->
<script>
    var now_access;
    function uploadimg(div){
        now_access = $(div);
        //检查是否超过限制数量
        GetUploadify2(5,'','comment.blade','add_img')
    }
    function delimg(file,t){
        $.get(
                "/index.php?m=Admin&c=Uploadify&a=delupload",{action:"del", filename:file},function(){}
        );
        $(t).remove();
        $('#img_container').find('#add_img').show();
    }
    function add_img(str){
        var tpl_list = String(str).split(',');
        for(var i=0;i<tpl_list.length;i++){
            //判断是否超过五个图片
            var obj = $(now_access).find('.comment_img');
            if(obj.length >= 5)
            return false;
            var tpl = '<div class="ev-img po-re fl comment_img" onclick="delimg(\'$IMG\',this)"><input type="hidden" name="comment_img[]" value="$IMG"><img src="$IMG" border="0" alt=""></div>';
            //var tpl = '<input type="hidden" name="comment_img[]" value="$IMG"><img width="150" height="150" src="$IMG" alt=""><button onclick="delimg(\'$IMG\',this)">删除</button>';
            var str_do = tpl.replace(/\$IMG/g,tpl_list[i]);
            $(now_access).find('#img_container').find('#add_img').before(str_do);
        }
//        $('#img_container').append(str);      
    }
</script>
<!--上传图片JS结束-->

<!--评论提交-->
<script>
    function comment(order_id,goods_id){
        var div = "#div_"+order_id+"_"+goods_id;
        $(div).toggle();
    }

    function comment_submit(t){
        //表单对象
        var form = $(t).parent().parent().parent();

        var service_rank = parseInt($(form).find('#service_rank').val());
        var deliver_rank = parseInt($(form).find('#deliver_rank').val());
        var goods_rank = parseInt($(form).find('#goods_rank').val());

        if(!service_rank> 0){
			layer.msg('请为商家服务评分', { icon: 1, time: 2000 });   //2秒关闭（如果不配置，默认是3秒）
            return false;
        }
        if(!deliver_rank> 0){
			layer.msg('请为物流评分', { icon: 1, time: 2000 });   //2秒关闭（如果不配置，默认是3秒）
            return false;
        }
        if(!goods_rank> 0){
			layer.msg('请为商品评分', { icon: 1, time: 2000 });   //2秒关闭（如果不配置，默认是3秒）
            return false;
        }
		 
        var data = $(form).serialize();
        $.ajax({
            type : "POST",
            url:"{:U('Home/User/add_comment')}",
            data :data,// 你的formid 搜索表单 序列化提交
            success: function(data){
                data = jQuery.parseJSON(data);
                //console.log(data);
                if(data.status == 1){
                    //评论成功
                     //alert('评论成功');
					layer.msg('评论成功', {
					  icon: 1,
					  time: 2000 //2秒关闭（如果不配置，默认是3秒）
					}, function(){
		                   location.reload();
					});
 
                }else{
                    $(form).parent().remove();
                    alert(data.msg);
                }
            }
        });
    }
</script>
<!--评论提交结束-->
</body>
<script>
    /*$(function () {
     $("#h-s").click(function () {
     $('.ec-ta-x').css('left','124px');
     $('.ec-ta-x').css('width','110px');
     $(this).addClass("cullent");
     $('#q-s').removeClass("cullent");
     });
     });
     */
</script>

<script>
    $(function () {
        $("#j-s").mouseover(function () {
            $('.ec-ta-x').css('left','188px');
            $('.ec-ta-x').css('width','70px');
            $(this).addClass("cullent");
        });
        $("#j-s").mouseout(function () {
            $('.ec-ta-x').css('left','0px');
            $('.ec-ta-x').css('width','82px');
            $(this).removeClass("cullent");
        });
    });
    $(function () {
        $("#h-s").mouseover(function () {
            $('.ec-ta-x').css('left','94px');
            $('.ec-ta-x').css('width','82px');
            $(this).addClass("cullent");
        });
        $("#h-s").mouseout(function () {
            $('.ec-ta-x').css('left','0px');
            $('.ec-ta-x').css('width','82px');
            $(this).removeClass("cullent");
        });
    });
    $(function () {
        $("#q-s").mouseover(function () {
            $('.ec-ta-x').css('left','0px');
            $(this).addClass("cullent");
        });
        $("#q-s").mouseout(function () {
            $('.ec-ta-x').css('left','0px');
        });
    });
    function settext(){
        //var text = $("#saytext").html();
        //$('#saytext2').html(text);
    }
	
</script>
</html>