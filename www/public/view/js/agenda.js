var inputDate = document.querySelector('#date');

(function () {
    alert(new Date().toString());
    inputDate.value = Date.now().toString();
})()