var v = new Vue({
    el: ".index",
    data() {
        return {
            active: 2,
            cartNum: 0,
            show: false,
            //编辑商品信息用
            count: 1,
            remark: '',
            price: 0.00,
            cartId: 0,
            index: 0,
            //end
            bjshow: false,
            //生成报价单用
            name: '',
            tel: '',
            date: '',
            //end
            minDate: new Date(),
            currentDate: new Date(),
            goods: [],
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
        confirmDate() {
            this.date = this.formart(this.currentDate);
            this.showdate = false;
        },
        formart(d) {
            var date = new Date(d);
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var day = date.getDate();
            if (month < 10) {
                month = "0" + month;
            }
            if (day < 10) {
                day = "0" + day;
            }
            return nowDate = year + "-" + month + "-" + day;
        },
        getCartGoods() {
            var vm = this;
            $.ajax({
                type: "GET",
                url: "/offer/cart-goods",
                dataType: "json",
                success: function (response) {
                    vm.goods = response.data;
                }
            });
        },
        //填充数据到表单
        edit(item, index) {
            var vm = this;
            vm.show = true;
            vm.cartId = item.id;
            vm.count = item.count;
            vm.price = item.price;
            vm.remark = item.remark;
            vm.index = index;
        },
        doEdit() {
            var vm = this;
            $.ajax({
                type: "POST",
                url: "/offer/edit-cart",
                data: {
                    id: vm.cartId,
                    count: vm.count,
                    price: vm.price,
                    remark: vm.remark
                },
                dataType: "json",
                success: function (response) {
                    vm.goods[vm.index].count = vm.count;
                    vm.goods[vm.index].price = vm.price;
                    vm.goods[vm.index].remark = vm.remark;
                    vm.$notify({type: 'success', message: '修改成功'});
                    vm.show = false;
                },
                error: function (response) {
                    vm.$notify({type: 'danger', message: '修改失败'});
                }
            });
        },
        del(item, index) {
            var vm = this;
            $.ajax({
                type: "POST",
                url: "/offer/delete-cart",
                data: {
                    id: item.id,
                },
                dataType: "json",
                success: function (response) {
                    vm.$notify({type: 'success', message: response.message});
                    vm.goods.splice(index, 1);
                    vm.cartNum--;
                },
                error: function (response) {
                    vm.$notify({type: 'danger', message: '删除失败'});
                }
            });
        },
        offer() {
            var vm = this;
            $.ajax({
                type: "POST",
                url: "/offer/save",
                data: {
                    name: vm.name,
                    tel: vm.tel,
                    date: vm.date,
                },
                dataType: "json",
                success: function (response) {
                    var offer_id = response.data.offer_id;
                    window.location.href = '/offer/detail?id=' + offer_id;
                },
                error: function (response) {
                    vm.$notify({type: 'danger', message: response.responseJSON.message});
                }
            });
        }
    },
    created() {
        this.getCartNum();
        this.getCartGoods();
        this.confirmDate();
    }
});
