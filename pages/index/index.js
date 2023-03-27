var util = require('../../utils/util')
Page({


  /**
   * 页面的初始数据
   */
  data: {
    date: '日期',
    time: '时间',
    date1: '日期',
    time1: '时间',
    btn1: false,
    btn2: true,
    kxsrc: '../../images/kexuanzuowei.png',
    yxsrc: '../../images/yixuanzuowei.png',
    seat: '',
    username: '',
    phone: '',
    color1: '#3894FF',
    color2: '#ccc',
    color3: '#ccc',
    color4: '#ccc',
    type1: 'zhibokecheng',
    seats: '',
    vip1: '',
    vip2: '',
    vip3: '',
    vip4: '',
    vip5: '',
    vip6: '',
    vip7: '',
    vip8: '',
    vip9: '',
    vip10: '',
    a1: '',
    a2: '',
    a3: '',
    a4: '',
    a5: '',
    a6: '',
    a7: '',
    a8: '',
    b1: '',
    b2: '',
    b3: '',
    b4: '',
    b5: '',
    b6: '',
    b7: '',
    b8: '',
    b9: '',
    b10: '',
    b11: '',
    b12: '',
    c1: '',
    c2: '',
    c3: '',
    c4: '',
    c5: '',
    c6: '',
    c7: '',
    c8: '',
    c9: '',
    c10: '',
    c11: '',
    c12: '',
    todaydate: '',
    todaytime: '',
    yxzw: []
  },

  /**
   * 生命周期函数--监听页面加载
   */
  //加载页面函数
  onLoad: function (options) {
    //设置导航栏标题
    wx.setNavigationBarTitle({
      title: '选座系统'
    })
    //设置导航条背景颜色
    wx.setNavigationBarColor({
      frontColor: '#ffffff',
      backgroundColor: '#3894FF',
    })
    // 获取登录用户手机号
    var phone = wx.getStorageSync('phone')
    this.setData({ phone: phone })

    // 获取当前日期和时间
    var todaydate = util.formatTime(new Date());
    var todaytime = util.formatTime1(new Date());
    this.setData({ todaydate: todaydate, todaytime: todaytime })
 
  },
  
  
 
  bindTimeChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      time: e.detail.value
    })
  },
  bindDateChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      date: e.detail.value
    })
  },
  bindTimeChange1: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      time1: e.detail.value
    })
  },
  bindDateChange1: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      date1: e.detail.value
    })
  },
  btn1: function () {
    this.setData({
      btn1: false,
      btn2: true,
      color1: '#3894FF',
      color2: '#ccc',
      color3: '#ccc',
      color4: '#ccc',
      type1: 'zhibokecheng',

    })
  },
  btn2: function () {
    this.setData({
      btn1: false,
      btn2: true,
      color1: '#ccc',
      color2: '#3894FF',
      color3: '#ccc',
      color4: '#ccc',
      type1: 'juemikecheng',
    })
  },
  btn3: function () {
    this.setData({
      btn2: false,
      btn1: true,
      color1: '#ccc',
      color2: '#ccc',
      color3: '#3894FF',
      color4: '#ccc',
      type1: 'dianbokecheng',
    })
  },
  btn4: function () {
    this.setData({
      btn2: false,
      btn1: true,
      color1: '#ccc',
      color2: '#ccc',
      color3: '#ccc',
      color4: '#3894FF',
      type1: 'yanxuekecheng',
    })
  },
  //选择座位
  chooseseat: function (e) {
    // console.log(e);
    // console.log(seats)
    this.setData({
      seats: e.currentTarget.dataset.seats
    })
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
    this.getallzw();

  },
  getallzw:function(){
    // 获取预约座位信息
    var that = this
    wx.request({
      url: 'http://www.wxxz.com/getallzw  ',
      header: {
        'content': 'json'
      },
      success(res) {
        that.setData({
          yxzw: res.data
        })
        if ((that.data.yxzw).indexOf('VIP1') !== -1) {
          that.setData({
            vip1: true
          })
        } else {
          that.setData({
            vip1: false
          })
        }
        if ((that.data.yxzw).indexOf('VIP2') !== -1) {
          that.setData({
            vip2: true
          })
        } else {
          that.setData({
            vip2: false
          })
        }
        if ((that.data.yxzw).indexOf('VIP3') !== -1) {
          that.setData({
            vip3: true
          })
        } else {
          that.setData({
            vip3: false
          })
        }
        if ((that.data.yxzw).indexOf('VIP4') !== -1) {
          that.setData({
            vip4: true
          })
        } else {
          that.setData({
            vip4: false
          })
        }
        if ((that.data.yxzw).indexOf('VIP5') !== -1) {
          that.setData({
            vip5: true
          })
        } else {
          that.setData({
            vip5: false
          })
        }
        if ((that.data.yxzw).indexOf('VIP6') !== -1) {
          that.setData({
            vip6: true
          })
        } else {
          that.setData({
            vip6: false
          })
        }
        if ((that.data.yxzw).indexOf('VIP7') !== -1) {
          that.setData({
            vip7: true
          })
        } else {
          that.setData({
            vip7: false
          })
        }
        if ((that.data.yxzw).indexOf('VIP8') !== -1) {
          that.setData({
            vip8: true
          })
        } else {
          that.setData({
            vip8: false
          })
        }
        if ((that.data.yxzw).indexOf('VIP9') !== -1) {
          that.setData({
            vip9: true
          })
        } else {
          that.setData({
            vip9: false
          })
        }
        if ((that.data.yxzw).indexOf('VIP10') !== -1) {
          that.setData({
            vip10: true
          })
        } else {
          that.setData({
            vip10: false
          })
        }
        if ((that.data.yxzw).indexOf('A1') !== -1) {
          that.setData({
            a1: true
          })
        } else {
          that.setData({
            a1: false
          })
        }
        if ((that.data.yxzw).indexOf('A2') !== -1) {
          that.setData({
            a2: true
          })
        } else {
          that.setData({
            a2: false
          })
        }
        if ((that.data.yxzw).indexOf('A3') !== -1) {
          that.setData({
            a3: true
          })
        } else {
          that.setData({
            a3: false
          })
        }
        if ((that.data.yxzw).indexOf('A4') !== -1) {
          that.setData({
            a4: true
          })
        } else {
          that.setData({
            a4: false
          })
        }
        if ((that.data.yxzw).indexOf('A5') !== -1) {
          that.setData({
            a5: true
          })
        } else {
          that.setData({
            a5: false
          })
        }
        if ((that.data.yxzw).indexOf('A6') !== -1) {
          that.setData({
            a6: true
          })
        } else {
          that.setData({
            a6: false
          })
        }
        if ((that.data.yxzw).indexOf('A7') !== -1) {
          that.setData({
            a7: true
          })
        } else {
          that.setData({
            a7: false
          })
        }
        if ((that.data.yxzw).indexOf('A8') !== -1) {
          that.setData({
            a8: true
          })
        } else {
          that.setData({
            a8: false
          })
        }
        if ((that.data.yxzw).indexOf('B1') !== -1) {
          that.setData({
            b1: true
          })
        } else {
          that.setData({
            b1: false
          })
        }
        if ((that.data.yxzw).indexOf('B2') !== -1) {
          that.setData({
            b2: true
          })
        } else {
          that.setData({
            b2: false
          })
        }
        if ((that.data.yxzw).indexOf('B3') !== -1) {
          that.setData({
            b3: true
          })
        } else {
          that.setData({
            b3: false
          })
        }
        if ((that.data.yxzw).indexOf('B4') !== -1) {
          that.setData({
            b4: true
          })
        } else {
          that.setData({
            b4: false
          })
        }
        if ((that.data.yxzw).indexOf('B5') !== -1) {
          that.setData({
            b5: true
          })
        } else {
          that.setData({
            b5: false
          })
        }
        if ((that.data.yxzw).indexOf('B6') !== -1) {
          that.setData({
            b6: true
          })
        } else {
          that.setData({
            b6: false
          })
        }
        if ((that.data.yxzw).indexOf('B7') !== -1) {
          that.setData({
            b7: true
          })
        } else {
          that.setData({
            b7: false
          })
        }
        if ((that.data.yxzw).indexOf('B8') !== -1) {
          that.setData({
            b8: true
          })
        } else {
          that.setData({
            b8: false
          })
        }
        if ((that.data.yxzw).indexOf('B9') !== -1) {
          that.setData({
            b9: true
          })
        } else {
          that.setData({
            b9: false
          })
        }
        if ((that.data.yxzw).indexOf('B10') !== -1) {
          that.setData({
            b10: true
          })
        } else {
          that.setData({
            b10: false
          })
        }
        if ((that.data.yxzw).indexOf('B11') !== -1) {
          that.setData({
            b11: true
          })
        } else {
          that.setData({
            b11: false
          })
        }
        if ((that.data.yxzw).indexOf('B12') !== -1) {
          that.setData({
            b12: true
          })
        } else {
          that.setData({
            b12: false
          })
        }
        if ((that.data.yxzw).indexOf('C1') !== -1) {
          that.setData({
            c1: true
          })
        } else {
          that.setData({
            c1: false
          })
        }
        // if((that.data.yxzw).indexOf('C1')!==-1){
        //   that.setData({c1:true})
        // }
        if ((that.data.yxzw).indexOf('C2') !== -1) {
          that.setData({
            c2: true
          })
        } else {
          that.setData({
            c2: false
          })
        }
        if ((that.data.yxzw).indexOf('C3') !== -1) {
          that.setData({
            c3: true
          })
        } else {
          that.setData({
            c3: false
          })
        }
        if ((that.data.yxzw).indexOf('C4') !== -1) {
          that.setData({
            c4: true
          })
        } else {
          that.setData({
            c4: false
          })
        }
        if ((that.data.yxzw).indexOf('C5') !== -1) {
          that.setData({
            c5: true
          })
        } else {
          that.setData({
            c5: false
          })
        }
        if ((that.data.yxzw).indexOf('C6') !== -1) {
          that.setData({
            c6: true
          })
        } else {
          that.setData({
            c6: false
          })
        }
        if ((that.data.yxzw).indexOf('C7') !== -1) {
          that.setData({
            c7: true
          })
        } else {
          that.setData({
            c7: false
          })
        }
        if ((that.data.yxzw).indexOf('C8') !== -1) {
          that.setData({
            c8: true
          })
        } else {
          that.setData({
            c8: false
          })
        }
        if ((that.data.yxzw).indexOf('C9') !== -1) {
          that.setData({
            c9: true
          })
        } else {
          that.setData({
            c9: false
          })
        }
        if ((that.data.yxzw).indexOf('C10') !== -1) {
          that.setData({
            c10: true
          })
        } else {
          that.setData({
            c10: false
          })
        }
        if ((that.data.yxzw).indexOf('C11') !== -1) {
          that.setData({
            c11: true
          })
        } else {
          that.setData({
            c11: false
          })
        }
        if ((that.data.yxzw).indexOf('C12') !== -1) {
          that.setData({
            c12: true
          })
        } else {
          that.setData({
            c12: false
          })
      }
      }
    })
  },
  
  // 获取用户姓名
  getname: function (e) {
    this.data.username = e.detail
  },
  // 获取用户手机号
  getphone: function (e) {
    this.data.phone = e.detail
  },
  // 获取选择信息
  confirmseat: function () {
    var type = this.data.type1//座位类型
    var seats = this.data.seats//座位号
    var name = this.data.username//用户名
    var phone = this.data.phone//手机号
    var oldstarttime = this.data.date + " " + this.data.time
    var oldendtime = this.data.date1 + " " + this.data.time1
    // 修改间隔号
    var starttime = oldstarttime.replace(/-/g, '.')//开始时间
    var endtime = oldendtime.replace(/-/g, '.')//结束时间
    var oldtime = this.data.time
    var oldtime1 = this.data.time1
    var timearr = oldtime.split(':')
    var time1arr = oldtime1.split(':')
    var newstarttime = timearr[0] * 3600 + timearr[1] * 60
    var newendtime = time1arr[0] * 3600 + time1arr[1] * 60
    var time = newendtime - newstarttime//预约时间
    if (seats === '') {
      wx.showToast({
        title: '请选择座位',
        icon: 'error'
      })
      return
    } else if (Number.isNaN(time) || this.data.date === '日期' || this.data.date1 === '日期') {
      wx.showToast({
        title: '请选择预约时间',
        icon: 'error'
      })
      return
    } else if (name === '') {
      wx.showToast({
        title: '请输入姓名',
        icon: 'error'
      })
      return
    }
    console.log(starttime)

    wx.request({
      url: `http://www.wxxz.com/yuyue/${type}-${seats}-${starttime}-${endtime}-${name}-${phone}-${time}`,
      header: {
        'content-type': 'json' // 默认值
      },
      success(res) {
        if (res.data.msg === 'ok') {
          wx.showToast({
            title: '预约成功',
            icon: 'success'
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
   // 下拉更新
   onRefresh() {
    //在当前页面显示导航条加载动画
    wx.showNavigationBarLoading();
    //显示 loading 提示框。需主动调用 wx.hideLoading 才能关闭提示框
    wx.showLoading({
      title: '刷新中...',
    })
    // 停止下拉
    this.getallzw();
    // 停止下拉操作，关闭动画效果
    this.getData();

  },        
  //网络请求，获取数据
  getData() {
    //隐藏loading 提示框
    wx.hideLoading();
    //隐藏导航条加载动画
    wx.hideNavigationBarLoading();
    //停止下拉刷新
    wx.stopPullDownRefresh();
    this.setData({
      seats: ''
    })
  },
  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
    this.onRefresh();
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