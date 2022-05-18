$('#addEmployeeForm').validate({
    rules: {
        nom: {
            required: true,
        },
        cin: {
            required: true,
            number:true,
            minlength : 8,
            maxlength: 8,
        },
        email: {
            required: true,
            email: true,
        },
        tel: {
            required: true,
            number:true,
            minlength : 8,
            maxlength: 8,
        },
        adresse: {
            required: true,
        },
        password: {
            minlength: 6,
        },
        salaire: {
            required: true,
        },
        image: {
            required: true,
        }
    },
    messages: {
        nom: {
            required: "Champs obligatoire !",
        },
        cin: {
            required: "Champs obligatoire !",
            number : "Le numéro de cin n'accepte pas des lettres",
            minlength: 'Le numéro de cin composé de 8 chiffres',
            maxlength: 'Le numéro de cin composé de 8 chiffres',
        },
        email: {
            required: "Champs obligatoire !",
            email:"S'il vous plaît, mettez une adresse email valide.",
        },
        tel: {
            required: "Champs obligatoire !",
            number : "Le numéro de téléphone n'accepte pas des lettres",
            minlength : 'Le numéro de téléphone composé de 8 chiffres',
            maxlength: 'Le numéro de téléphone composé de 8 chiffres',
        },
        address: {
            required: "Champs obligatoire !",
        },
        password: { 
            minlength:"Mot de passe tros faible (minimum 6 chiffres)",
        },
        salaire: {
            required: "Champs obligatoire !",
        },
        image: {
            required: "Champs obligatoire !",
        }
    }
});

//Fournisseur form
$('#example-form').validate({
    rules: {
        matricule: {
            required: true,
        },
        ville: {
            required: true,
        },
        adresse: {
            required: true,
        },
        region: {
            required: true,
        },
        postal: {
            required: true,
            number:true,
            maxlength:4,
            minlength:4,
        },
        photo: {
            required: true,
        },
        name: {
            required: true,
        },
        email: {
            required: true,
            email:true,
        },
        tel: {
            required: true,
            number:true,
            minlength : 8,
            maxlength: 8,
        },
        password: {
            required: true,
        },
        cin: {
            required: true,
            number:true,
            minlength : 8,
            maxlength: 8,
        }
    },
    messages: {
        matricule: {
            required: "Champ obligatoire !",
        },
        ville: {
            required: "Champ obligatoire !",
        },
        adresse: {
            required: "Champ obligatoire !",
        },
        region: {
            required: "Champ obligatoire !",
        },
        postal: {
            required: "Champ obligatoire !",
            number:"Le code postale n'accepte pas des lettres",
            maxlength:'Le code postale composé de 4 chiffres',
            minlength:'Le code postale composé de 4 chiffres',
        },
        photo: {
            required: "Champ obligatoire !",
        },
        name: {
            required: "Champ obligatoire !",
        },
        email: {
            required: "Champ obligatoire !",
            email:"S'il vous plaît, mettez une adresse email valide.",
        },
        tel: {
            required: "Champ obligatoire !",
            number : "Le numéro de téléphone n'accepte pas des lettres",
            minlength: 'Le numéro de téléphone composé de 8 chiffres',
            maxlength: 'Le numéro de téléphone composé de 8 chiffres',
        },
        password: {
            required: "Champ obligatoire !",
        },
        cin: {
            required: "Champ obligatoire !",
            number : "Le numéro de cin n'accepte pas des lettres",
            minlength: 'Le numéro de cin composé de 8 chiffres',
            maxlength: 'Le numéro de cin composé de 8 chiffres',
        }
    }
});


$('#addCatégorieForm').validate({
    rules: {
        nom: {
            required: true,
        },
        parent_id: {
            required: true,
        },
        description: {
            required: true,
        }
    },
    messages: {
        nom: {
            required: "Champ obligatoire !",
        },
        parent_id: {
            required: "Champ obligatoire !",
        },
        description: {
            required: "Champ obligatoire !",
        }
    }
});

$('#addProductForm').validate({
    rules: {
        nom: {
            required: true,
        },
        code: {
            required: true,
        },
        prix: {
            required: true,
        },
        prix_gros: {
            required: true,
        },
        total_stock: {
            required: true,
        },
        description: {
            required: true,
        },
        image: {
            required: true,
        }
    },
    messages: {
        nom: {
            required: "Champ obligatoire !",
        },
        code: {
            required:"Champ obligatoire !",
        },
        prix: {
            required: "Champ obligatoire !",
        },
        prix_gros: {
            required:"Champ obligatoire !",
        },
        total_stock: {
            required:"Champ obligatoire !",
        },
        description: {
            required:"Champ obligatoire !",
        },
        image: {
            required:"Champ obligatoire !",
        }
    }
});


$('#addCouponForm').validate({
    rules: {
        coupon_code: {
            required: true,
        },
        montant: {
            required: true,
        },
        type: {
            required: true,
        },
        date: {
            required: true,
        },
        status: {
            required: true,
        }
    },
    messages: {
        coupon_code: {
            required: "Champ obligatoire !",
        },
        montant: {
            required: "Champ obligatoire !",
        },
        type: {
            required: "Champ obligatoire !",
        },
        date: {
            required: "Champ obligatoire !",
        },
        status: {
            required: "Champ obligatoire !",
        }
    }
});

