var v = new Vue({
    el: ".index",
    data: {
        username: '',
        password: '',
    },
    methods: {
        login() {
            var vm = this;
            $.ajax({
                type: "POST",
                url: "/user/login",
                data: {
                    username: vm.username,
                    password: vm.password
                },
                dataType: "json",
                success: function (response) {
                    if (response.code == 200) {
                        window.location.href = '/site/index';
                    } else {
                        vm.$notify({type: 'danger', message: response.responseJSON.message});
                    }
                }
            });
        }
    },
    created() {

    }
});
