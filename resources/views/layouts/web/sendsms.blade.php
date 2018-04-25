<script>
    var InterValObj; //timer变量，控制时间
    var count = 120; //间隔函数，1秒执行
    var curCount; //当前剩余秒数
    function sendMessage() {
        var checkResult = check();
        if (!checkResult) {
            return false;
        }

        $.post('/sendmsg', {mobile: $('#mobile').val(), 'code': $('#code').val(), 'source' : source}, function (res) {
            alert(res.message);
        }, 'json');
        curCount = count;
        //设置button效果，开始计时
        $("#btnSendCode").attr("disabled", "true");
        $("#btnSendCode").val(curCount + "S后再次发送");
        InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
    }

    //timer处理函数
    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $("#btnSendCode").removeAttr("disabled");//启用按钮
            $("#btnSendCode").val("重发验证码");
        }
        else {
            curCount--;
            $("#btnSendCode").val(curCount + "S后再次发送");
        }
    }

</script>