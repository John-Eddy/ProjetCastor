/**
 * Created by Eddy on 16/12/2015.
 */




function verifFiche(form)
{
    //var formulaire = document.forms['ficheFrais'].element;

    //var lesElements = form.getElementsByTagName("*");
    var unElement, type,champValide,formulaireValide;
    //on parcour les élément du formulaire
    for(var i = 0; i<form.length ; i++)
    {
        unElement=form[i];
        type = unElement.type;

        if(type == "number")
        {
            valide=verifChampNumerique(unElement);
        }
        if(type == "text")
        {
            valide=verifChampDate(unElement);
        }
        if(type == "textarea")
        {
            valide=verifChampText(unElement);
        }
        if (valide==false)
        {
            formulaireValide=false;
        }
    }
    return formulaireValide;


}


/*
    Fonction qui vérifie si un champ numérique est bien remplit et positif

 */
function verifChampNumerique(champ)
{
    if(champ.value >=0 && champ.value !=0)
    {
        surligne(champ, false);
        return true;
    }
    else {
        surligne(champ, true);
        return false;
    }

}
function verifChampText(champ) {
    if (champ.value.length > 0) {

        surligne(champ, false);
        return true;
    }
    else {
        surligne(champ, true);
        return false;
    }
}

function verifChampDate(champ)
{
    var format = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;

    var dateVAlide = format.test(champ.value);

    if(dateVAlide)
    {
        surligne(champ, false);

        return true;
    }
    else {
        surligne(champ, true);
        return false;
    }
}

function surligne(champ, erreur)
{
    if(erreur) {
        champ.style.backgroundColor = "#fba";
    }
    else {
        champ.style.backgroundColor = "";
    }
}
