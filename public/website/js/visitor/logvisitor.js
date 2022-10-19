document.addEventListener('readystatechange', (event) => {
    if(document.readyState === "complete"){
        if(typeof model_data != "undefined"){
            logCount(model_data);
        }
    }
});


function logCount(data){

    // Make a POST request
    fetch("/visitor/log", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute("content")
        }
    }).then(function (response) {
        if (response.ok) {
            return response.json();
        }
        return Promise.reject(response);
    }).then(function (data) {
        console.log(data);
    }).catch(function (error) {
        console.warn('Something went wrong.', error);
    });
}