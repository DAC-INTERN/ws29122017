new Vue({
    el: '#app',
    data: {
        json: null,
        content: null,
        isShowList: true,
        isShowContent: false

    },
    created: function () {
        var _this = this;
        $.getJSON( '/rss.php?url=http://dantri.com.vn/trangchu.rss' , function (json) {
            _this.json = json;
        });
    },
    methods: {
        viewContent: function (url) {
            var _this = this;
            this.isShowList = false;

            $.getJSON('/parse.php?url=' + url, function (json) {
                _this.content = json.content;
                _this.isShowContent = true;
            });
        },
        LinkRss: function (url) {
            var _this = this;
            $.getJSON('/rss.php?url=' + url , function (json) {
                _this.json = json;
            });
            _this.isShowContent = false;
            _this.isShowList = true;
        }
    }
});

$(document).ready(function () {
    $(".Info-form a").each(function () {
        $(this).removeAttr("href");
    });
    console.log('ok');
});