//Ajouter commande manuel form
$('#addCommandForm').validate({
    rules: {
        nom: {
            required: true,
        },
        tel: {
            required: true,
            number:true,
            minlength:8,
            maxlength:8,
        },
        region: {
            required: true,
        },
        ville: {
            required: true,
        },
        adresse: {
            required: true,
        },
        postal: {
            required: true,
            number:true,
            minlength:4,
            maxlength:4,
        },
        remise: {
            required: {
                depends: function(element) {
                    return $("#remise").val() == "0";
                }
            }
        },

    },
    messages: {
        nom: {
            required: "Champ obligatoire !",
        },
        tel: {
            required: "Champ obligatoire !",
            number:"Le numéro de téléphone n'accepte pas des lettres",
            minlength:"Le numéro de téléphone composé de 8 chiffres",
            maxlength:"Le numéro de téléphone composé de 8 chiffres",
        },
        region: {
            required: "Champ obligatoire !",
        },
        ville: {
            required: "Champ obligatoire !",
        },
        adresse: {
            required: "Champ obligatoire !",
        },
        postal: {
            required: "Champ obligatoire !",
            number:"Le code postale n'accepte pas des lettres",
            minlength:"Le code postale composé de 4 chiffres",
            maxlength:"Le code postale composé de 4 chiffres",
        },
        remise: {
            required:"Champ obligatoire !",
        }
    }
});

//Ajoouter devis manuel form
$('#addDevisForm').validate({
    rules: {
        nom: {
            required: true,
        },
        tel: {
            required: true,
            number:true,
            minlength:8,
            maxlength:8,
        },
        region: {
            required: true,
        },
        ville: {
            required: true,
        },
        adresse: {
            required: true,
        },
        postal: {
            required: true,
            number:true,
            minlength:4,
            maxlength:4,
        },
        date: {
            required:true,
        },
        tva: {
            number:true,
        }

    },
    messages: {
        nom: {
            required: "Champ obligatoire !",
        },
        tel: {
            required: "Champ obligatoire !",
            number:"Le numéro de téléphone n'accepte pas des lettres",
            minlength:"Le numéro de téléphone composé de 8 chiffres",
            maxlength:"Le numéro de téléphone composé de 8 chiffres",
        },
        region: {
            required: "Champ obligatoire !",
        },
        ville: {
            required: "Champ obligatoire !",
        },
        adresse: {
            required: "Champ obligatoire !",
        },
        postal: {
            required: "Champ obligatoire !",
            number:"Le code postale n'accepte pas des lettres",
            minlength:"Le code postale composé de 4 chiffres",
            maxlength:"Le code postale composé de 4 chiffres",
        },
        date: {
            required:"Champ obligatoire !",
        },
        tva: {
            number:"Le champ n'accepte pas des lettres",
        }
    }
});


//Ajouter facture manuel form
$('#addFactureForm').validate({
    rules: {
        nom: {
            required: true,
        },
        tel: {
            required: true,
            number:true,
            minlength:8,
            maxlength:8,
        },
        region: {
            required: true,
        },
        ville: {
            required: true,
        },
        adresse: {
            required: true,
        },
        postal: {
            required: true,
            number:true,
            minlength:4,
            maxlength:4,
        },
        date: {
            required:true,
        },
        tva: {
            number:true,
        },
        Fixe: {
            number:true,
        },
        Pourcentage:{
            number:true,
        },

    },
    messages: {
        nom: {
            required: "Champ obligatoire !",
        },
        tel: {
            required: "Champ obligatoire !",
            number:"Le numéro de téléphone n'accepte pas des lettres",
            minlength:"Le numéro de téléphone composé de 8 chiffres",
            maxlength:"Le numéro de téléphone composé de 8 chiffres",
        },
        region: {
            required: "Champ obligatoire !",
        },
        ville: {
            required: "Champ obligatoire !",
        },
        adresse: {
            required: "Champ obligatoire !",
        },
        postal: {
            required: "Champ obligatoire !",
            number:"Le code postale n'accepte pas des lettres",
            minlength:"Le code postale composé de 4 chiffres",
            maxlength:"Le code postale composé de 4 chiffres",
        },
        date: {
            required:"Champ obligatoire !",
        },
        tva: {
            number:"Le champ n'accepte pas des lettres",
        },
        Fixe: {
            number:"Le champ n'accepte pas des lettres",
        },
        Pourcentage:{
            number:"Le champ n'accepte pas des lettres",
        },
    }
});



//Ajout articleform
$('#addArticleForm').validate({
    rules: {
        title: { required: true, },
        image: { required: true, },
    },
    messages: {
        title: { required: "Champ obligatoire !", },
        image: { required: "Champ obligatoire !", },
    }
});
$('#editArticleForm').validate({
    rules: {
        title: { required: true, },
    },
    messages: {
        title: { required: "Champ obligatoire !", },
    }
});