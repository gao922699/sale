var v = new Vue({
    el: ".index",
    data() {
        return {
            active: 3,
            username: '未登录',
            cartNum: 0
        };
    },
    methods: {
        onClickLeft() {
            history.go(-1);
        },
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
        getUserInfo() {
            var vm = this;
            $.ajax({
                type: "GET",
                url: "/user/info",
                dataType: "json",
                success: function (response) {
                    vm.username = response.data.username;
                }
            });
        },
        logout() {
            $.ajax({
                type: "POST",
                url: "/user/logout",
                dataType: "json",
                success: function (response) {
                    window.location.href = '/user/login';
                }
            });
        }
    },
    created() {
        this.getCartNum();
        this.getUserInfo();
    }
})
