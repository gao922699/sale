var v = new Vue({
    el: ".index",
    data() {
        return {
            active: 1,
            cartNum: 0,
            keywords: '',
            activeIndex: 0,
            topCates: [],
            childCates: []
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
            window.location.href = '/goods/list?keywords=' + this.keywords;
        },
        getChildCates: function (index) {
            var vm = this;
            vm.activeIndex = index;
            var topCateId = vm.topCates[index].id;
            $.ajax({
                type: "GET",
                url: "/goods/child-cates",
                dataType: "json",
                data: {
                    topCateId: topCateId
                },
                success: function (response) {
                    console.log(response.data);
                    vm.childCates = response.data;
                }
            });
        },
        getTopCates() {
            var vm = this;
            $.ajax({
                type: "GET",
                url: "/goods/top-cates",
                dataType: "json",
                success: function (response) {
                    vm.topCates = response.data;
                    vm.getChildCates(0);
                }
            });
        },
        showGoods(cate) {
            window.location.href = '/goods/list?cateId=' + cate.id + '&cateName=' + cate.name;
        }
    },
    created() {
        this.getTopCates();
    }
})
