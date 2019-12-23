var v = new Vue({
    el: ".index",
    data() {
        return {
            active: 3,
            username: '未登录',
            cartNum: 0,
            tax: 0.00,
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
                    vm.tax = response.data.tax;
                }
            });
        },
        editTax() {
            var vm = this;
            $.ajax({
                type: "POST",
                url: "/user/edit-tax",
                dataType: "json",
                data: {
                    'tax': vm.tax
                },
                success: function (response) {
                    vm.$notify({type: 'success', message: '修改成功'});
                },
                error: function (response) {
                    vm.$notify({type: 'danger', message: response.responseJSON.message});
                }
            });
        }
    },
    created() {
        this.getCartNum();
        this.getUserInfo();
    }
})
