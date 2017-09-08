var myVueData = {
  // Vue.jsで使う変数はここに記述する
  user: {
    name:null,
    userId: null,
    iconURL: null,
  },
  myTweet: {
    text: null,
  },
  timelineTweets: null
};

var myVueMethods = {
  postTweet: function() {
    var myTweetData = this.myTweet.text;
    $.ajax({
      type: "POST",
      url: page + "/php/post_tweet.php",
      data: {tweetdata: myTweetData},
      success: function(data) {
        myVueData.myTweet.text = null;
      }
    });
    myVueMethods.getTimeline(5)
  },
  getUserInfo: function() {
    $.ajax({
      method: "GET",
      url: page + "/php/get_userinfo.php",
    }).then(
      function(data){
        var json = JSON.parse(data);
        console.log(json);
        myVueData.user.name = json.userName;
        myVueData.user.userId = json.userId;
        myVueData.user.iconURL = json.iconURL;
      },
      function(){
      console.log("エラー発生");
    });
  },
  getTimeline: function(n) {
    $.ajax({
      method: "GET",
      url: page + "/php/get_timeline.php",
      data: {num: n},
    }).then(
      function(data){
        var json = JSON.parse(data);
        myVueData.timelineTweets = [];
        json.forEach(function(element,key,array){
          myVueData.timelineTweets[key] = JSON.parse(element.replace(/\r?\n/g, "<br />").replace(/<\a[\s\S]*?a\>/g, ""));
        });
      },
      function(){
      console.log("エラー発生");
    });
  },
};

var vm = new Vue({
  el: "#app", // Vue.jsを使うタグのIDを指定
  data: myVueData,
  methods: myVueMethods,
  created: function() {
    // Vue.jsの読み込みが完了したときに実行する処理はここに記述する
    /** ユーザー情報を受け取る */
    myVueMethods.getUserInfo();
    myVueMethods.getTimeline(10);
  },
  computed: {
    // 計算した結果を変数として利用したいときはここに記述する
  }
});
