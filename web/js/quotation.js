var v = new Vue({
    el: ".index",
    data() {
        return {
            active: 3,
            cartNum: 0,
            offers: [],
            page: 1,
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
        onClickLeft: function (index) {
            history.go(-1);
        },
        getList() {
            var vm = this;
            vm.loading = true;
            $.ajax({
                type: "GET",
                url: "/offer/list-paginate",
                data: {
                    'page': vm.page,
                },
                dataType: "json",
                success: function (response) {
                    vm.offers = vm.offers.concat(response.data);
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
        detail(id) {
            window.location.href = '/offer/detail?id=' + id;
        },
    },
    created() {
        this.getCartNum();
    }
})
