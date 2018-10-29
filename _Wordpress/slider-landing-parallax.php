<?php
/**
 * Template Name: Slider-parallax
 */

get_header();

?>
 <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
   <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
   <script type="text/javascript" src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

   <link href="https://code.jquery.com/ui/1.11.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />

<div class="slider-parallax">
	
</div>

<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/right-arrow.svg" id="right-arrow"/>
<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/left-arrow.svg" id="left-arrow"/>


<style type="text/css">
  	body{
    	margin:0;
    	padding:0;
 	}
	.slider-parallax{
		width:100%;
		height:100vh;
		background-color:#000;
		overflow:hidden;
	}
	 #right-arrow{
      position:absolute;
      z-index:801;
      right:20px;
      top:50%;
      width:60px;
      height:auto;
      -webkit-transform: translateY(-50%);
       -ms-transform: translateY(-50%);
       transform: translateY(-50%);
	   }
	   #left-arrow{
		  position:absolute;
		  z-index:800;
		  left:20px;
		  top:50%;
		  width:60px;
		  height:auto;
		  -webkit-transform: translateY(-50%);
		   -ms-transform: translateY(-50%);
		   transform: translateY(-50%);
	   }
	
</style>

<script>

   $( window ).on( "load", function() {

   		//INIT -- on crée un variable z-index à décrementer
        window.zindex=800; 

        //INIT -- on crée une variable d'identation de tableau
 		window.i=0; 

 		//INIT-- création de variable d'initialisation pour la première fois où on arrive sur le site
 		window.varInit=0;

 		//INIT-- on initialise le sens d'aniamtion des slide
 		window.sensSlide=1;



 		//INIT -- on crée les tableaux
 		window.bg=["01-bg-01.jpg","02-bg-01.jpg","03-bg-01.jpg"];
 		window.middle=["01-bg-02.png","02-bg-02.png","03-bg-02.png"];
 		window.front=["01-bg-03.png","02-bg-03.png","03-bg-03.png"];

 		//On appelle la fonction de création de slide
 		creaSlide();

 		  //INIT -- lorsqu'on clique sur le bouton suivant
         $( "#right-arrow" ).click(function() {
            //on décrémente le z-index
            zindex--;
            //on incrémentde l'index / si on est à al fin du tableau on revient au début
            i++;
            if (i==bg.length){
               i=0;
            }
            //on indique el sens d'animation
            sensSlide=1;
            //on appelle la fonction qui ajoute une nouvelle slide
            creaSlide();
            //on incrémente var init pour dire qu'on est plus sur al première slide on qu'on peut donc faire des animations
            varInit++;
            
         //INIT - Fin d'action bouton suivant
         });
         //INIT -- lorsqu'on clique sur le bouton precedent
         $( "#left-arrow" ).click(function() {
            //on décrémente le z-index
            zindex--;
            //on incrémentde l'index / si on est à al fin du tableau on revient au début
            i--;
            if (i<0){
               i=bg.length-1;
            }
             //on indique el sens d'animation
            sensSlide=0;
            //on appelle la fonction qui ajoute une nouvelle slide
            creaSlide();
         
         //INIT - Fin d'action bouton suivant 
         });


	  

            
   });

   	function creaSlide(){

   		 //INIT- on applique un preload aux images servant à créer la slide
	   preloadPictures(['<?php echo get_stylesheet_directory_uri(); ?>/img/'+bg[i], '<?php echo get_stylesheet_directory_uri(); ?>/img/'+middle[i], '<?php echo get_stylesheet_directory_uri(); ?>/img/'+front[i]], function(){
	   	
	   		//si c'est chargé, on appelle la fonction qui va créer la slide
           init_ladscape();

		});
   	}
	
	
	function init_ladscape(){
		
		//on crée la slide
		 $('.slider-parallax').append("<div class='slide-parallax"+zindex+"'></div>");

		//INIT -- on ajoute un style au slide de la valeur d'index
		 $('.slide-parallax'+zindex).css('position','absolute');
		 $('.slide-parallax'+zindex).css('z-index',zindex);
		 $('.slide-parallax'+zindex).css('top','0');
		 //si c'est la première slide qui apparait on la met avec une amrge à 0, pour qu'elle apparaisse à l'écran tout de suite
		 if(varInit==0){
		 	$('.slide-parallax'+zindex).css('left','0');
		 	
		 }else{
		 	//sinon on la place à la droite de l'ecran prête à être animée pour arriver
		 	$('.slide-parallax'+zindex).css('left',$(window).width());
		 }
		 $('.slide-parallax'+zindex).css('width','100%');
		 $('.slide-parallax'+zindex).css('height','100%');
		 $('.slide-parallax'+zindex).css('overflow','hidden');
	   //INIT -- on y insère les div d'images (elle même dans des div pour le redimensionnement wordpress)
	    $('.slide-parallax'+zindex).append("<div class='conteneurSlides'></div>");
	     $('.slide-parallax'+zindex).children('.conteneurSlides').css('position','relative');
		 $('.slide-parallax'+zindex).children('.conteneurSlides').css('width','100%');
		 $('.slide-parallax'+zindex).children('.conteneurSlides').css('height','100%');
	   $('.slide-parallax'+zindex).children('.conteneurSlides').append("<div class='01-slideInterne"+zindex+"'><img src='<?php echo get_stylesheet_directory_uri(); ?>/img/"+bg[i]+"'/></div>");
	   $('.slide-parallax'+zindex).children('.conteneurSlides').append("<div class='02-slideInterne"+zindex+"'><img src='<?php echo get_stylesheet_directory_uri(); ?>/img/"+middle[i]+"'/></div>");
	   $('.slide-parallax'+zindex).children('.conteneurSlides').append("<div class='03-slideInterne"+zindex+"'><img src='<?php echo get_stylesheet_directory_uri(); ?>/img/"+front[i]+"'/></div>");
	   //INIT -- on recupère la taille originelle de l'image pour l'utiliser comme valeur de base lors du redimensionnement
	   window.tailleWimg01= $('.01-slideInterne'+zindex+' img').width();
	   window.tailleHimg01= $('.01-slideInterne'+zindex+' img').height();
	   window.tailleWimg02= $('.02-slideInterne'+zindex+' img').width();
	   window.tailleHimg02= $('.02-slideInterne'+zindex+' img').height();
	   window.tailleWimg03= $('.03-slideInterne'+zindex+' img').width();
	   window.tailleHimg03= $('.03-slideInterne'+zindex+' img').height();
	   //INIT -- on ajuste la div contenant l'image à la taille originelle de l'image
	   $('.01-slideInterne'+zindex).css('width',tailleWimg01);
	   $('.01-slideInterne'+zindex).css('height',tailleHimg01);
	   $('.02-slideInterne'+zindex).css('width',tailleWimg02);
	   $('.02-slideInterne'+zindex).css('height',tailleHimg02);
	   $('.03-slideInterne'+zindex).css('width',tailleWimg03);
	   $('.03-slideInterne'+zindex).css('height',tailleHimg03);
	   //INIT -- on met l'image contenu à 100% partout et c'est la dive la contenant qu'on manipulera pour que ça passe sur wordpress
	   $( '.01-slideInterne'+zindex+' img' ).css('width','100%');
	   $( '.01-slideInterne'+zindex+' img' ).css('height','100%');
	   $( '.02-slideInterne'+zindex+' img' ).css('width','100%');
	   $( '.02-slideInterne'+zindex+' img' ).css('height','100%');
	   $( '.03-slideInterne'+zindex+' img' ).css('width','100%');
	   $( '.03-slideInterne'+zindex+' img' ).css('height','100%');

		//INIT -- on applique la fonction de redimentionnement pour chaque slide
	    miseEnPlace();
      	
	   //on applique l'effet au rollover de la souris 
		
	   var object1= $('.01-slideInterne'+zindex);
	   var object2=$('.02-slideInterne'+zindex);
	   var object3=$('.03-slideInterne'+zindex);
	   var layer=$('.slide-parallax'+zindex);
	   //On fait bouger le plan du milieu
	    layer.mousemove(function(e){
	        var valueX=(e.pageX * -1 / 20);  
	        object1.css({
	            'transform':'translate3d('+valueX+'px,0,0) '
	        });
	    });	
		//On fait bouger le plan du milieu
	    layer.mousemove(function(e){
	        var valueX=(e.pageX * -1 / 40);  
	        object2.css({
	            'transform':'translate3d('+valueX+'px,0,0) '
	        });
	    });	
	    //On fait bouger le premier plan
	    layer.mousemove(function(e){
	        var valueX=(e.pageX * -1 / 90); 
	        object3.css({
	            'transform':'translate3d('+valueX+'px,0,0) '
	        });
	    });	
	   $( window ).resize(function() {
            miseEnPlace();
         });

	   //si varinit n'est plus égal à zero, on fait une animation
 		 if(varInit>0){
 		 	
 		 	//si on a  appuyé sur la flèche droite
 		 	if(sensSlide==1){
 		 		
 		 		//on fait sortir la slide actuelle de l'écran
		       $('.slide-parallax'+(zindex+1)).animate({
		         	left: -($(window).width())
		        },"slow", function() { 
		        	//une fois sortie de l'écran on la supprime
		        	 $('.slide-parallax'+(zindex+1)).remove();

		        });
 			//on fait apparaitre la slide nouvellement crée
		      $('.slide-parallax'+(zindex)).animate({
              		left: 0
		       },"slow", function() {});
			}else if(sensSlide==0){
				$('.slide-parallax'+zindex).css('left',-($(window).width()));
 		 		
 		 		//on fait sortir la slide actuelle de l'écran
		       $('.slide-parallax'+(zindex+1)).animate({
		         	left:($(window).width())
		        },"slow", function() { 
		        	//une fois sortie de l'écran on la supprime
		        	 $('.slide-parallax'+(zindex+1)).remove();

		        });
 			//on fait apparaitre la slide nouvellement crée
		      $('.slide-parallax'+(zindex)).animate({
              		left: 0
		       },"slow", function() {});
			}
	   		
	   	 }

	}
	
	
	function miseEnPlace(){

	//Si la fenêtre est plus large que haute
      if($(window).width()>$(window).height()){
		  //on recupère la taille en pourcent de la tailel de la fenètre par rapport à la taille de la div
		  //on rajoute 20 pour être sûr que ça dépasse en alrgeur, pour ne pas avoir d'image coupée quand on fera le parallax
		  window.pourcentageDiv01=(($(window).width()*100)/tailleWimg01)+20;
		  window.pourcentageDiv02=(($(window).width()*100)/tailleWimg02)+20;
		  window.pourcentageDiv03=(($(window).width()*100)/tailleWimg03)+20;
		  //on applique ce pourcentage a la hauteur de la div
		  $('.01-slideInterne'+zindex).css('height',(pourcentageDiv01/100)*tailleHimg01);
		  $('.02-slideInterne'+zindex).css('height',(pourcentageDiv01/100)*tailleHimg02);
		  $('.03-slideInterne'+zindex).css('height',(pourcentageDiv01/100)*tailleHimg03);
		  //on l'applique à la largeur
		  $('.01-slideInterne'+zindex).css('width',(pourcentageDiv01/100)*tailleWimg01);
		  $('.02-slideInterne'+zindex).css('width',(pourcentageDiv01/100)*tailleWimg02);
		  $('.03-slideInterne'+zindex).css('width',(pourcentageDiv01/100)*tailleWimg03);
      }
	//Si la fenêtre est plus haute que large
	if($(window).height()>$(window).width()){
		  //on recupère la taille en pourcent de la tailte de la fenètre par rapport à la taille de la div
		  window.pourcentageDiv01=($(window).height()*100)/tailleHimg01;
		  window.pourcentageDiv02=($(window).height()*100)/tailleHimg02;
		  window.pourcentageDiv03=($(window).height()*100)/tailleHimg03;
		  //on applique ce pourcentage a la hauteur de la div
		  $('.01-slideInterne'+zindex).css('height',(pourcentageDiv01/100)*tailleHimg01);
		  $('.02-slideInterne'+zindex).css('height',(pourcentageDiv01/100)*tailleHimg02);
		  $('.03-slideInterne'+zindex).css('height',(pourcentageDiv01/100)*tailleHimg03);
		  //on l'applique à la largeur
		  $('.01-slideInterne'+zindex).css('width',(pourcentageDiv01/100)*tailleWimg01);
		  $('.02-slideInterne'+zindex).css('width',(pourcentageDiv01/100)*tailleWimg02);
		  $('.03-slideInterne'+zindex).css('width',(pourcentageDiv01/100)*tailleWimg03);
      }
		
	//Si la fenêtre est plus haute que large
	if($(window).height()>$('.01-slideInterne'+zindex+' img').height()){
		  //on recupère la taille en pourcent de la tailte de la fenètre par rapport à la taille de la div
		  window.pourcentageDiv01=($(window).height()*100)/tailleHimg01;
		  window.pourcentageDiv02=($(window).height()*100)/tailleHimg02;
		  window.pourcentageDiv03=($(window).height()*100)/tailleHimg03;
		  //on applique ce pourcentage a la hauteur de la div
		  $('.01-slideInterne'+zindex).css('height',(pourcentageDiv01/100)*tailleHimg01);
		  $('.02-slideInterne'+zindex).css('height',(pourcentageDiv01/100)*tailleHimg02);
		  $('.03-slideInterne'+zindex).css('height',(pourcentageDiv01/100)*tailleHimg03);
		  //on l'applique à la largeur
		  $('.01-slideInterne'+zindex).css('width',(pourcentageDiv01/100)*tailleWimg01);
		  $('.02-slideInterne'+zindex).css('width',(pourcentageDiv01/100)*tailleWimg02);
		  $('.03-slideInterne'+zindex).css('width',(pourcentageDiv01/100)*tailleWimg03);
      }
		
		//on applique le style à la div pour qu'elle soit centrée
		$('.01-slideInterne'+zindex).css('position','absolute');
		$('.01-slideInterne'+zindex).css('z-index','50');	
		$('.03-slideInterne'+zindex).css('left','0');
		$('.03-slideInterne'+zindex).css('top','0');
		
		//on applique le style à la div pour qu'elle soit centrée
		$('.02-slideInterne'+zindex).css('position','absolute');
		$('.02-slideInterne'+zindex).css('z-index','51');	
		$('.03-slideInterne'+zindex).css('left','0');
		$('.03-slideInterne'+zindex).css('top','0');
		
		//on applique le style à la div pour qu'elle soit centrée
		$('.03-slideInterne'+zindex).css('position','absolute');
		$('.03-slideInterne'+zindex).css('z-index','52');	
		$('.03-slideInterne'+zindex).css('left','0');
		$('.03-slideInterne'+zindex).css('top','0');


   }


   //preload d'images
   var preloadPictures = function(pictureUrls, callback) {
    var i,
        j,
        loaded = 0;

    for (i = 0, j = pictureUrls.length; i < j; i++) {
        (function (img, src) {
            img.onload = function () {                               
                if (++loaded == pictureUrls.length && callback) {
                    callback();
                }
            };

            // Use the following callback methods to debug
            // in case of an unexpected behavior.
            img.onerror = function () {};
            img.onabort = function () {};

            img.src = src;
        } (new Image(), pictureUrls[i]));
    }
};

</script>




<?php get_footer(); ?>

