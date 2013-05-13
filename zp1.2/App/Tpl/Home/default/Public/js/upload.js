var Upload = {
    bindEvent: function() {
        $("#imgRemove").on("click", function() {
            $("#imgView").hide().attr("src", "");
            $("#imgUrl").val("");
        });
        
        $("#zpImg").on("blur", function() {
            var val = $(this).val();
            if(val != '') {
                $("#imgView").attr("src", val).show();
                $("#imgUrl").val(val);
            }
        });
    },
    ajaxupload: function(url) {
        new AjaxUpload('imgUploadBtn', {
            action: url + "?t=" + $.now(), 
            name: 'file',
            onSubmit : function(file, ext) {
                $("#imgTips").text("上传中...");
            },
            onComplete: function(file, response) {
                var data = $.parseJSON(response);
                if(data && data['status']) {
                    if(data['status'] == 1) {
                        $("#imgTips").text("");
                        $("#imgView").attr("src", data['thumb']).show();
                        $("#imgUrl").val(data['img']);
                    } else if(data['status'] == 4) {
                        alert(data['error']);
                    }
                }
            }
        });
    },
    init: function(url) {
        this.bindEvent();
        this.ajaxupload(url);
    }
};