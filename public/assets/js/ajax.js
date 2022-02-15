// Script Qte shop Jquery
$(document).ready(function() { 
	$(".shopAdd").on('click', function(){ 
		let btnId=$(this).attr('id'); 
		let id=btnId.split("-");
		let btnType=id[1];
		id=id[2];
		let newQty=parseInt($("#input-"+id).val());
		let Stock=parseInt($("#stock-"+id).val());

		if (newQty<Stock || btnType=="minus") {
			newQty=parseInt($("#input-"+id).val())+parseInt($("#"+btnId).val()); 
			if (newQty<=0) {
				$("#input-"+id).val(0);
			}else{
				$("#input-"+id).val(newQty);
			}
		}else{
			alert("Vous avez atteint la quantité maximale disponible pour ce produit.")
		}
	});
});

// Script submit shop Jquery
$(document).ready(function() { 
	$(".shopSubmit").on('click', function(){ 
		let btnId=$(this).attr('id'); 
		let id=btnId.split("-"); 
		id=id[2];
		let newQty=parseInt($("#input-"+id).val());
		if (newQty<=0) {

		}else{
			alert("Le produit a bien été ajouté au panier !");
			$.post("../controller/traitement_cart.php", { 'product_id': id, 'qte': newQty }, function(data) {
	            $("#cart").html(data);
	        });
	    }
	});
});

// Script delete product cart Jquery
$(document).ready(function() { 
	$(".cartDelete").on('click', function(){ 
		let btnId=$(this).attr('id'); 
		let id=btnId.split("-"); 
		id=id[1];
		let productDelete=parseInt($("#delete-"+id).val(0)); 
		$("#delete-"+id).val(0);

		if ( confirm("Etes-vous sûr(e) de vouloir supprimer ce produit ?")) {
			$.post("../controller/traitement_cart_delete.php", { 'product_id': id, 'qte': productDelete }, function(data) {
	            $("#cart").html(data);
	        });
	    }else{
	    	document.location.href="../vue/cart_page.php";
	    }
	});
});

// Onchange sur le option des quantités panier
function changeQte(newValue, oldValue, product_id, cart_num) { 
	$.post("../controller/traitement_cart_qte.php", { 'product_id': product_id, 'newQte': newValue, 'oldQte': oldValue, 'cart_num': cart_num }, function(data) {
        console.log(data);
        $("#cart").html(data);
    });
};


// Script filter category shop Jquery
$(document).ready(function(){
    $(".shopFilter").on('change', function(){ 
        let value=$(this).val();

        // Envoi la valeur du filtre au fichier de traitement
        $.post("../controller/traitement_shopFilter.php", { 'value': value }, function(data) {
            $("#shop").html(data);
        });
    });
});


// Script delete dashboard Jquery
$(document).ready(function() { // = avec ready(function()) le code js s'exécute une fois que l'intégralité de la page est chargée
	$(".dashboardDelete").on('click', function(){ // on cible tous les éléments qui ont la classe "cartAdd"; "on" (=addEventListener) affecte un type d'événement qui est le 'click' et qui applique la fonction suivante :
		let btnId=$(this).attr('id'); // $(this) permet de cibler l'événement sur lequel on a cliqué. 'attr' permet de cibler l'attribut 'id' de l'élément sur lequel on a cliqué.
		let id=btnId.split("-"); // split permet de faire un tableau pour chaque valeur entre chaque tiret -
		let picture=id[2];
		id=id[1];

		if ( confirm("Etes-vous sûr(e) de vouloir supprimer ce produit ?")) {
			// $.post remplace la variable $_POST ; le 1er paramètre "cart.php" est considéré comme le traitement du formulaire ; le 2ème paramètre est les données que l'on envoit à ce formulaire ; 3ème paramètre, ce qu'il faut faire une fois qu'on a reçu le retour du traitement de "cart.php".
			$.post("../controller/traitement_dashboard_delete.php", { 'id': id, 'picture': picture }, function(data) {
	            $("#dashboard").html(data);
	        });
	    }else{
	    	document.location.href="http://ecommerce/vue/media.php";
	    }
	});
});

// Script delete dashboard Jquery
$(document).ready(function() { // = avec ready(function()) le code js s'exécute une fois que l'intégralité de la page est chargée
	$(".dashboardEdit").on('click', function(){ // on cible tous les éléments qui ont la classe "cartAdd"; "on" (=addEventListener) affecte un type d'événement qui est le 'click' et qui applique la fonction suivante :
		let btnId=$(this).attr('id'); // $(this) permet de cibler l'événement sur lequel on a cliqué. 'attr' permet de cibler l'attribut 'id' de l'élément sur lequel on a cliqué.
		let id=btnId.split("-"); // split permet de faire un tableau pour chaque valeur entre chaque tiret -
		let name=id[2];
		let description=id[3];
		let price=id[4];
		id=id[1];

		if ( confirm("Etes-vous sûr(e) de vouloir éditer ce produit ?")) {
			// $.post remplace la variable $_POST ; le 1er paramètre "cart.php" est considéré comme le traitement du formulaire ; le 2ème paramètre est les données que l'on envoit à ce formulaire ; 3ème paramètre, ce qu'il faut faire une fois qu'on a reçu le retour du traitement de "cart.php".
			$.post("../controller/traitement_dashboard_edit.php", { 'productId': id, 'productName': name, 'productDescription': description, 'productPrice': price }, function(data) {
	            $("#dashboard").html(data);
	        });
	    }else{
	    	document.location.href="http://ecommerce/vue/media.php";
	    }
	});
});