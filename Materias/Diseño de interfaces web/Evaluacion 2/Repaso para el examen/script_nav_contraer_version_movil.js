// https://es.stackoverflow.com/questions/414160/no-se-contrae-el-listado-del-men%C3%BA-hamburguesa-o-colapsado-de-boostrap-cuando-s
// https://stackoverflow.com/questions/42401606/how-to-hide-collapsible-bootstrap-navbar-on-click
// https://www.codeply.com/p/uWBbtTSsle
        /*-- Aplicamos a todos los enlaces del navbar menos al último que es un desplegable --*/
        let navbar = document.querySelectorAll(".navbar-nav>li>a");
        let menuToogle = document.querySelector("#collapsibleNavId");
        let bsCollapse = new bootstrap.Collapse(menuToogle, {toggle:false});
        for (let i = 0; i < navbar.length - 1; i++) {
            let enlace = navbar[i];
            enlace.addEventListener("click", () => {
                bsCollapse.hide();
            });
        }

        /*-- Aplicamos a los enlaces del desplegable --*/
        let desplegable = document.querySelectorAll(".dropdown-menu>.dropdown-item");
        desplegable.forEach((enlace) => {
            enlace.addEventListener("click", () => {
                bsCollapse.hide();
            });
        });
        
        /*-- Con JQuery (todavia no lo hemos dado asi que no entiendo como funciona ni por que es mas sencillo de hacer que en JavaScript) --*/
        // $('.navbar-nav>li>a').on('click', function(){
        //     $('.navbar-collapse').collapse('hide');
        // });