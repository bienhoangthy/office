var OneSignal = window.OneSignal || [];
OneSignal.push(["init", {
appId: "141222d1-61b5-4bd5-89fc-8b24d54be640",
autoRegister: false, /* Set to true to automatically prompt visitors */
subdomainName: 'crmioi.onesignal.com',   
notifyButton: {
    enable: true, /* Set to false to hide */
    text: {
        'tip.state.unsubscribed': 'Đăng ký nhận thông báo',
        'tip.state.subscribed': 'Bạn đã đăng ký nhận thông báo',
        'tip.state.blocked': 'Bạn đã chặn hiển thị thông báo',
        'message.prenotify': 'Click để đăng ký nhận thông báo mới nhất',
        'message.action.subscribed': 'Cảm ơn bạn đã đăng ký!',
        'message.action.resubscribed': 'Bạn đã đăng ký nhận thông báo',
        'message.action.unsubscribed': 'Bạn đã hủy đăng ký nhận thông báo',
        'dialog.main.title': 'Quản lý thông báo',
        'dialog.main.button.subscribe': 'ĐĂNG KÝ',
        'dialog.main.button.unsubscribe': 'HỦY ĐĂNG KÝ',
        'dialog.blocked.title': 'Bỏ chặn thông báo',
        'dialog.blocked.message': 'Thực hiện các hướng dẫn sau để cho phép thông báo:'
    }
},
welcomeNotification: {
    title: 'office.ioi.vn',
    message: 'Cảm ơn bạn đã đăng ký!'
},
sendTags: {
    user_id: configs.user_id
},
promptOptions: {
    siteName: 'office.ioi.vn',
    actionMessage: 'Nhận thông báo mới nhất từ hệ thống crm',
    exampleNotificationTitle: 'office.ioi.vn',
    exampleNotificationMessage: 'Nhận thông báo mới nhất',
    exampleNotificationCaption: 'Bạn có thể dừng nhận thông báo bất kỳ lúc nào',
    acceptButtonText: 'CHO PHÉP',
    cancelButtonText: 'BỎ QUA'
}
}]);