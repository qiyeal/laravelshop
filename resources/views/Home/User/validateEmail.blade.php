@extends('layouts.home')

@section('title','验证邮箱')

@section('content')
    <!--
    <script src="__STATIC__/js/jquery-1.10.2.min.js"></script>
    <script src="__STATIC__/js/slider.js"></script>
	<script src="__PUBLIC__/js/global.js"></script>
    <script src="__PUBLIC__/js/pc_common.js"></script>
	<script src="__PUBLIC__/js/layer/layer.js"></script>
-->
    <!--弹窗js 参考文档 http://layer.layui.com/-->
<div class="uc">
    <div class="uc_head">
        <div class="uc_head_middle">
            <div class="uc_head_middle_left">绑定邮箱</div>
            <div class="uc_head_middle_right"><a class="logout_c" href="/">首页</a> | <a class="logout_c" href="javascript:history.back(-1)">返回</a></div>
        </div>
    </div>
    {{--{{dd(session("email"))}}--}}
    <div class="uc_body pa-to-30">
        <div class="uc_body_form">
            <!--<div class="diraction_icon dir_icon1">-->
            <!--<ul class="diraction_dl">-->
            <!--<li>1 验证原邮箱</li>-->
            <!--<li>2 安全验证</li>-->
            <!--<li>3 新邮箱绑定</li>-->
            <!--<li>4 验证新邮箱</li>-->
            <!--</ul>-->
            <!--</div>-->
            <form action="" method="post" onSubmit="check_form();">
                <table class="changeAccount_theme">
                    <tbody>
                    <!--步骤二 验证新手机号码-->
                    <notempty name="user_info.email">
                        <tr class="tr_height">
                            <td class="cl_left fo-si-12" align="right"><label class="fo-si-12">原邮箱：</label></td>
                            <td class="cl_middle">
                                <input type="text" class="imput_text text_width foce" id="old_email" value="{{$email}}" name="old_email" readonly="readonly"
                                       style="cursor: not-allowed;color:#999">
                            </td>
                            <td>
                            </td>
                        </tr>
                    </notempty>
                    <tr class="tr_height">
                        <td class="cl_left fo-si-12" align="right"><label class="fo-si-12">新邮箱：</label></td>
                        <td class="cl_middle">
                            <input type="text" class="imput_text text_width foce" id="new_email" name="email">
                        </td>
                    </tr>
                    <tr class="tr_height">
                        <td align="right" class="cl_left">
                            验证码：
                        </td>
                        <td class="cl_middle">
                            <input type="text" id="new_code" maxlength="4" style="width:100px;" class="imput_text" name="code">
                            <input type="button" intervaltime="120" class="box-ok" value="获取验证码 " id="btnemailAuthCode2" onClick="sendCode(this,'new_email')">
                        </td>
                    </tr>

                    <!--步骤二 验证新手机号码结束-->
                    <tr class="tr_height">
                        <td valign="middle" align="center" colspan="3" style="height:120px;">
                            <input type="submit" value="下一步" class="btn_midefy" id="btn_next">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                    </tbody>
                </table>
            </form>

        </div>
    </div>

</div>

<script>
    // 表单提交验证
    function check_form() {
        var old_email = $('#old_email').val();
        var new_email = $('#new_email').val();
        //原邮箱不为空的情况下 验证格式
        //240874144@qq.com

        if (old_email != '' && typeof(old_email) != 'undefined') {
            if (!checkEmail(old_email)) {
                layer.alert('原邮箱格式错误', {icon: 2});//alert('原邮箱格式错误');
                return false;
            }
        }
        if (!checkEmail(new_email)) {
            layer.alert('新邮箱格式错误', {icon: 2});//alert('新邮箱格式错误');
            return false;
        }

        if ($.trim($('#new_code').val()) == '') {
            layer.alert('验证码不能为空', {icon: 2});//alert('验证码不能为空');
            return false;
        }

        //下一步
        var code = $("#new_code").val();
        var email = $("#new_email").val();
        $.post("{!!url('home/user/checkCode')!!}/"+code+"/"+email, {"_token":"{{csrf_token()}}"}, function(data){
            if(data == 1){
                layer.alert("邮箱验证成功", {icon: 2});
                history.back();
            }else{
                layer.alert(data, {icon: 2});
                history.back();
            }
        });
//        return false;
    }

    function sendCode(obj, input_id) {
        var id = $(obj).attr('id');
        var input = $('#' + input_id).val();

        var old_email = $('#old_email').val();
        //原邮箱不为空的情况下 验证格式
        if (old_email != '' && typeof(old_email) != 'undefined') {
            if (!checkEmail(old_email)) {
                layer.alert('原邮箱格式错误', {icon: 2});//alert('原邮箱格式错误');
                return false;
            }
        }
        if (!checkEmail(input)) {
            layer.alert('邮箱格式错误', {icon: 2});//alert('邮箱格式错误');
            return false;
        }
        if (input_id == 'old_email')
            var url = "/index.php?m=Home&c=User&a=send_validate_code&step=1&type=email&send=" + input;
        if (input_id == 'new_email')
            var url = '/home/user/emailCode/2/'+input;

        //发送验证码
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            error: function (request) {
                layer.alert('服务器繁忙, 请联系管理员!', {icon: 2});//alert("服务器繁忙, 请联系管理员!");
                return;
            },
            success: function (res) {

                if (res.status == 1) {
                    jsInnerTimeout(id);
                } else {
                    layer.alert(res.msg, {icon: 2});//alert('发送失败');
                }
            }
        });
    }

    //倒计时函数
    function jsInnerTimeout(id) {
        var codeObj = $("#" + id);
        var intAs = parseInt(codeObj.attr("IntervalTime"));

        intAs--;
        codeObj.attr("disabled", "disabled");
        if (intAs <= -1) {
            codeObj.removeAttr("disabled");
            codeObj.attr("IntervalTime", 120);
            codeObj.val("获取验证码");
            return true;
        }
        codeObj.val(intAs + 's后再次获取');
        codeObj.attr("IntervalTime", intAs);
        setTimeout("jsInnerTimeout('" + id + "')", 1000);
    }
    ;

</script>
@stop
