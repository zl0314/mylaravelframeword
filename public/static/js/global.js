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

function alert_mini(msg, fun) {
    layer.msg(msg);
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


var ping = 0;

/**
 *  ajax请求, 对有些请求 要求安全性的时候， 进行加密
 * @param url   请求URL
 * @param data  参数
 * @param callback  回调函数
 * @param dataType  响应类型
 * @param needrsa   是否进行加密
 */
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


/**
 * LAYUI 打开IFRAME
 * @param url 地址
 * @param params 其它参数， 格式：a=1&b=2
 * @param w 宽
 * @param h 高
 */
function iframe(url, params, w, h) {
    var w = typeof(w) == 'undefined' ? 1100 : w;
    var h = typeof(h) == 'undefined' ? 660 : h;
    var params = typeof(params) == 'undefined' ? '' : params;

    if (typeof(url) == 'undefined') {
        console.log('URL不能为空');
        return;
    }
    var url = url.indexOf('?') > 0 ? url + '&inframe=1' : url;
    url += '&' + params;

    window.layer.index = layer.open({
        type: 2,
        title: false,
        area: [w + 'px', h + 'px'],
        shade: 0.7,
        closeBtn: 1,
        shadeClose: true,
        content: url
    });
}


/**
 * LAYUI 打开IFRAME，自定义HTMl
 */
function iframe_customize_html(id) {
    var content = typeof(id) == 'undefined'
        ? $('#iframe_customize_html').html()
        : $('#iframe_customize_html_' + id).html();

    layer.open({
        type: 1,
        title: '内容',
        area: ['80%', '560px'],
        closeBtn: 0,
        shadeClose: true,
        skin: 'iframe_customize_html',
        content: content
    });
}