var v = new Vue({
    el: ".index",
    data: {
        id: 0,
        active: 1,
        cartNum: 0,
        detail: {},
        cost_price: 0.00,
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
        getGoodsDetail() {
            var vm = this;
            $.ajax({
                type: "GET",
                url: "/goods/detail-info",
                dataType: "json",
                data: {
                    id: vm.id
                },
                success: function (response) {
                    vm.detail = response.data;
                    vm.detail.carousel = vm.detail.carousel.split(',');
                    vm.cost_price = vm.detail.cost;
                }
            });
        },
        setCost() {
            var vm = this;
            $.ajax({
                type: "POST",
                url: "/goods/set-cost",
                dataType: "json",
                data: {
                    id: vm.id,
                    price: vm.cost_price
                },
                success: function (response) {
                    vm.$notify({type: 'success', message: response.message});
                    vm.show = false;
                    vm.detail.cost = vm.cost_price;
                },
                error: function (response) {
                    vm.$notify({type: 'danger', message: response.responseJSON.message});
                }
            });
        },
        addCart() {
            var vm = this;
            $.ajax({
                type: "POST",
                url: "/offer/add-cart",
                data: {
                    'goods_id': vm.id
                },
                dataType: "json",
                success: function (response) {
                    vm.$notify({type: 'success', message: response.message});
                    vm.cartNum++;
                },
                error: function (response) {
                    vm.$notify({type: 'danger', message: response.responseJSON.message});
                }
            });
        },
        getUrlKey: function (name) {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.href) || [, ""])[1].replace(/\+/g, '%20')) || null
        }
    },
    created() {
        this.id = this.getUrlKey('id');
        this.getCartNum();
        this.getGoodsDetail();
    }
})
