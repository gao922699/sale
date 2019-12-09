var v = new Vue({
    el: ".index",
    data() {
        return {
            active: 1,
            cartNum: 0,
            goods: [],
            cateId: null,
            cateName: '',
            keywords: '',
            loading: false,
            finished: false,
            page: 1
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
        getGoods() {
            var vm = this;
            vm.loading = true;
            $.ajax({
                type: "GET",
                url: "/goods/paginate",
                data: {
                    'page': vm.page,
                    'keywords': vm.keywords,
                    'cateId': vm.cateId,
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
        collect(goodsId, index) {
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
                    vm.goods[index].is_favorite = vm.goods[index].is_favorite ? false : true;
                },
                error: function (response) {
                    vm.$notify({type: 'danger', message: response.responseJSON.message});
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
        },
        getUrlKey: function (name) {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.href) || [, ""])[1].replace(/\+/g, '%20')) || null
        }
    },
    created() {
        this.keywords = this.getUrlKey('keywords');
        this.cateId = this.getUrlKey('cateId');
        this.cateName = this.getUrlKey('cateName');
    }
})
