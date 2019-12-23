var v = new Vue({
    el: ".index",
    data: {
        id: 0,
        active: 3,
        tabActive: 0,
        cartNum: 0,
        detail: {},
        userInfo: {},
        dialogShow: false,
        imageHref: ''
    },
    computed: {
        totalPrice() {
            var total = 0;
            for (var i = 0; i < this.detail.offerGoods.length; i++) {
                total += parseFloat(this.detail.offerGoods[i].offer_price) * parseInt(this.detail.offerGoods[i].count);
            }
            return total.toFixed(2);
        },
        totalTaxPrice() {
            var total = 0;
            for (var i = 0; i < this.detail.offerGoods.length; i++) {
                total += parseFloat(this.detail.offerGoods[i].offer_price) * parseInt(this.detail.offerGoods[i].count) * (1 + parseFloat((this.userInfo.tax)));
            }
            return total.toFixed(2);
        },
        totalCostPrice() {
            var total = 0;
            for (var i = 0; i < this.detail.offerGoods.length; i++) {
                total += parseFloat(this.detail.offerGoods[i].cost_price) * parseInt(this.detail.offerGoods[i].count);
            }
            return total.toFixed(2);
        }
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
                    console.log(vm.detail);
                }
            });
        },
        getUserInfo() {
            var vm = this;
            $.ajax({
                type: "GET",
                url: "/user/info",
                dataType: "json",
                success: function (response) {
                    vm.userInfo = response.data;
                }
            });
        },
        download() {
            //先把滚动条滚到顶部，防止生成的图片不全
            window.pageYOffset = 0;
            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;

            var imageObj = this.$refs.image;
            var height = imageObj.offsetHeight;
            var width = imageObj.offsetWidth;
            var scale = 2.5;
            var canvas = document.createElement("canvas");
            canvas.height = height * scale;
            canvas.width = width * scale;
            html2canvas(imageObj, {
                scale: scale,
                canvas: canvas,
                backgroundColor: 'white',
                height: height,
                width: width
            }).then((canvas) => {
                var url = canvas.toDataURL("image/png");
                // 将生成的URL设置为a.href属性
                this.imageHref = url;
                this.dialogShow = true;
            });
        },
        downloadWithCost() {
            //先把滚动条滚到顶部，防止生成的图片不全
            window.pageYOffset = 0;
            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;

            var imageObj = this.$refs.imageWithCost;
            var height = imageObj.offsetHeight;
            var width = imageObj.offsetWidth;
            var scale = 2.5;
            var canvas = document.createElement("canvas");
            canvas.height = height * scale;
            canvas.width = width * scale;
            html2canvas(imageObj, {
                scale: scale,
                canvas: canvas,
                backgroundColor: 'white',
                height: height,
                width: width
            }).then((canvas) => {
                var url = canvas.toDataURL("image/png");
                // 将生成的URL设置为a.href属性
                this.imageHref = url;
                this.dialogShow = true;
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
        this.getUserInfo();
    }
})
