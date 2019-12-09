var v = new Vue({
  el: ".index",
  data: {
    val: ''
  },
  methods:{
    onClickLeft() {
      Toast('返回');
    },
    onClickRight() {
      Toast('按钮');
    }
  },
  created(){

  }
})
