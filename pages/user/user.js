Page({

  /**
   * 页面的初始数据
   */
  data: {
    // newpass:'',
  yuyue:[]

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    //设置导航栏标题
    wx.setNavigationBarTitle({
      title: '我的预定'
    })
    //设置导航条背景颜色
    wx.setNavigationBarColor({
      frontColor: '#ffffff',
      backgroundColor: '#3894FF',
    })
    // 获取预约信息
    var phone =wx.getStorageSync('phone')
    this.getyuyue(phone)
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
    var phone =wx.getStorageSync('phone')
    this.getyuyue(phone)
  },

  // 退出登录
  loginout:function(){
    wx.showModal({
      title: '提示',
      content: '确定退出吗？',
      complete: (res) => {
        if (res.cancel) { 
        }
        if (res.confirm) {
        // 删除缓存的登录信息
        wx.removeStorageSync('phone')
        wx.reLaunch({
          url: '/pages/login/login',
        })
       
        }
      }
    })
    
  },
  // 修改密码
  updatepass:function(e){
    wx.showModal({
      title: '修改密码',
      editable:true,
      placeholderText:'输入新的密码',
      complete: (res) => {
        // if (res.cancel) {
        //   wx.reLaunch({
        //     url: '/pages/user/user',
        //   })
        // }
        if (res.confirm) {
          const phone =wx.getStorageSync('phone')
          wx.request({
            url: `http://www.wxxz.com/resetmm/${phone}-${res.content} `,
            header: {
              'content-type': 'json' 
            },
            success(res){
              if(res.data.msg==='ok'){   
                wx.showToast({
                  title: '密码修改成功',
                  icon:'success',
                  duration:1000
                })
              }
            }
          })
          
        }
      }
    })
  },
  // 获取预约信息
  getyuyue:function(phone){
    var that=this
    wx.request({
      url: `http://www.wxxz.com/yuyues/${phone} `,
      header: {
        'content-type': 'json' // 默认值
      },
      success(res){
       that.setData({yuyue:res.data})
      //  console.log(res.data)
      }
    })
  },
  // 取消预约
  delyuyue:function(e){
    var id=e.target.dataset.id
    // console.log(id)
    wx.request({
      url: `http://www.wxxz.com/cacelyuyue/${id}`,
      header:{
        'content-type': 'json' // 默认值
      },
      success(res){
        if(res.data.msg==='ok'){
        wx.showToast({
          title: '取消成功',
          icon:'success'
        })
        wx.reLaunch({
          url: '/pages/user/user',
        })
        }
      }
    })

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