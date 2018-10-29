

	function crea_parallax(){

		//EFFET PARALLAX
		var object1=$('.object1');
	    var object2=$('.object2');
	    var object3=$('.object3');
	    var layer=$('.panel');
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


	    //SLIDER

	    //On compte le nombre de slides
	    window.compteur_slides=0;
	    window.slide_actuelle=1;
	    window.largeur_slide = $(window).width();
	    $.each($(".panel") , function (i){
			compteur_slides++;	
			 $(this).css('width' , largeur_slide );
		});
		
		//on détermine la largeur du conteneur
		$(".content-panel").css('width' , compteur_slides*largeur_slide );
		console.log(compteur_slides);
		console.log(compteur_slides*largeur_slide);
		//on met les slides une à la suite de l'autre
   		$(".panel").css('float' , 'left' );

   		//On anime le click des flèches
   		$( "#right-arrow" ).click(function() {
   			slideSuivante();
		});

		$( "#left-arrow" ).click(function() {
   			slidePrecedente();
		});
		

		//Création de bulletpoints
		var content_bullets="<div class='bulletpoints'>";
		
		for(var iter = 0; iter < compteur_slides; iter++) {
		  content_bullets+= "<img src='img/bullet.png' class='bullet'>";
		}

		content_bullets+="</div>";
		$('body').append(content_bullets);

		$.each($(".bullet") , function (k){
			$( this ).click(function() {
			   	slide_actuelle=k+1;
			   	moveSlide();
			});
		});

		//Gestion de la taille de la fenêtre
		miseEnPlace();
		$( window ).resize(function() {
		   miseEnPlace();
		});

	}



	function miseEnPlace(){
		//on récupère à nouveau al alrgeur de la fenêtre
		largeur_slide = $(window).width();
		//on détermine la nouvelle taille du conteneur de slides...
		$(".content-panel").css('width' , compteur_slides*largeur_slide );
		//...et la taille de chaque slide
		$(".panel").css('width' , $(window).width());
		$(".panel").css('height' , '100vh');
		// Si la slide est plus large que haute
		if($(".panel").height()<$(".panel").width()){
			$(".panel img").css('width' , '110%');
			$(".panel img").css('height' , 'auto');
			//Mais que le contenu ne prend pas toute la hauteur...
			if($(".panel img").height()<$(".panel").height()){
				$(".panel img").css('height' , '110%');
				$(".panel img").css('width' , 'auto');
			}
		}
		$.each($(".panel img") , function (i){
			$(this).css('left' , '0');
			$(this).css('margin-left' , -($(this).width()-$(".panel").width())/2);
		});
		//on repositionne le contenu en fonction du numero de slide et de sa nouvelle largeur
		$( ".content-panel" ).css('margin-left',-((slide_actuelle-1)*largeur_slide));

	}

	function moveSlide(){
		$( ".content-panel" ).animate({
			marginLeft: -((slide_actuelle-1)*largeur_slide),
		},"slow");
	}

	function slideSuivante(){
		if(slide_actuelle<compteur_slides){
			slide_actuelle++;
   		}else{
   			slide_actuelle=1;
   		}
   		console.log(slide_actuelle);
   		moveSlide();
	}

	function slidePrecedente(){
		if(slide_actuelle>1){
   			slide_actuelle--;
   		}else{
   			slide_actuelle=compteur_slides;
   		}
   		console.log(slide_actuelle);
   		moveSlide();
	}

	

	






