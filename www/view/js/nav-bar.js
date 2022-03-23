/* Masque ou affiche la bar lateral de navigation */
var sideBarToggler = function() {
    let hasBar = false;
    let button = document.querySelector("#nav-bar-toggler")

    /* Evement sur le bouton nav-bar-toggler */
    button.addEventListener('click',function(e) {
        e.stopPropagation()
        e.preventDefault()
        if(hasBar) {
            document.body.classList.remove('has-sidebar')
            hasBar=false
        } else {
        document.body.classList.add('has-sidebar')
        hasBar = true }
    })

    /* Evement sur le reste */
    document.body.addEventListener('click', function(e) {
        if(hasBar) {
        document.body.classList.remove('has-sidebar')
        hasBar = false
        }
    })

} 

sideBarToggler();