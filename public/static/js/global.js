function layer_tip(msg, btn) {
    var btn = typeof(btn) == 'undefined' ? '确定' : btn;
    setTimeout(function () {
        layer.open({
            content: msg,
            btn: btn
        })
    }, 350);
}

function layer_tip_mini(msg, fun) {
    layer.open({
        content: msg
        , skin: 'msg'
        , time: 2
    });
    if (typeof(fun) == 'function') {
        setTimeout(function () {
            fun();
        }, 1000);
    }
}

var alert = function () {
    content = '';
    if (arguments[0]) {
        content = typeof(arguments[0]) == 'undefined' ? '' : arguments[0];
    }
    layer.open({
        title: [
            '信息提示',
            'background-color: #C30D23; color:#fff;'
        ],
        content: content,
        skin: 'larafrm'
    });
}

var alert_mini = function () {
    content = '';
    if (arguments[0]) {
        content = typeof(arguments[0]) == 'undefined' ? '' : arguments[0];
    }
    layer.msg(content);
}

Array.prototype.del = function (index) {
    if (isNaN(index) || index >= this.length) {
        return false;
    }
    for (var i = 0, n = 0; i < this.length; i++) {
        if (this[i] != this[index]) {
            this[n++] = this[i];
        }
    }
    this.length -= 1;
}


var ping = 0;

function ajax(url, data, callback, dataType, needrsa) {

    var dataType = typeof(dataType) == 'undefined' ? 'json' : dataType;
    var index = layer.load(2, {shade: false});
    if (ping == 1) {
        return false;
    }
    ping = 1;

    var sendData = data;
    if (typeof (needrsa) != 'undefined' && needrsa) {
        $.getScript("/static/rsa/jsbn.js");
        $.getScript("/static/rsa/prng4.js");
        $.getScript("/static/rsa/rng.js");
        $.getScript("/static/rsa/rsa.js");
        $.getScript("/static/rsa/base64.js");
        if (!public_key || !public_length) {
            console.log('缺少重要参数 ');
        } else {
            var rsa = new RSAKey();
            rsa.setPublic(public_key, public_length);

            var res = rsa.encrypt(data);
            if (res) {
                rsaResult = hex2b64(res);
                sendData = {data: rsaResult};
            }
        }
    }
    /*
    $.post(url, sendData, function (res) {
        layer.close(index);
        ping = 0;
        //回调函数
        if (typeof(callback) == 'function') {
            setTimeout(function () {
                callback(res);
            }, 1000);
        }
    }, dataType);
    */

    $.ajax({
        type: "POST",
        url: url,
        data: sendData,
        cache: false,
        dataType: dataType,
        beforeSend: function () {

        },
        success: function (res) {
            layer.close(index);
            ping = 0;

            if (typeof(callback) == 'function') {
                callback(res);
            }
        },
        error: function () {
            layer.close(index);

            layer.msg('请求出错， 请检查');
        }
    });
}