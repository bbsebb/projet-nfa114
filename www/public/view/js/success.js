var successHidden = function () {
    
    let success =  document.querySelectorAll(".success");
    success.forEach(element => {
    
        element.addEventListener('click', function(e) {
            element.classList.remove('success');
            element.classList.add('success-hidden');
        })
    });
}

successHidden();