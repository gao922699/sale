var v = new Vue({
    el: ".index",
    data: {
        id: 0,
        active: 3,
        tabActive: 0,
        cartNum: 0,
        detail: {},
        show: false
    },
    methods: {
        getCartNum() {
            var vm = this;
            $.ajax({
                type: "GET",
                url: "/offer/cart-num",
                dataType: "json",
                success: function (response) {
                    vm.cartNum = response.data.num;
                }
            });
        },
        onClickLeft() {
            history.go(-1);
        },
        getOfferDetail() {
            var vm = this;
            $.ajax({
                type: "GET",
                url: "/offer/detail-info",
                dataType: "json",
                data: {
                    id: vm.id
                },
                success: function (response) {
                    vm.detail = response.data;
                    vm.detail.date = vm.detail.date.split(' ')[0];
                }
            });
        },
        download() {
            html2canvas(this.$refs.image, {
                backgroundColor: 'white'
            }).then((canvas) => {
                var url = canvas.toDataURL("image/png");
                // 生成一个a元素
                var a = document.createElement('a');
                // 创建一个单击事件
                var event = new MouseEvent('click');
                // 将a的download属性设置为我们想要下载的图片名称，若name不存在则使用‘下载图片名称’作为默认名称
                a.download = this.detail.name + '的报价单';
                // 将生成的URL设置为a.href属性
                a.href = url;
                // 触发a的单击事件
                a.dispatchEvent(event);
            });
        },
        downloadWithCost() {
            html2canvas(this.$refs.imageWithCost, {
                backgroundColor: 'white'
            }).then((canvas) => {
                var url = canvas.toDataURL("image/png");
                // 生成一个a元素
                var a = document.createElement('a');
                // 创建一个单击事件
                var event = new MouseEvent('click');
                // 将a的download属性设置为我们想要下载的图片名称，若name不存在则使用‘下载图片名称’作为默认名称
                a.download = this.detail.name + '的报价单（带成本价）';
                // 将生成的URL设置为a.href属性
                a.href = url;
                // 触发a的单击事件
                a.dispatchEvent(event);
            });
        },
        getUrlKey: function (name) {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.href) || [, ""])[1].replace(/\+/g, '%20')) || null
        },
    },
    created() {
        this.id = this.getUrlKey('id');
        this.getCartNum();
        this.getOfferDetail();
    }
})
