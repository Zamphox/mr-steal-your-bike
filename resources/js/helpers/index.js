export function displayRequestErrorMessage(response) {
    var message = response.data.message ?? 'A server error has occurred';
    var firstError = response.data.errors ? Object.values(response.data.errors)[0][0] : message;
    Vue.notify({title: message, text: firstError, type: 'error'});
}
