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
        $__internal_4afd0c5b97559aec03e1b814039596031f70ed0f6ccbe70502e7d2775ddc31b0 = $this->env->getExtension("native_profiler");
        $__internal_4afd0c5b97559aec03e1b814039596031f70ed0f6ccbe70502e7d2775ddc31b0->enter($__internal_4afd0c5b97559aec03e1b814039596031f70ed0f6ccbe70502e7d2775ddc31b0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "GestionFraisBundle:Utilisateur:renseignerFiche.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4afd0c5b97559aec03e1b814039596031f70ed0f6ccbe70502e7d2775ddc31b0->leave($__internal_4afd0c5b97559aec03e1b814039596031f70ed0f6ccbe70502e7d2775ddc31b0_prof);

    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_b890a5b8fa2bea231584737fae2ab7679920b2968c9ff9be024c5bef75cc2027 = $this->env->getExtension("native_profiler");
        $__internal_b890a5b8fa2bea231584737fae2ab7679920b2968c9ff9be024c5bef75cc2027->enter($__internal_b890a5b8fa2bea231584737fae2ab7679920b2968c9ff9be024c5bef75cc2027_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("Css/form.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" xmlns=\"http://www.w3.org/1999/html\">";
        
        $__internal_b890a5b8fa2bea231584737fae2ab7679920b2968c9ff9be024c5bef75cc2027->leave($__internal_b890a5b8fa2bea231584737fae2ab7679920b2968c9ff9be024c5bef75cc2027_prof);

    }

    // line 6
    public function block_body($context, array $blocks = array())
    {
        $__internal_da31ac2bce3336dd4269a718eb6ded04f07258fb90aa3a836516f81860ec313b = $this->env->getExtension("native_profiler");
        $__internal_da31ac2bce3336dd4269a718eb6ded04f07258fb90aa3a836516f81860ec313b->enter($__internal_da31ac2bce3336dd4269a718eb6ded04f07258fb90aa3a836516f81860ec313b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

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

                <form name=\"ficheFrais\" method=\"post\" action=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("utilisateur_enregistrer", array("mois" => $this->getAttribute((isset($context["ficheFrais"]) ? $context["ficheFrais"] : $this->getContext($context, "ficheFrais")), "mois", array()))), "html", null, true);
        echo "\" onsubmit=\"return verifFiche(this)\"  onblur=\"verifChampNumerique(this)\">
                    <div class=\"row\" id =\"fraisForfait\">
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
            echo "\" name=\"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" min=\"0\" class=\"form-control \" onblur=\"verifChampNumerique(this)\" >
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

                    <div class=\"bandeau-small\"></div>


                    <div class=\"row\" id =\"fraisHorsForfait\">
                        <h3>Frais Hors Forfait</h3>
                        <div class=\"bandeau-small\"></div>
                        ";
        // line 65
        $context["nbFraisHorsForfait"] = 0;
        // line 66
        echo "
                        ";
        // line 67
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ligneFraisHorsForfait"]) ? $context["ligneFraisHorsForfait"] : $this->getContext($context, "ligneFraisHorsForfait")));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 68
            echo "                            ";
            $context["nbFraisHorsForfait"] = ((isset($context["nbFraisHorsForfait"]) ? $context["nbFraisHorsForfait"] : $this->getContext($context, "nbFraisHorsForfait")) + 1);
            // line 69
            echo "                            <div class=\"row\" id=\"fraisHorsForfait";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "\">
                                <table class=\"table table-bordered\" >
                                    <h4>Frais hors forfait n° ";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "</h4>
                                    <thead>
                                    <tr>
                                        <th><p>Date (jj/mm/aaa)</p></th>
                                        <th><p>Montant</p></th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                        <td>
                                            <input type=\"date\" value=\"";
            // line 81
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["item"], "date", array()), "d/m/Y"), "html", null, true);
            echo "\" name =\"date[";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "]\" class=\"form-control\" onblur=\"verifChampDate(this)\">
                                        </td>
                                        <td>
                                            <input type=\"number\" value=\"";
            // line 84
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "montant", array()), "html", null, true);
            echo "\" name=\"montant[";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "]\" class=\"form-control\" onblur=\"verifChampNumerique(this)\">
                                        </td>

                                        <table class=\"table table-bordered\" id=\"libelleHF\">
                                            <thead>
                                            <tr>
                                                <th><p>Libelle</p></th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                <tr>

                                                   <td>
                                                        <textarea type=\"textarea\"  name=\"libelle[";
            // line 98
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "]\" class=\"form-control\" onblur=\"verifChampText(this)\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "libelleLigneHorsForfait", array()), "html", null, true);
            echo "</textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </tbody>
                                </table>
                                <buton class=\"btn btn-default btn-suprimerFraisHF col-xs-3 col-xs-offset-9\" id=\"btn-suprimer";
            // line 105
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "\" onclick=\"suprimerFrais('";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
            echo "');\">Suprimer</buton>
                            </div>
                            <div class=\"bandeau-small\"></div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 109
        echo "                    </div>
                    <div class=\"row\">
                     <button type=\"button\" id=\"btn-ajouter";
        // line 111
        echo twig_escape_filter($this->env, (isset($context["nbFraisHorsForfait"]) ? $context["nbFraisHorsForfait"] : $this->getContext($context, "nbFraisHorsForfait")), "html", null, true);
        echo "\"  onclick=\"ajoutFrais(";
        echo twig_escape_filter($this->env, (isset($context["nbFraisHorsForfait"]) ? $context["nbFraisHorsForfait"] : $this->getContext($context, "nbFraisHorsForfait")), "html", null, true);
        echo ");\" class=\"btn btn-default\" >Ajouter Frais Hors Forfait</button>
                    </div>
                    <div class=\"bandeau col-xs-12\"></div>

                    <div class=\"row\">
                        <div class=\"col-xs-2 col-xs-offset-5\">
                            <input type=\"submit\" value=\"Enregistrer\" class=\"btn btn-default \"></input>
                        </div>
                    </div>
                    <div class=\"bandeau-small\"></div>
                </form>
            </div>
        </div>
    </div>
    <script language=\"javascript\" src=\"";
        // line 125
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("JavaScript/fraisHF.js"), "html", null, true);
        echo "\"></script>

    <script language=\"javascript\" src=\"";
        // line 127
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("JavaScript/verificationFiche.js"), "html", null, true);
        echo "\"></script>



