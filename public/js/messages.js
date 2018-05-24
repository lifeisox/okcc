const TOASTR_STYLE = 'width: 500px !important';

// https://github.com/axios/axios
function axiosErrorMessage( error ) { 
    var message = '';
    if (error.response) {
        // The request was made and the server responded with a status code that falls out of the range of 2xx
        message += error.response.data + '<br/>' + error.response.status + '<br/>' + error.response.headers;
    } else if (error.request) {
        // The request was made but no response was received `error.request` is an instance of XMLHttpRequest in the browser and an instance of http.ClientRequest in node.js
        message += error.request;
    } else {
        // Something happened in setting up the request that triggered an Error
        message += error.message;
    }
    if (message) { message += '<br/>' + error.config }

    toastr.error( message ).attr('style', TOASTR_STYLE);
}

function sendSuccessMessage() {
    toastr.success( i18n.messages.errors.send_success ).attr('style', TOASTR_STYLE);
}

function validationOrExceptionErrorMessage( kind, errors) {
    var message = (kind === 'validation') ? '>>> Validation Error >>><br/>' : '>>> Exception Error >>><br/>';
    for (var i=0; i < errors.length; i++) {
        message += errors[i] + ( i < errors.length -1 ? '<br/>' : '' );
    } 
    toastr.error( message ).attr('style', TOASTR_STYLE);
}