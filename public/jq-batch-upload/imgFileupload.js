~(function (win) {
   var htmls = '<input type="file" name="" id="" class="imgFiles" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" multiple>' +
        '<div class="header">' +
        '    <span class="imgTitle">' +
        '        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
        '        <b>' +
        '            ' +
        '        </b>' +
        '    </span>' +
        '    <span class="imgClick">' +
        '    </span>' +
        '    <span class="imgcontent">' +
        '        最多可上传' +
        '    </span>' +
        '</div>' +
        '<div class="imgAll">' +
        '    <ul  id="sortable">' +
        '    </ul>' +
        '</div>';
    var ImgUploadeFiles = function (obj, fn) {
        var _this = this;
        this.bom = document.querySelector(obj);
        if (fn) fn.call(_this);
        this.ready();

    };
    ImgUploadeFiles.prototype = {
        init: function (o) {
            this.MAX = o.MAX || 5;
            this.callback = o.callback;
            this.MW = o.MW || 10000;
            this.MH = o.MH || 10000;
            this.remove = o.remove || function () {
            };
            this.inputName = o.inputName || 'pics';
            this.imgList = o.imgList || '';
        },
        ready: function () {
            var _self = this;
            this.dom = document.createElement('div');
            this.dom.className = 'imgFileUploade';
            this.dom.innerHTML = htmls;
            this.bom.appendChild(this.dom);
            this.files = this.bom.querySelector('.imgFiles');
            this.fileClick = this.bom.querySelector('.imgClick');
            this.fileBtn(this.fileClick, this.files);
            this.imgcontent = this.bom.querySelector('.imgcontent');
            this.imgcontent.innerHTML = '最多可上传<b style="color:red">' + this.MAX + '</b>张' + _self.MW + ' * ' + _self.MH + '像素的图片';
            if (this.imgList) {
                this.imgList = JSON.parse(this.imgList);
                this.renderList(_self);
            }
        },
        renderList: function (o) {
            var html = '';
            for (i in this.imgList) {
                html += '<li class="ui-state-default" data-delid="' + i + '" id="batch_upload_' + i + '" realsrc="' + this.imgList[i] + '"> ' +
                    '<img alt="" src="' + this.imgList[i] + '">' +
                    '<input type="hidden" name="' + this.inputName + '" value="' + this.imgList[i] + '"><i class="delImg">X </i></li>';
            }
            $('.imgAll ul').append(html);

            var _Imgpreview = $('.imgAll ul').find('.delImg');
            for (var k = 0; k < _Imgpreview.length; k++) {
                $(_Imgpreview[k]).off().on('click', function () {
                    if (confirm('确认要删除吗？')) {
                        var _deid = $(this).parent().attr('data-delid');
                        o.remove(_deid);
                        $(this).parent().remove();
                    }
                })
            }
        },
        fileBtn: function (c, f) {
            var _self = this;
            var _imgAll = $(c).parent().parent().find('.imgAll ul');
            $(c).off().on('click', function () {
                $(f).click();

                $(f).off().on('change', function () {
                    var _this = this;
                    _private.startUploadImg(_imgAll, _this.files, _self.MAX, _self.callback, _self.MW, _self.MH, _self.remove, _self.inputName);
                });
            });
        }
    };
    var _dataArr = [];
    var _private = {
        startUploadImg: function (o, files, MAX, callback, W, H, remove, inputName) {
            _dataArr.length = 0;
            var _this = this;
            var fileImgArr = [];

            if (files.length > MAX) {
                alert('不能大于' + MAX + '张');
                return false;
            }
            ;
            var lens = $(o).find('li').length;
            if (lens >= MAX && files.length > 0) {
                alert('不能大于' + MAX + '张');
                return false;
            }
            ;

            for (var i = 0, file; file = files[i++];) {
                var reader = new FileReader();
                reader.onload = (function (file) {
                    return function (ev) {
                        var image = new Image();
                        image.onload = function () {
                            var width = image.width;
                            var height = image.height;

                            fileImgArr.push({
                                fileSrc: ev.target.result,
                                fileName: file.name,
                                fileSize: file.size,
                                height: height,
                                width: width
                            });
                        };
                        image.src = ev.target.result;


                    };
                })(file);
                reader.readAsDataURL(file);
            }
            //创建分时函数
            var imgTimeSlice = _this.timeChunk(fileImgArr, function (file) {
                if (file.width > W || file.height > H) {
                    alert('图片不能大于' + W + '*' + H + '像素');
                    return false;
                }
                //调用图片类
                var up = new ImgFileupload(o, file.fileName, file.fileSrc, file.fileSize, callback, remove, inputName);
                up.init();
            }, 1);
            imgTimeSlice(); //调用分时函数
        },
        timeChunk: function (arr, fn, count) {
            var obj, t;
            var len = arr.length;
            var start = function () {
                for (var i = 0; i < Math.min(count || 1, arr.length); i++) {
                    var obj = arr.shift();
                    fn(obj)
                }
            };
            return function () {
                t = setInterval(function () {
                    if (arr.length === 0) {
                        return clearInterval(t);
                    }
                    start();
                }, 200)
            }
        }
    };

    var ImgFileupload = function (b, imgName, imgSrc, imgSize, callback, remove, inputName) {
        this.b = b;
        this.imgName = imgName;
        this.imgSize = imgSize;
        this.imgSrc = imgSrc;
        this.callback = callback;
        this.remove = remove;
        this.inputName = inputName;
    };
    var _delId = 1; //删除id用于判断删除个数
    ImgFileupload.prototype.init = function () {
        _delId++;
        var _self = this;
        this.dom = document.createElement('li');
        this.dom.innerHTML =
            '    <img  alt="" data-src="' + this.imgSrc + '" class="imsg">' +
            '<input type="hidden" name="' + this.inputName + '">' +
            '    <i class="delImg" >' +
            '        X' +
            '    </i>';
        $(this.dom).attr({'data-delId': _delId, 'data-delName': this.imgName, id: 'batch_upload_' + _delId});
        $(this.b).append(this.dom);
        var _Img = new Image();
        _Img.src = $(this.dom).find('img').attr('data-src');
        _Img.onload = function () {
            $(_self.dom).find('img').attr('src', _Img.src);
        }
        _dataArr.push({'delId': _delId, src: this.imgSrc});
        _self.callback(this.dom);
        // $(this.b).parent().parent().parent().attr('data-dataImgs',JSON.stringify(_dataArr));
        var _delAll = $(this.b).find('.delImg');
        for (var i = 0; i < _delAll.length; i++) {
            $(_delAll[i]).off().on('click', function () {

                var _deid = $(this).parent().attr('data-delId');
                for (var n = 0; n < _dataArr.length; n++) {
                    if (_dataArr[n].delId == _deid) {
                        if (confirm('确认要删除吗？')) {
                            $(this).parent().fadeOut('slow', function () {
                                $(this).remove();
                            });
                            _self.remove(_deid);
                        }
                    }
                }
                /// _self.callback(_dataArr)
                // $(this.b).parent().parent().parent().attr('data-dataImgs',JSON.stringify(_dataArr))

            });
        }
        ;
        var _Imgpreview = $(this.b).find('.delImg');
        for (var k = 0; k < _Imgpreview.length; k++) {
            $(_Imgpreview[k]).off().on('click', function () {
                if (confirm('确认要删除吗？')) {
                    var _deid = $(this).parent().attr('data-delid');
                    _self.remove(_deid);
                    $(this).parent().remove();
                }
            })
        }
    }
    win.ImgUploadeFiles = ImgUploadeFiles;
})(window);