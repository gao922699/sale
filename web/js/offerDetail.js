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
                    vm.detail.date = vm.detail.date.split(" ")[0];
                }
            });
        },
        download() {

        },
        downloadWithCost() {

        },
        getUrlKey: function (name) {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.href) || [, ""])[1].replace(/\+/g, '%20')) || null
        }
    },
    created() {
        this.id = this.getUrlKey('id');
        this.getCartNum();
        this.getOfferDetail();
    }
})
