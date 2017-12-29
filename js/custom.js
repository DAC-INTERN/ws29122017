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
        $.getJSON('http://ws.test/rss.php?url=http://dantri.com.vn/trangchu.rss', function (json) {
            _this.json = json;
        });
    },
    methods: {
        viewContent: function (url) {
            var _this = this;
            this.isShowList = false;

            $.getJSON('http://ws.test/parse.php?url=' + url, function (json) {
                _this.content = json.content;
                _this.isShowContent = true;
            });
        }
    }
});