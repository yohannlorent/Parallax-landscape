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



<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700');
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
	.titre-parallax{
		font-family: 'Open Sans', sans-serif;
		font-weight:700;
		text-align:center;
		color:#fff;
		font-size:120px;
		line-height:120px;
	}
	.chapeau-parallax{
		font-family: 'Open Sans', sans-serif;
		font-weight:400;
		text-align:center;
		color:#fff;
		font-size:22px;
		line-height:26px;
		margin-top:20px;
	}
	.bouton-parallax{
		font-family: 'Open Sans', sans-serif;
		font-weight:700;
		text-align:center;
		text-transform:uppercase;
		color:#fff;
		font-size:14px;
		line-height:18px;
		background-color:#d44d2e;
		margin-top:20px;
		display:inline-block;
		padding-top:10px;
		padding-bottom:10px;
		padding-left:25px;
		padding-right:25px;
		margin-left:auto;
		margin-right:auto;
	}
	a.bouton-parallax{
		text-decoration:none;	
	}
	a.bouton-parallax:hover{
		background-color:#fff;
		color:#d44d2e;
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

 		//INIT -- On crée une variable conteneur pour le timer de changement de slide
 		var p=0;

 		//INIT -- on crée les tableaux
 		window.bg=["01-bg-01.jpg","02-bg-01.jpg","03-bg-01.jpg"];
 		window.middle=["01-bg-02.png","02-bg-02.png","03-bg-02.png"];
 		window.front=["01-bg-03.png","02-bg-03.png","03-bg-03.png"];
	   	window.titre=["Mountains","Holidays","Asia"];
	   	window.chapeau=["A mountain is a large landform that rises above the surrounding land in a limited area, usually in the form of a peak. A mountain is generally steeper than a hill. Mountains are formed through tectonic forces or volcanism.","A holiday is a day set aside by custom or by law on which normal activities, especially business or work including school, are suspended or reduced. ","Asia is Earth's largest and most populous continent, located primarily in the Eastern and Northern Hemispheres."];
	   	window.bouton=["WATCH MORE","WATCH MORE","WATCH MORE"];

 		//On appelle la fonction de création de slide
 		creaSlide();
	   
	 
	   
	   	///////////////////////////////////
	    //   TIMER CHANGEMENT SLIDES     //
		///////////////////////////////////
         // INIT - on change de slide toute les 5 secondes
         var timer =setInterval(function(){ 

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

            //On fait disparaitre la progressbar pour al faire reaparaitre lorsque l'animationd e changement de slide sera finie
			 p=0;
			 $('.fondTimer').css('display','none');
			  
  			
         }, 5000);

	   ///////////////////////////////////
	   //           PROGRESS BAR        //
	   ///////////////////////////////////
	   
         //on crée un conteneur pour al progressbar auquel on pourra mettre la taille et la positionq ue l'on veut
        $('body').append("<div class='fondTimer'></div>");
	  	$('.fondTimer').css('position','absolute');
	  	$('.fondTimer').css('z-index','950');
	  	$('.fondTimer').css('bottom','0');
	  	$('.fondTimer').css('left','0');
	  	$('.fondTimer').css('width','100%');
	  	$('.fondTimer').css('height','5px');

	  	//on crée un conteneur à l'interieur ayant une position relative, qui permettra de mettr eles progress bar en absolute
	  	 $('.fondTimer').append("<div class='contentProgressBar'></div>");
	  	 $('.contentProgressBar').css('position','relative');
	  	$('.contentProgressBar').css('width','100%');
	  	$('.contentProgressBar').css('height','100%');

	  	//Un crée la progress bar de fond
	  	$('.contentProgressBar').append("<div class='bgProgessbar'></div>");
	  	$('.bgProgessbar').css('position','absolute');
	  	$('.bgProgessbar').css('z-index','2');
	  	$('.bgProgessbar').css('top','0');
	  	$('.bgProgessbar').css('left','0');
	  	$('.bgProgessbar').css('width','100%');
	  	$('.bgProgessbar').css('height','100%');
	  	$('.bgProgessbar').css('background-color','#fff');
	  	$('.bgProgessbar').css('opacity', '0');

	  	//On crée la progress bar
	  	$('.contentProgressBar').append("<div class='progessbar'></div>");
	  	$('.progessbar').css('position','absolute');
	  	$('.progessbar').css('z-index','3');
	  	$('.progessbar').css('top','0');
	  	$('.progessbar').css('left','0');
	  	$('.progessbar').css('width','0%');
	  	$('.progessbar').css('height','100%');
	  	$('.progessbar').css('background-color','#d44d2e');

	  	

	  	var progressionProgresseBar =setInterval(function(){ 

	  		//on incrémente la variable permettant de calculer le pourcentage de progression
        	p=p+50;
        	//on calcule le pourcentage de prograssion
            var pourcentage=(p*100)/5000;
            //on applique le pourcentage à la progress bar
            $('.progessbar').css('width',pourcentage+'%');
         }, 50);
	   
	   ///////////////////////////////////
	   //          BULLET POINTS        //
	   ///////////////////////////////////
	   
	   
	    //on crée le conteneur des bullet points
		$('body').append("<div class='conteneur-bullet-points'></div>");
	    //on y applique son style
	   $('.conteneur-bullet-points').css('position','absolute');
	   $('.conteneur-bullet-points').css('bottom','20px');
	   $('.conteneur-bullet-points').css('left','50%');
	   $('.conteneur-bullet-points').css('z-index','990');
	   $('.conteneur-bullet-points').css('-webkit-transform','translateX(-50%)');
	   $('.conteneur-bullet-points').css('-ms-transform','translateX(-50%)');
	   $('.conteneur-bullet-points').css('transform','translateX(-50%)');
	   
	
	   
	   //creation de la flèche gauche
	   $('.conteneur-bullet-points').append("<div class='left'></div>");
	   $('.left').css('width','17px');
	   $('.left').css('height','28px');
	   $('.left').css('float','left');
	   $('.left').css('position','relative');
	   $('.left').css('margin-top','3px');
	   $('.left').css('margin-right','20px');
	   
	   $('.left').append("<div class='left-barre-haut'></div>");
	   $('.left-barre-haut').css('position','absolute');
	   $('.left-barre-haut').css('right','0');
	   $('.left-barre-haut').css('top','8px');
	   $('.left-barre-haut').css('width','100%');
	   $('.left-barre-haut').css('height','3px');
	   $('.left-barre-haut').css('background-color','#fff');
	   $('.left-barre-haut').css('border-radius','3px');
	   $('.left-barre-haut').css('transform','rotate(-45deg)');
	   
	    $('.left').append("<div class='left-barre-bas'></div>");
	   $('.left-barre-bas').css('position','absolute');
	   $('.left-barre-bas').css('right','0');
	   $('.left-barre-bas').css('top','18px');
	   $('.left-barre-bas').css('width','100%');
	   $('.left-barre-bas').css('height','3px');
	   $('.left-barre-bas').css('background-color','#fff');
	   $('.left-barre-bas').css('border-radius','3px');
	   $('.left-barre-bas').css('transform','rotate(45deg)');
	   
	   //Au rollover
		$('.left').mouseover(function() {
			
			$('.left-barre-haut').css('background-color','#d44d2e');
			$('.left-barre-bas').css('background-color','#d44d2e');
			$(this).css('cursor', 'pointer');
		});
			
		//Au rollout
		$('.left').mouseout(function() {
		
			$('.left-barre-haut').css('background-color','#fff');
			$('.left-barre-bas').css('background-color','#fff');
		});
	   
	   
	   
         //INIT -- lorsqu'on clique sur le bouton precedent
        	$('.left').click(function() {
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
 			//on incrémente var init pour dire qu'on est plus sur al première slide on qu'on peut donc faire des animations
            varInit++;

            // on supprime le timer
            clearInterval(timer);
            //on supprime la progression de la progress bar
            clearInterval(progressionProgresseBar);
            //on supprime la progress bar
            $('.fondTimer').remove();

            
         
         //INIT - Fin d'action bouton suivant 
         });
	   
	   
	   
	   
	   
	   $('.bullet'+iter).css('width','16px');
	   //tant qu'il y a des slides...
	   	for(var iter = 0; iter < bg.length; iter++) {
			
			// on crée une bullet
			$('.conteneur-bullet-points').append("<div class='bullet"+iter+" bullet' id='"+iter+"'></div>");
			//on y applique un style
			$('.bullet'+iter).css('width','16px');
			$('.bullet'+iter).css('height','16px');
			$('.bullet'+iter).css('border-radius','16px');
			$('.bullet'+iter).css('background-color','#fff');
			$('.bullet'+iter).css('margin','10px');
			$('.bullet'+iter).css('float','left');
			
			//Au rollover
			$('.bullet'+iter).mouseover(function() {
				//si l'id de la bullet est egal à la slide actuelle
				if( $(this).attr("id") !=i){
					 $(this).animate({
		         		backgroundColor: '#d44d2e'
		        	},"800", function() { });
					$(this).css('cursor', 'pointer');
				}
			});
			
			//Au rollout
		   $('.bullet'+iter).mouseout(function() {
			   //si l'id de la bullet est egal à la slide actuelle
			   if( $(this).attr("id") ==i){
				   
					$(this).css('background-color','#d44d2e');
				}else{
				//sinon
					 $(this).animate({
		         		backgroundColor: '#fff'
		        	},"800", function() { });
				}
			});
			
			//Auclick
			$('.bullet'+iter).click(function() {
				
				//on détermine le sens d'animation
				if($(this).attr("id")<i){
					sensSlide=0;

				}else if($(this).attr("id")>i){
					sensSlide=1;
				}
				
				//Si on est pas sur la slide actuelle
				if($(this).attr("id") !=i){
					
					//on met l'identation à la meme valeur que l'id de la bullet
					i=$(this).attr("id");	
					//on décrémente le z-index
					zindex--;
					//on appelle la fonction qui ajoute une nouvelle slide
					creaSlide();
					//on incrémente var init pour dire qu'on est plus sur al première slide on qu'on peut donc faire des animations
					varInit++;
					// on supprime le timer
					clearInterval(timer);
					//on supprime la progression de la progress bar
					clearInterval(progressionProgresseBar);
					//On fait disparaitre la progressbar pour al faire reaparaitre lorsque l'animationd e changement de slide sera finie
					p=0;
					$('.fondTimer').css('display','none');

				}

			});

		}
	    
	    //creation de la flèche droite
	   $('.conteneur-bullet-points').append("<div class='droite'></div>");
	   $('.droite').css('width','17px');
	   $('.droite').css('height','28px');
	   $('.droite').css('float','left');
	   $('.droite').css('position','relative');
	   $('.droite').css('margin-top','3px');
	   $('.droite').css('margin-left','20px');
	   
	   $('.droite').append("<div class='droite-barre-haut'></div>");
	   $('.droite-barre-haut').css('position','absolute');
	   $('.droite-barre-haut').css('right','0');
	   $('.droite-barre-haut').css('top','8px');
	   $('.droite-barre-haut').css('width','100%');
	   $('.droite-barre-haut').css('height','3px');
	   $('.droite-barre-haut').css('background-color','#fff');
	   $('.droite-barre-haut').css('border-radius','3px');
	   $('.droite-barre-haut').css('transform','rotate(45deg)');
	   
	    $('.droite').append("<div class='droite-barre-bas'></div>");
	   $('.droite-barre-bas').css('position','absolute');
	   $('.droite-barre-bas').css('right','0');
	   $('.droite-barre-bas').css('top','18px');
	   $('.droite-barre-bas').css('width','100%');
	   $('.droite-barre-bas').css('height','3px');
	   $('.droite-barre-bas').css('background-color','#fff');
	   $('.droite-barre-bas').css('border-radius','3px');
	   $('.droite-barre-bas').css('transform','rotate(-45deg)');
	   
		//Au rollover
		$('.droite').mouseover(function() {
			$('.droite-barre-haut').css('background-color','#d44d2e');
			$('.droite-barre-bas').css('background-color','#d44d2e');
			$(this).css('cursor', 'pointer');
		});
			
		//Au rollout
		$('.droite').mouseout(function() {
			$('.droite-barre-haut').css('background-color','#fff');
			$('.droite-barre-bas').css('background-color','#fff');
		});
	   
	    //INIT -- lorsqu'on clique sur le bouton suivant
         $('.droite').click(function() {
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
            // on supprime le timer
            clearInterval(timer);
            //on supprime la progression de la progress bar
            clearInterval(progressionProgresseBar);
            //on supprime la progress bar
            $('.fondTimer').remove();
            
         //INIT - Fin d'action bouton suivant
         });
	  
            
   });

	
	
	
	///////////////////////////////////
	//      CHARGEMENT DS IMAGES     //
	///////////////////////////////////
   	function creaSlide(){

   		 //INIT- on applique un preload aux images servant à créer la slide
	   preloadPictures(['<?php echo get_stylesheet_directory_uri(); ?>/img/'+bg[i], '<?php echo get_stylesheet_directory_uri(); ?>/img/'+middle[i], '<?php echo get_stylesheet_directory_uri(); ?>/img/'+front[i]], function(){
	   	
	   		//si c'est chargé, on appelle la fonction qui va créer la slide
           init_landscape();

		});
   	}
	
	
	///////////////////////////////////
	//            CREA SLIDE         //
	///////////////////////////////////
	function init_landscape(){
		
		
		
		
		//on crée la slide
		 $('.slider-parallax').append("<div class='slide-parallax"+zindex+"'></div>");
		 $('.slide-parallax'+zindex).css('position','absolute');
		 $('.slide-parallax'+zindex).css('z-index',zindex);
		 $('.slide-parallax'+zindex).css('top','0');

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
		
		
		//On ajoute le contenu texte
		$('.slider-parallax').append("<div class='text-parallax"+zindex+"'></div>");
		$('.text-parallax'+zindex).css('position','absolute');
		$('.text-parallax'+zindex).css('z-index',zindex+10);
		$('.text-parallax'+zindex).css('top','50%');
		$('.text-parallax'+zindex).css('left','50%');
		$('.text-parallax'+zindex).css('width','40%');
		$('.text-parallax'+zindex).css('text-align','center');
		$('.text-parallax'+zindex).css('-webkit-transform','translate(-50%,-50%)');
	    $('.text-parallax'+zindex).css('-ms-transform','translate(-50%,-50%)');
	    $('.text-parallax'+zindex).css('transform','translate(-50%,-50%)');
		
		$('.text-parallax'+zindex).append("<div class='titre-parallax'>"+titre[i]+"</div>");
		$('.text-parallax'+zindex).append("<div class='chapeau-parallax'>"+chapeau[i]+"</div>");
		$('.text-parallax'+zindex).append("<a href='#' class='bouton-parallax'>"+bouton[i]+"</a>");
		
		
		tweenBlur($('.text-parallax'+zindex), 15, 0);

		//INIT -- on applique la fonction de redimentionnement pour chaque slide
	    miseEnPlace();
      	
	   //on applique l'effet au rollover de la souris 
		
	   var object1= $('.01-slideInterne'+zindex);
	   var object2=$('.02-slideInterne'+zindex);
	   var object3=$('.03-slideInterne'+zindex);
	   var layer=$(window);
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
				   //on initialise la variable de calcul de la progression et on fait ré apparaitre la progress bar
				    p=0;
  					$('.fondTimer').css('display','block');

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
		       },"slow", function() { 
			  });
			}
			 
			  tweenBlur($('.text-parallax'+(zindex+1)), 0, 15);
			 $('.text-parallax'+(zindex+1)).animate({
              		 opacity: 0 
		       },"slow", function() { 
				 $('.text-parallax'+(zindex+1)).remove();
			  });
			   tweenBlur($('.text-parallax'+zindex), 15, 0);
			
			 //on fait partir le texte
			/* $('.text-parallax'+(zindex+1)).animate({
              		 opacity: 0,
					'transform':'translate3d(0,0,-120px) '
		       },"slow", function() { 
			  });
			 */
	   		
	   	 }
		
		//on met a jour les bullets pour déterminer laquelle ne doit plus etre clickable
		$.each($(".bullet") , function (k){
			if( $(this).attr("id") ==i){
				$(this).css('background-color','#d44d2e');
			}else{
				$(this).css('background-color','#fff');
			}
		});

		
		
	}
	
	///////////////////////////////////////////////////////////////
	//            FONCTION DE TAILLE DES IMAGES AUTOMATIQUES     //
	///////////////////////////////////////////////////////////////
	
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


	////////////////////////////////////////
	//            PRELOAD IMAGES          //
	////////////////////////////////////////
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
	
	
	   // Generic function to set blur radius of $ele
    var setBlur = function(ele, radius) {
            $(ele).css({
               "-webkit-filter": "blur("+radius+"px)",
                "filter": "blur("+radius+"px)"
           });
       },
       
       // Generic function to tween blur radius
       tweenBlur = function(ele, startRadius, endRadius) {
            $({blurRadius: startRadius}).animate({blurRadius: endRadius}, {
                duration: 500,
                easing: 'swing', // or "linear"
                                 // use jQuery UI or Easing plugin for more options
                step: function() {
                    setBlur(ele, this.blurRadius);
                },
                complete: function() {
                    // Final callback to set the target blur radius
                    // jQuery might not reach the end value
                    setBlur(ele, endRadius);
               }
           });
        };
    

</script>




<?php get_footer(); ?>

