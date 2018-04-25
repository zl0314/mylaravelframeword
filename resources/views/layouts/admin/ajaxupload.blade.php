<script src="/static/admin/js/ajaxupload.3.9.js"></script>
<script>
    var allow = 1;
    var allow_size = typeof(allow_size) == 'undefined' ? '<?php echo str_replace( 'M', '', ini_get( 'upload_max_filesize' ) ) * 1024 * 1024?>' : allow_size;

    function fileSelected(t) {
        var oid = 'Filedata_e';
        if (typeof(t) != 'undefined') {
            oid = t;
        }
        var oFile = document.getElementById(t).files[0];
        // console.log(document.getElementById('Filedata_e'));
        // little test for filesize
        console.log(oFile.size);
        if (parseInt(oFile.size) > allow_size) {
            allow = 0;
            var size = allow_size / 1024 / 1024;
            alert('图片尺寸不能超过' + ( Math.round(size * 10) / 10) + 'M');
            return false;
        }
        return true;
    }

    //ajax上传图片 id 输入框ID ，upload指定POST文件对象
    function ajaxUpload(id, upload) {
        if (typeof('upload') == 'undefined') {
            upload = 'default';
        }
        if (typeof(size) == 'undefined') {
            size = allow_size;
        }

        new AjaxUpload($("#" + id + "_button"), {
            action: "{{url( '/upload?act=' )}}" + upload,
            type: "POST",
            data: {'_token': '{{csrf_token()}}'},
            autoSubmit: true,
            responseType: 'json',//"json",
            name: upload,
            onChange: function (file, ext) {
                var o = this._input;
                var oid = $(o).attr('id');
                if (!(ext && /^(jpg|jpeg|JPG|JPEG|PNG|gif)$/i.test(ext))) {
                    alert('图片格式不正确');
                    return false;
                } else {
                    fileSelected(oid);
                    if (allow == 1) {
                        $('#upload_img_tr').show();
                        $('#uploading').show();
                    }
                    if (allow == 0) {
                        return false;
                    }
                }
                return true;
            },
            onComplete: function (file, resp) {
                $('#' + id).val(resp.file);
                $('#' + id + '_pic').attr('src',resp.file);

                if (typeof(upload_callback) == 'function') {
                    upload_callback(resp);
                }else{
                    alert(resp.msg)
                }
            }
        });
    }

    $(".ajaxUploadBtn").trigger('click');
</script>