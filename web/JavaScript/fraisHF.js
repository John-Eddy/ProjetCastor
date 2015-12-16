/**
 * Created by Eddy on 16/12/2015.
 */
function ajoutFrais( num){//ajoute une ligne de produits/qt� � la div "lignes"


    var bouton = document.getElementById("btn-ajouter"+num);//recupère le bouton
    num++;//incrément le numeros de frais
    bouton.setAttribute('id', 'btn-ajouter'+num);//Atribut un nouvelle id au bouton
    bouton.setAttribute('onclick', 'ajoutFrais('+num+');');

    var lesFrais=document.getElementById("fraisHorsForfait");	//récupère la dic contenant tout les frais

    var unFrais =
        '<div id= "fraisHorsForfait' +num+ '" > ' +
        '<table class="table table-bordered"> ' +
        '<h4>Frais hors forfait n° '+num+'</h4>' +
        '<thead> ' +
        '<tr> ' +
        '<th><p>Date (jj/mm/aaa)</p></th> ' +
        '<th><p>Montant</p></th> ' +
        '</tr> ' +
        '</thead> ' +
        '<tbody> ' +
        '<td> ' +
        '<input type="date"  id ="'+num+'Date" class="form-control" onblur="verifChampDate(this)"> ' +
        '</td> ' +
        '<td> ' +
        '<input type="number" value="0" id="'+num+'Montant " class="form-control" onblur="verifChampNumerique(this)"> ' +
        '</td> ' +
        '<table class="table table-bordered" id="libelleHF"> ' +
        '<thead> ' +
        '<tr> ' +
        '<th><p>Libelle</p></th> ' +
        '</tr> ' +
        '</thead> ' +
        '<tbody> ' +
        '<tr> ' +
        '<td> ' +
        '<textarea type="textarea" id="'+num+'Libelle" class="form-control" onblur="verifChampText(this)"></textarea>" ' +
        '</td> ' +
        '</tr> ' +
        '</tbody> ' +
        '</table> ' +
        '</tbody>' +
        '</table>'+
        '<buton class="btn btn-default btn-suprimerFraisHF col-xs-3 col-xs-offset-9" id="btn-suprimer'+num+'" onclick="suprimerFrais('+num+');">Suprimer</buton>'+
        '<div class="bandeau-small"></div>'

        ;

    lesFrais.innerHTML += (unFrais) ;						//l'ajoute le frais à la DIV lesFrais



}
/*
    Suprime le frais HF dont l'id est passer en parametre
 */
function suprimerFrais(num)
{
    // On demmande la confirmation a l'utilisateur
    if(    confirm('Etes-vous sûr de vouloir supprimer ce frais hors forfait ?'))
    {
        var frais = document.getElementById('fraisHorsForfait' + num);// On recupère le frais a suprimier
        frais.parentElement.removeChild(frais);    //on retire le frais de la liste

    }

}