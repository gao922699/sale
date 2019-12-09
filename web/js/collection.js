var v = new Vue({
    el: ".index",
    data() {
        return {
            active: 3,
            cartNum: 0,
            keywords: '',
            page: 1,
            goods: [],
            loading: false,
            finished: false,
        };
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
        onClickLeft: function () {
            history.go(-1);
        },
        search() {
            this.page = 1;
            this.goods = [];
            this.getList();
        },
        cancel(goodsId, index) {
            var vm = this;
            $.ajax({
                type: "POST",
                url: "/goods/switch-favorite",
                data: {
                    'goods_id': goodsId
                },
                dataType: "json",
                success: function (response) {
                    vm.$notify({type: 'success', message: response.message});
                    //删除列表中的该项
                    vm.goods.splice(index, 1);
                },
                error: function (response) {
                    vm.$notify({type: 'danger', message: response.responseJSON.message});
                }
            });
        },
        getList() {
            var vm = this;
            vm.loading = true;
            $.ajax({
                type: "GET",
                url: "/user/favorite-paginate",
                data: {
                    'page': vm.page,
                    'keywords': vm.keywords,
                },
                dataType: "json",
                success: function (response) {
                    vm.goods = vm.goods.concat(response.data);
                    vm.loading = false;
                    if (response.data.length == 0) {
                        vm.finished = true;
                    } else {
                        vm.page++;
                    }
                },
                error: function (response) {
                    vm.$notify({type: 'danger', message: '加载失败'});
                }
            });
        },
        addCart(goodsId) {
            var vm = this;
            $.ajax({
                type: "POST",
                url: "/offer/add-cart",
                data: {
                    'goods_id': goodsId
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
        jump(id) {
            window.location.href = '/goods/detail?id=' + id;
        }
    },
    created() {
        this.getCartNum();
    }
})
