// app.js
App({
  onLaunch() {
   var phone=wx.getStorageSync('phone')
   if(phone===''){
   wx.reLaunch({
     url: '/pages/login/login',
   })
   }else{
     wx.switchTab({
       url: '/pages/index/index',
     })
   }
  },
  globalData: {
    userInfo: null
  }
})
