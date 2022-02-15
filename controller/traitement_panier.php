
Si le panier existe {
	// interroger la bdd
	Si le produit est déjà dans le panier {
		// UPDATE sur la quantite_com
	}Sinon {
		// Ajouter le produit dans le panier, c’est à dire dans la table ligne_com
	}
	// Mettre à jour le montant du panier
}Sinon {
	Si le user s’est identifié {
		// Créer le panier dans la table panier avec l’id_user
	}Sinon {
		// Créer le panier dans la table panier sans l’id_user
	}
}
// Enregistrer en session l’id_panier du panier qui vient d’être créé, utiliser une fonction de l’objet PDO pour récupérer l’id du dernier INSERT
// Ajouter le produit dans le panier, c’est-à-dire dans la table ligne_com
