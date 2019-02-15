$(document).ready(function () {
    var $carousel = $('#carousel'), // on cible le bloc du carrousel
            $img = $('#carousel img'), // on cible les images contenues dans le carrousel
            indexImg = $img.length - 1, // on définit l'index du dernier élément
            i = 0, // on initialise un compteur
            $currentImg = $img.eq(i); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant)
    $img.css('display', 'none'); // on cache les images
    $currentImg.css('display', 'block'); // on affiche seulement l'image courante
    // image suivante
    $('.next').click(function () {
        i++; // on incrémente le compteur
        if (i <= indexImg) {
            $img.css('display', 'none'); // on cache les images
            $currentImg = $img.eq(i); // on définit la nouvelle image
            $currentImg.css('display', 'block'); // puis on l'affiche
        } else {
            i = indexImg;
        }
    });
    // image précédente
    $('.prev').click(function () {
        i--; // on décrémente le compteur, puis on réalise la même chose que pour la fonction "suivante"
        if (i >= 0) {
            $img.css('display', 'none');
            $currentImg = $img.eq(i);
            $currentImg.css('display', 'block');
        } else {
            i = 0;
        }
    });
    function slideImg() {
        setTimeout(function () { // on utilise une fonction anonyme
            if (i < indexImg) { // si le compteur est inférieur au dernier index
                i++; // on l'incrémente
            } else { // sinon, on le remet à 0 (première image)
                i = 0;
            }
            $img.css('display', 'none');
            $currentImg = $img.eq(i);
            $currentImg.css('display', 'block');
            slideImg(); // on oublie pas de relancer la fonction à la fin
        }, 8000); // on définit l'intervalle à 8000 millisecondes (8s)
    }
    slideImg(); // enfin, on lance la fonction une première fois
});