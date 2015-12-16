<?php

/* GestionFraisBundle:Utilisateur:renseignerFiche.html.twig */
class __TwigTemplate_30495a4cf14befa611579a03f71950c3184f33fdc28f024f96297e6a14bfaed8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "GestionFraisBundle:Utilisateur:renseignerFiche.html.twig", 1);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_bdbfe07d6b003fdd45cb45331ff51634606bf17c9f780acaa9fc7156c45c6e30 = $this->env->getExtension("native_profiler");
        $__internal_bdbfe07d6b003fdd45cb45331ff51634606bf17c9f780acaa9fc7156c45c6e30->enter($__internal_bdbfe07d6b003fdd45cb45331ff51634606bf17c9f780acaa9fc7156c45c6e30_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "GestionFraisBundle:Utilisateur:renseignerFiche.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_bdbfe07d6b003fdd45cb45331ff51634606bf17c9f780acaa9fc7156c45c6e30->leave($__internal_bdbfe07d6b003fdd45cb45331ff51634606bf17c9f780acaa9fc7156c45c6e30_prof);

    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_137738f9093f201b6028133b1df28e1e7fb5825dda67b5bef643805508992262 = $this->env->getExtension("native_profiler");
        $__internal_137738f9093f201b6028133b1df28e1e7fb5825dda67b5bef643805508992262->enter($__internal_137738f9093f201b6028133b1df28e1e7fb5825dda67b5bef643805508992262_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("Css/form.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" xmlns=\"http://www.w3.org/1999/html\">";
        
        $__internal_137738f9093f201b6028133b1df28e1e7fb5825dda67b5bef643805508992262->leave($__internal_137738f9093f201b6028133b1df28e1e7fb5825dda67b5bef643805508992262_prof);

    }

    // line 6
    public function block_body($context, array $blocks = array())
    {
        $__internal_0394e055a877ee340fe57b24386ac88d6951bb3e07dae14155492218c63d3aa9 = $this->env->getExtension("native_profiler");
        $__internal_0394e055a877ee340fe57b24386ac88d6951bb3e07dae14155492218c63d3aa9->enter($__internal_0394e055a877ee340fe57b24386ac88d6951bb3e07dae14155492218c63d3aa9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 7
        echo "
    <div class=\"container\">
        <div class=\"col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 \" id=\"contenu\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-sm-3 col-xs-6\">
                        <p>";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["visiteur"]) ? $context["visiteur"] : $this->getContext($context, "visiteur")), "nom", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["visiteur"]) ? $context["visiteur"] : $this->getContext($context, "visiteur")), "prenom", array()), "html", null, true);
        echo "</p>
                    </div>
                    <div class=\"col-sm-3 col-xs-6\">
                        <p> Mois : ";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ficheFrais"]) ? $context["ficheFrais"] : $this->getContext($context, "ficheFrais")), "mois", array()), "html", null, true);
        echo "</p>
                    </div>

                    <div class=\"col-sm-6 col-xs-12\">
                        <p>Date modification : ";
        // line 20
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["ficheFrais"]) ? $context["ficheFrais"] : $this->getContext($context, "ficheFrais")), "dateModif", array()), "d/m/Y"), "html", null, true);
        echo "</p>
                    </div>
                </div>


                <div class=\"row\">
                    <div class=\"col-sm-3 col-xs-12\">
                        ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["etatFicheFrais"]) ? $context["etatFicheFrais"] : $this->getContext($context, "etatFicheFrais")));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 28
            echo "                            <p> Etat : ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "libelle", array()), "html", null, true);
            echo "</p>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "                    </div>
                </div>

                <form>
                    <div class=\"row\">
                        <h3>Frais Forfait</h3>
                        <table class=\"table table-bordered\">
                            <thead>
                            <tr>
                                <th><p>Libelle</p></th>
                                <th><p>Quantité</p></th>
                            </tr>
                            </thead>
                            <tbody>
                            ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tabLigneFraisForfait"]) ? $context["tabLigneFraisForfait"] : $this->getContext($context, "tabLigneFraisForfait")));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 45
            echo "                                <tr>

                                    <td><p>";
            // line 47
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "</p></td>
                                    <td>
                                        <input type=\"number\" value=\"";
            // line 49
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "quantite", array()), "html", null, true);
            echo "\" id=\"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "Montant\" class=\"form-control\">
                                    </td>

                                </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "
                            </tbody>
                        </table>
                    </div>



                    <div class=\"row\" id =\"fraisHorsForfait\">
                        <h3>Frais Hors Forfait</h3>
                        ";
        // line 63
        $context["nbFraisHorsForfait"] = 0;
        // line 64
        echo "
                        ";
        // line 65
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ligneFraisHorsForfait"]) ? $context["ligneFraisHorsForfait"] : $this->getContext($context, "ligneFraisHorsForfait")));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 66
            echo "                            ";
            $context["nbFraisHorsForfait"] = ((isset($context["nbFraisHorsForfait"]) ? $context["nbFraisHorsForfait"] : $this->getContext($context, "nbFraisHorsForfait")) + 1);
            // line 67
            echo "                            <table class=\"table table-bordered\" id=\"fraisHorsForfait";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "\">
                                <thead>
                                <tr>
                                    <th><p>Date</p></th>
                                    <th><p>Montant</p></th>
                                </tr>

                                </thead>
                                <tbody>
                                    <td>
                                        <input type=\"date\" value=\"12/11/2015\" id =\"";
            // line 77
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "Date\" class=\"form-control\">
                                    </td>
                                    <td>
                                        <input type=\"number\" value=\"";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "montant", array()), "html", null, true);
            echo "\" id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "Montant \" class=\"form-control\">
                                    </td>

                                    <table class=\"table table-bordered\">
                                        <thead>
                                        <tr>
                                            <th><p>Libelle</p></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <tr>

                                               <td>
                                                    <textarea type=\"textarea\" value=\"";
            // line 94
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "libelleLigneHorsForfait", array()), "html", null, true);
            echo "\" id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "Libelle\" class=\"form-control\"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </tbody>
                            </table>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 102
        echo "                        <button type=\"button\" id=\"btn-ajouter";
        echo twig_escape_filter($this->env, (isset($context["nbFraisHorsForfait"]) ? $context["nbFraisHorsForfait"] : $this->getContext($context, "nbFraisHorsForfait")), "html", null, true);
        echo "\"  onclick=\"ajoutFrais(";
        echo twig_escape_filter($this->env, (isset($context["nbFraisHorsForfait"]) ? $context["nbFraisHorsForfait"] : $this->getContext($context, "nbFraisHorsForfait")), "html", null, true);
        echo ");\" class=\"btn btn-default\" >Ajouter Frais Hors Forfait</button>
                    </div>

                    <div class=\"bandeau col-xs-12\"></div>

                    <div class=\"row\">
                        <div class=\"col-xs-2 col-xs-offset-5\">
                            <a class=\"btn btn-default \">Enregistrer</a>
                        </div>
                    </div>
                    <div class=\"bandeau-small\"></div>
                </form>
            </div>
        </div>
    </div>


     <script language=\"javascript\">
        function ajoutFrais( num)
        {
            //ajoute Un frais hors forfait a la div fraishorsForfait

            //masque le bouton en cours
            document.getElementById(\"btn-ajouter\"+num).setAttribute(\"hidden\",\"true\");
            num++;\t\t\t//incr�mente le num�ro de frais

            var lesFrais=document.getElementById(\"fraisHorsForfait\");\t//récupère l'objet DOM qui contient les données

            var unFrais =
                    '<table class=\"table table-bordered\"> ' +
                    '<thead> ' +
                    '<tr> ' +
                    '<th><p>Date</p></th> ' +
                    '<th><p>Montant</p></th> ' +
                    '</tr> ' +
                    '</thead> ' +
                    '<tbody> ' +
                    '<td> ' +
                    '<input type=\"date\"  id =\"'+num+'Date\" class=\"form-control\"> ' +
                    '</td> ' +
                    '<td> ' +
                    '<input type=\"number\" value=\"0\" id=\"'+num+'Montant \" class=\"form-control\"> ' +
                    '</td> ' +
                    '<table class=\"table table-bordered\"> ' +
                    '<thead> ' +
                    '<tr> ' +
                    '<th><p>Libelle</p></th> ' +
                    '</tr> ' +
                    '</thead> ' +
                    '<tbody> ' +
                    '<tr> ' +
                    '<td> ' +
                    '<textarea type=\"textarea\" id=\"'+num+'Libelle\" class=\"form-control\"></textarea> ' +
                    '</td> ' +
                    '</tr> ' +
                    '</tbody> ' +
                    '</table> ' +
                    '</tbody>' +
                    '<buton class=\"btn btn-default\" id=\"btn-ajouter'+num+'\" onclick=\"ajoutFrais('+num+');\">Ajouter Frais Hors Forfait</buton>';

            lesFrais.innerHTML += unFrais ;\t\t\t\t\t\t//l'ajoute � la DIV



        }
    </script>

";
        
        $__internal_0394e055a877ee340fe57b24386ac88d6951bb3e07dae14155492218c63d3aa9->leave($__internal_0394e055a877ee340fe57b24386ac88d6951bb3e07dae14155492218c63d3aa9_prof);

    }

    // line 170
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_a901574639c81904ad38b4dcabdb0f33b978d936d38f7749d3e1cff78d77e395 = $this->env->getExtension("native_profiler");
        $__internal_a901574639c81904ad38b4dcabdb0f33b978d936d38f7749d3e1cff78d77e395->enter($__internal_a901574639c81904ad38b4dcabdb0f33b978d936d38f7749d3e1cff78d77e395_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 171
        echo "


";
        
        $__internal_a901574639c81904ad38b4dcabdb0f33b978d936d38f7749d3e1cff78d77e395->leave($__internal_a901574639c81904ad38b4dcabdb0f33b978d936d38f7749d3e1cff78d77e395_prof);

    }

    public function getTemplateName()
    {
        return "GestionFraisBundle:Utilisateur:renseignerFiche.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  307 => 171,  301 => 170,  223 => 102,  207 => 94,  188 => 80,  182 => 77,  168 => 67,  165 => 66,  161 => 65,  158 => 64,  156 => 63,  145 => 54,  132 => 49,  127 => 47,  123 => 45,  119 => 44,  103 => 30,  94 => 28,  90 => 27,  80 => 20,  73 => 16,  65 => 13,  57 => 7,  51 => 6,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* */
/* {% block stylesheets %}*/
/*     <link href="{{ asset('Css/form.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">{% endblock %}*/
/* */
/* {%  block body %}*/
/* */
/*     <div class="container">*/
/*         <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 " id="contenu">*/
/*             <div class="container">*/
/*                 <div class="row">*/
/*                     <div class="col-sm-3 col-xs-6">*/
/*                         <p>{{ visiteur.nom }} {{ visiteur.prenom }}</p>*/
/*                     </div>*/
/*                     <div class="col-sm-3 col-xs-6">*/
/*                         <p> Mois : {{ ficheFrais.mois }}</p>*/
/*                     </div>*/
/* */
/*                     <div class="col-sm-6 col-xs-12">*/
/*                         <p>Date modification : {{ ficheFrais.dateModif|date("d/m/Y")  }}</p>*/
/*                     </div>*/
/*                 </div>*/
/* */
/* */
/*                 <div class="row">*/
/*                     <div class="col-sm-3 col-xs-12">*/
/*                         {% for item in etatFicheFrais %}*/
/*                             <p> Etat : {{ item.libelle }}</p>*/
/*                         {% endfor %}*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <form>*/
/*                     <div class="row">*/
/*                         <h3>Frais Forfait</h3>*/
/*                         <table class="table table-bordered">*/
/*                             <thead>*/
/*                             <tr>*/
/*                                 <th><p>Libelle</p></th>*/
/*                                 <th><p>Quantité</p></th>*/
/*                             </tr>*/
/*                             </thead>*/
/*                             <tbody>*/
/*                             {% for key, item in tabLigneFraisForfait %}*/
/*                                 <tr>*/
/* */
/*                                     <td><p>{{ key }}</p></td>*/
/*                                     <td>*/
/*                                         <input type="number" value="{{ item.quantite }}" id="{{ key }}Montant" class="form-control">*/
/*                                     </td>*/
/* */
/*                                 </tr>*/
/*                             {% endfor %}*/
/* */
/*                             </tbody>*/
/*                         </table>*/
/*                     </div>*/
/* */
/* */
/* */
/*                     <div class="row" id ="fraisHorsForfait">*/
/*                         <h3>Frais Hors Forfait</h3>*/
/*                         {%  set nbFraisHorsForfait = 0%}*/
/* */
/*                         {% for key, item in ligneFraisHorsForfait %}*/
/*                             {% set nbFraisHorsForfait =  nbFraisHorsForfait + 1  %}*/
/*                             <table class="table table-bordered" id="fraisHorsForfait{{ item.num }}">*/
/*                                 <thead>*/
/*                                 <tr>*/
/*                                     <th><p>Date</p></th>*/
/*                                     <th><p>Montant</p></th>*/
/*                                 </tr>*/
/* */
/*                                 </thead>*/
/*                                 <tbody>*/
/*                                     <td>*/
/*                                         <input type="date" value="12/11/2015" id ="{{ item.num }}Date" class="form-control">*/
/*                                     </td>*/
/*                                     <td>*/
/*                                         <input type="number" value="{{ item.montant }}" id="{{ item.num }}Montant " class="form-control">*/
/*                                     </td>*/
/* */
/*                                     <table class="table table-bordered">*/
/*                                         <thead>*/
/*                                         <tr>*/
/*                                             <th><p>Libelle</p></th>*/
/*                                         </tr>*/
/*                                         </thead>*/
/* */
/*                                         <tbody>*/
/*                                             <tr>*/
/* */
/*                                                <td>*/
/*                                                     <textarea type="textarea" value="{{ item.libelleLigneHorsForfait }}" id="{{ item.num }}Libelle" class="form-control"></textarea>*/
/*                                                 </td>*/
/*                                             </tr>*/
/*                                         </tbody>*/
/*                                     </table>*/
/*                                 </tbody>*/
/*                             </table>*/
/*                         {% endfor %}*/
/*                         <button type="button" id="btn-ajouter{{ nbFraisHorsForfait }}"  onclick="ajoutFrais({{ nbFraisHorsForfait }});" class="btn btn-default" >Ajouter Frais Hors Forfait</button>*/
/*                     </div>*/
/* */
/*                     <div class="bandeau col-xs-12"></div>*/
/* */
/*                     <div class="row">*/
/*                         <div class="col-xs-2 col-xs-offset-5">*/
/*                             <a class="btn btn-default ">Enregistrer</a>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="bandeau-small"></div>*/
/*                 </form>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* */
/* */
/*      <script language="javascript">*/
/*         function ajoutFrais( num)*/
/*         {*/
/*             //ajoute Un frais hors forfait a la div fraishorsForfait*/
/* */
/*             //masque le bouton en cours*/
/*             document.getElementById("btn-ajouter"+num).setAttribute("hidden","true");*/
/*             num++;			//incr�mente le num�ro de frais*/
/* */
/*             var lesFrais=document.getElementById("fraisHorsForfait");	//récupère l'objet DOM qui contient les données*/
/* */
/*             var unFrais =*/
/*                     '<table class="table table-bordered"> ' +*/
/*                     '<thead> ' +*/
/*                     '<tr> ' +*/
/*                     '<th><p>Date</p></th> ' +*/
/*                     '<th><p>Montant</p></th> ' +*/
/*                     '</tr> ' +*/
/*                     '</thead> ' +*/
/*                     '<tbody> ' +*/
/*                     '<td> ' +*/
/*                     '<input type="date"  id ="'+num+'Date" class="form-control"> ' +*/
/*                     '</td> ' +*/
/*                     '<td> ' +*/
/*                     '<input type="number" value="0" id="'+num+'Montant " class="form-control"> ' +*/
/*                     '</td> ' +*/
/*                     '<table class="table table-bordered"> ' +*/
/*                     '<thead> ' +*/
/*                     '<tr> ' +*/
/*                     '<th><p>Libelle</p></th> ' +*/
/*                     '</tr> ' +*/
/*                     '</thead> ' +*/
/*                     '<tbody> ' +*/
/*                     '<tr> ' +*/
/*                     '<td> ' +*/
/*                     '<textarea type="textarea" id="'+num+'Libelle" class="form-control"></textarea> ' +*/
/*                     '</td> ' +*/
/*                     '</tr> ' +*/
/*                     '</tbody> ' +*/
/*                     '</table> ' +*/
/*                     '</tbody>' +*/
/*                     '<buton class="btn btn-default" id="btn-ajouter'+num+'" onclick="ajoutFrais('+num+');">Ajouter Frais Hors Forfait</buton>';*/
/* */
/*             lesFrais.innerHTML += unFrais ;						//l'ajoute � la DIV*/
/* */
/* */
/* */
/*         }*/
/*     </script>*/
/* */
/* {% endblock  %}*/
/* {% block javascripts %}*/
/* */
/* */
/* */
/* {% endblock %}*/
/* */
