var v = new Vue({
  el: ".index",
  data() {
    return {
      activeIndex: 0,
      items: [{ text: '分组 1' }, { text: '分组 2' }],
      value: ''
    };
  },
  methods:{
    onClickLeft:function(index){
      console.log(index)
      this.activeIndex = index
    },
    check:function(index){
      console.log(index)
      this.activeIndex = index
    }
  },
  created(){

  }
})
