Page({

  /**
   * 页面的初始数据
   */
  data: {
    phone:'',//收集手机号
    pass:''//收集密码
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
        //设置导航栏标题
        wx.setNavigationBarTitle({
          title: '登录页'
        })
        //设置导航条背景颜色
        wx.setNavigationBarColor({
          frontColor: '#ffffff',
          backgroundColor: '#3894FF',
        })
        //隐藏主键按钮
        // canIUse 判断api是否可以在当前版本里使用
        if(wx.canIUse('hideHomeButton')){
          wx.hideHomeButton()
        }
        
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
    
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
    
  },
  // 获取输入的电话号码
  getphone:function(e){
  this.setData({phone:e.detail.value})
  },
  // 获取输入的密码
  getpass:function(e){
  this.setData({pass:e.detail.value})
  },
  btnindex:function(){
    var phone=this.data.phone
    var pass=this.data.pass
    // 判断账号，密码不能为空
    if(phone===''){
      wx.showToast({
        title: '账号不能为空',
        icon: 'error',
        duration: 1000
      })
      return
    }else if(pass===''){
      wx.showToast({
        title: '密码不能为空',
        icon: 'error',
        duration: 1000
      })
      return
    }else{
      // 后端交互，账号密码验证
      wx.request({
        url: `http://www.wxxz.com/yh/${phone}-${pass} `,
        header: {
          'content-type': 'json' // 默认值
        },
        success (res) {
          // 判断账号密码是否正确
         if(res.data.msg==='error'){
          wx.showToast({
            title: '账号不存在',
            icon: 'error',
            duration: 1000
          })
          return
         }else if(res.data.msg==='error1'){
          wx.showToast({
            title: '密码错误',
            icon: 'error',
            duration: 1000
          })
          return
         }else{
         wx.setStorageSync('phone',phone)
          wx.showToast({
            title: '欢迎登录',
            icon: 'success',
            duration: 1000
          })
         setTimeout(()=>{
          wx.switchTab({
            url: '/pages/index/index',
         })
         },500)
         }
        }
      })
    }
   
  },
  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {
    
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {
    
  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
    
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
    
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
    
  }
})