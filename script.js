const eventSource = new EventSource("/sse");
eventSource.onmessage = function (event) {
    if (event['data'] === 'update') {
        //check_cart(); or some script
    }
};

eventSource.onopen = function (e) {
    console.log("Открыто соединение");
            };

eventSource.onerror = function (e) {
    console.log(e);
};