";
        
        $__internal_da31ac2bce3336dd4269a718eb6ded04f07258fb90aa3a836516f81860ec313b->leave($__internal_da31ac2bce3336dd4269a718eb6ded04f07258fb90aa3a836516f81860ec313b_prof);

    }

    // line 132
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_39f459de889940014f574a9a853dccb1fd9358863832408b01008de3285fe07b = $this->env->getExtension("native_profiler");
        $__internal_39f459de889940014f574a9a853dccb1fd9358863832408b01008de3285fe07b->enter($__internal_39f459de889940014f574a9a853dccb1fd9358863832408b01008de3285fe07b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 133
        echo "


";
        
        $__internal_39f459de889940014f574a9a853dccb1fd9358863832408b01008de3285fe07b->leave($__internal_39f459de889940014f574a9a853dccb1fd9358863832408b01008de3285fe07b_prof);

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
        return array (  289 => 133,  283 => 132,  271 => 127,  266 => 125,  247 => 111,  243 => 109,  231 => 105,  219 => 98,  200 => 84,  192 => 81,  179 => 71,  173 => 69,  170 => 68,  166 => 67,  163 => 66,  161 => 65,  148 => 54,  135 => 49,  130 => 47,  126 => 45,  122 => 44,  108 => 33,  103 => 30,  94 => 28,  90 => 27,  80 => 20,  73 => 16,  65 => 13,  57 => 7,  51 => 6,  42 => 4,  36 => 3,  11 => 1,);
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
/*                         <p>Date modification : {{ ficheFrais.dateModif|date("d/m/Y") }}</p>*/
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
/*                 <form name="ficheFrais" method="post" action="{{ path('utilisateur_enregistrer', {mois: ficheFrais.mois}) }}" onsubmit="return verifFiche(this)"  onblur="verifChampNumerique(this)">*/
/*                     <div class="row" id ="fraisForfait">*/
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
/*                                         <input type="number" value="{{ item.quantite }}" name="{{ key }}" min="0" class="form-control " onblur="verifChampNumerique(this)" >*/
/*                                     </td>*/
/* */
/*                                 </tr>*/
/*                             {% endfor %}*/
/* */
/*                             </tbody>*/
/*                         </table>*/
/*                     </div>*/
/* */
/*                     <div class="bandeau-small"></div>*/
/* */
/* */
/*                     <div class="row" id ="fraisHorsForfait">*/
/*                         <h3>Frais Hors Forfait</h3>*/
/*                         <div class="bandeau-small"></div>*/
/*                         {%  set nbFraisHorsForfait = 0%}*/
/* */
/*                         {% for key, item in ligneFraisHorsForfait %}*/
/*                             {% set nbFraisHorsForfait =  nbFraisHorsForfait + 1  %}*/
/*                             <div class="row" id="fraisHorsForfait{{ item.num }}">*/
/*                                 <table class="table table-bordered" >*/
/*                                     <h4>Frais hors forfait n° {{ item.num }}</h4>*/
/*                                     <thead>*/
/*                                     <tr>*/
/*                                         <th><p>Date (jj/mm/aaa)</p></th>*/
/*                                         <th><p>Montant</p></th>*/
/*                                     </tr>*/
/* */
/*                                     </thead>*/
/*                                     <tbody>*/
/*                                         <td>*/
/*                                             <input type="date" value="{{ item.date|date('d/m/Y') }}" name ="date[{{ item.num }}]" class="form-control" onblur="verifChampDate(this)">*/
/*                                         </td>*/
/*                                         <td>*/
/*                                             <input type="number" value="{{ item.montant }}" name="montant[{{ item.num }}]" class="form-control" onblur="verifChampNumerique(this)">*/
/*                                         </td>*/
/* */
/*                                         <table class="table table-bordered" id="libelleHF">*/
/*                                             <thead>*/
/*                                             <tr>*/
/*                                                 <th><p>Libelle</p></th>*/
/*                                             </tr>*/
/*                                             </thead>*/
/* */
/*                                             <tbody>*/
/*                                                 <tr>*/
/* */
/*                                                    <td>*/
/*                                                         <textarea type="textarea"  name="libelle[{{ item.num }}]" class="form-control" onblur="verifChampText(this)">{{ item.libelleLigneHorsForfait }}</textarea>*/
/*                                                     </td>*/
/*                                                 </tr>*/
/*                                             </tbody>*/
/*                                         </table>*/
/*                                     </tbody>*/
/*                                 </table>*/
/*                                 <buton class="btn btn-default btn-suprimerFraisHF col-xs-3 col-xs-offset-9" id="btn-suprimer{{ item.num }}" onclick="suprimerFrais('{{ item.num }}');">Suprimer</buton>*/
/*                             </div>*/
/*                             <div class="bandeau-small"></div>*/
/*                         {% endfor %}*/
/*                     </div>*/
/*                     <div class="row">*/
/*                      <button type="button" id="btn-ajouter{{ nbFraisHorsForfait }}"  onclick="ajoutFrais({{ nbFraisHorsForfait }});" class="btn btn-default" >Ajouter Frais Hors Forfait</button>*/
/*                     </div>*/
/*                     <div class="bandeau col-xs-12"></div>*/
/* */
/*                     <div class="row">*/
/*                         <div class="col-xs-2 col-xs-offset-5">*/
/*                             <input type="submit" value="Enregistrer" class="btn btn-default "></input>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="bandeau-small"></div>*/
/*                 </form>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     <script language="javascript" src="{{ asset('JavaScript/fraisHF.js') }}"></script>*/
/* */
/*     <script language="javascript" src="{{ asset('JavaScript/verificationFiche.js') }}"></script>*/
/* */
/* */
/* */
/* {% endblock  %}*/
/* {% block javascripts %}*/
/* */
/* */
/* */
/* {% endblock %}*/
/* */
