function makeToast(title, message, type) {
    switch (type) {
        case 'SUCCESS' : toastr.success(message, title); break;            
        case 'WARNING': toastr.warning(message, title); break;
        case 'INFO'   : toastr.info(message, title);
    }
}
