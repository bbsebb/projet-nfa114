let inputDate = document.querySelector('#date');
let select = document.querySelector('select[name="doctors"]');
var idDoctor = null;
var dateTime = new Date();
(function () {
    select.option
    inputDate.valueAsDate = new Date();
})()

select.addEventListener('change', function(e) {
   idDoctor = e.target.value;
})

inputDate.addEventListener('change', function(e) {
    dateTime = e.target.valueAsDate;
 })


 let button = document.querySelector('#button');

 let test = document.querySelector("#test");

 ajax = function() {
     
    let xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        test.innerHTML = this.responseText;
      } else {
        test.innerHTML = "err";
      }
      
    };
    
    xmlhttp.open("GET", "admin/test", true);
    xmlhttp.send();
    alert(JSON.stringify(xmlhttp));
 }

  button.addEventListener('click',function() {
    ajax();
  });

