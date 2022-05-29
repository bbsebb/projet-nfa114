let inputDate = document.querySelector('#date');
let select = document.querySelector('select[name="doctors"]');
let button = document.querySelector('#button');
let timeslots = document.querySelector("#timeslots");
let idDoctor = select.value;
let  inputs = document.querySelectorAll("#timeslots input:NOT(.slot-occupied)");

addListner = function(inputs) {
  inputs.forEach(input => {
    input.addEventListener('click', function(e) {
      makeTimeslots(this);    
    })
  });
}
 
var dateTime = new Date();
(function () {
    inputDate.valueAsDate = new Date();
    addListner(inputs);
})()

select.addEventListener('change', function(e) {
   idDoctor = e.target.value;
   listTimeslots();
})

inputDate.addEventListener('change', function(e) {
    dateTime = e.target.valueAsDate;
    listTimeslots();
 })

makeTimeslots = function(input) {
  let xmlhttp = new XMLHttpRequest();

  
  xmlhttp.onreadystatechange = function() {  
    if (this.readyState == 4 && this.status == 200) {
      input.classList.add('slot-made');  
    } else {
      
    }
  };
    let url = 'agenda/'+idDoctor+'/'+dateTime.getFullYear()+'-'+(dateTime.getMonth()+1)+'-'+dateTime.getDate();
    xmlhttp.open("POST",url, true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send("time="+input.value);   
}


 listTimeslots = function() {
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      
      if (this.readyState == 4 && this.status == 200) {
        timeslots.innerHTML = this.responseText;
        inputs = document.querySelectorAll("#timeslots input:NOT(.slot-occupied)");
        addListner(inputs);
      } else {
        timeslots.innerHTML = 'erreur de chargement';
      }
    };
      let url = 'agenda/'+idDoctor+'/'+dateTime.getFullYear()+'-'+(dateTime.getMonth()+1)+'-'+dateTime.getDate();
      xmlhttp.open("GET",url, true); 
    xmlhttp.send(); 
 }





