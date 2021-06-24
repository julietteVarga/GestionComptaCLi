/*$(document).ready(function(){
    $(".btn-secondary").click(function(){
       /* $(".navbar-light").css("display", "flex");
        $(".btn-secondary ").css("display", "none");
        $("header").css("background-color", "var( --bg-nav-color)");
        $("header").css("justify-content", "center");
       $("").css("display", "none");
        console.log('click btn');
    })

    $(".close-btn").click(function(){
        $(".navbar_responsive").css("display", "none");
        $(".open-btn").css("display", "flex");
        $(".header_blockleft").css("display", "flex");

    })

   $(".navbar_responsive li").click(function(){
        $(".navbar_responsive").css("display", "none");
        $(".open-btn").css("display", "flex");
    })

})*/
let intro = document.querySelector('.intro');
let logo = document.querySelector('.logo-header');
let logoSpan = document.querySelectorAll('.logo');

window.addEventListener('DOMContentLoaded', () => {

    setTimeout(() => {
        logoSpan.forEach((span, idx) => {
            setTimeout(() => {
                span.classList.add('active');
            }, (idx + 1) * 500)
        });


        setTimeout(() => {
            logoSpan.forEach((span, idx) => {
                setTimeout(() => {
                    span.classList.remove('active');
                    span.classList.add('fade');
                }, (idx + 1) * 50)
            })
        }, 2000)
    })
})
//Création de collectionHolder "todo voir la doc"
    var $collectionHolder;
//ajouter un bouton pour pouvoir ajouter une ligne de facture
    var $ajouterUneLigne = $('<a href="#" class="btn btn-primary">Ajouter une ligne de facture </a>');

    $(document).ready(function () {
        //recuperer le collectionHolder pour pouvoir
         $collectionHolder = $('#ligneFacture');
        //ajouter le bouton ajouter au collectionholder
         $collectionHolder.append($ajouterUneLigne);
        //création d'index qui va remplacer le "__name__" dans le panel => en gros remplacer le " name " par un numero pour qu'on puisse le catcher après
         $collectionHolder.data('index', $collectionHolder.find('.panel').length)

        //ajouter un bouton pour la suppression des lignes
         $collectionHolder.find('.panel').each(function (item) {
         ajoutBoutonSuppr($(this));
         });
        $ajouterUneLigne.click(function (e) {
        e.preventDefault();
        //crée un nouveau formulaire et rattacher au collectinHolder
        ajouterForm();
         })
    });

function ajouterForm() {
    //récuperer le prototype de facture.form.twig
    var prototype = $collectionHolder.data('prototype');
    //recupération d'index
    var index = $collectionHolder.data('index')
    // création du form
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    //création de nouveau panel
    var $panel = $('<div class="panel panel-primary"><div class="panel-heading"></div></div>');
    //création de panel body et rajouter le form dedans
    var $panelBody = $('<div class="panel-body"></div>').append(newForm);
    $panel.append($panelBody);
    //rajouter le bouton de suppression au nouveau panel
    ajoutBoutonSuppr($panel);
    // ajouter le nouveau panel au "$ajouterUneLigne"
    $ajouterUneLigne.before($panel);
}
//fonction qui permet d'ajouter un bouton qu'on l'itulise pour supprimer des lignes
function ajoutBoutonSuppr($panel) {
    //création de bouton de suppression
    var $supprBouton = $('<a href="#" class="btn btn-danger">Supprimer</a>');
    // ajouter le bouton de suppression au panel footer
    var $panelFooter = $('<div class="panel-footer"></div>').append($supprBouton);

        $supprBouton.click(function (e) {
            e.preventDefault();
            $(e.target).parents('.panel').slideUp(1000, function () {
                $(this).remove();
            });
        });
        $panel.append($panelFooter);
    }
