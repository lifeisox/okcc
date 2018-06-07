const TOASTR_STYLE = 'width: 500px !important';

// https://github.com/axios/axios
function axiosErrorMessage( error ) { 
    var message = '';
    if (error.response) {
        // The request was made and the server responded with a status code that falls out of the range of 2xx
        const str = '' + error.response.data.error;
        message += 'Status: (' + error.response.status + ') ' + error.response.statusText + '<br/>' + str.replace(/.,/g, '.<br/>');
    } else if (error.request) {
        // The request was made but no response was received `error.request` is an instance of XMLHttpRequest in the browser and an instance of http.ClientRequest in node.js
        message += error.request;
    } else {
        // Something happened in setting up the request that triggered an Error
        message += error.message;
    }
    toastr.error( message ).attr('style', TOASTR_STYLE);
}

function sendSuccessMessage() {
    toastr.success( i18n.messages.errors.send_success ).attr('style', TOASTR_STYLE);
}

function saveSuccessMessage() {
    toastr.success( i18n.messages.errors.save_success ).attr('style', TOASTR_STYLE);
}

function deleteSuccessMessage() {
    toastr.success( i18n.messages.errors.delete_success ).attr('style', TOASTR_STYLE);
}