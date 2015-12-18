<?php

/* GestionFraisBundle:Utilisateur:consulterFiche.html.twig */
class __TwigTemplate_dd7d4e34038881ab868adcc8989165cff9e11bde5aff86d933d582d5a0f647ec extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "GestionFraisBundle:Utilisateur:consulterFiche.html.twig", 1);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_ca39bdd85abb35f35032b016fbc55e06e493cafd11e46cf90e3cf949271c34c0 = $this->env->getExtension("native_profiler");
        $__internal_ca39bdd85abb35f35032b016fbc55e06e493cafd11e46cf90e3cf949271c34c0->enter($__internal_ca39bdd85abb35f35032b016fbc55e06e493cafd11e46cf90e3cf949271c34c0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "GestionFraisBundle:Utilisateur:consulterFiche.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ca39bdd85abb35f35032b016fbc55e06e493cafd11e46cf90e3cf949271c34c0->leave($__internal_ca39bdd85abb35f35032b016fbc55e06e493cafd11e46cf90e3cf949271c34c0_prof);

    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_385850983bbce0fcc00097545e282c6a59f08c0920547d6f2ba3834bb67ebdc7 = $this->env->getExtension("native_profiler");
        $__internal_385850983bbce0fcc00097545e282c6a59f08c0920547d6f2ba3834bb67ebdc7->enter($__internal_385850983bbce0fcc00097545e282c6a59f08c0920547d6f2ba3834bb67ebdc7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        echo "<link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("Css/form.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">";
        
        $__internal_385850983bbce0fcc00097545e282c6a59f08c0920547d6f2ba3834bb67ebdc7->leave($__internal_385850983bbce0fcc00097545e282c6a59f08c0920547d6f2ba3834bb67ebdc7_prof);

    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        $__internal_3da22eea4e9464ca5093504d46ab3ddc0ce6b215cf0ad6f1624cb4d63775ad0d = $this->env->getExtension("native_profiler");
        $__internal_3da22eea4e9464ca5093504d46ab3ddc0ce6b215cf0ad6f1624cb4d63775ad0d->enter($__internal_3da22eea4e9464ca5093504d46ab3ddc0ce6b215cf0ad6f1624cb4d63775ad0d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "
<div class=\"container\">
    <div class=\"col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12\" id=\"contenu\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-3 col-xs-6\">
                    ";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["visiteur"]) ? $context["visiteur"] : $this->getContext($context, "visiteur")), "nom", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["visiteur"]) ? $context["visiteur"] : $this->getContext($context, "visiteur")), "prenom", array()), "html", null, true);
        echo "
                </div>
                <div class=\"col-sm-3 col-xs-6\">
                    Mois : ";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ficheFrais"]) ? $context["ficheFrais"] : $this->getContext($context, "ficheFrais")), "mois", array()), "html", null, true);
        echo "
                </div>

                <div class=\"col-sm-6 col-xs-12\">
                    Date modification : ";
        // line 19
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["ficheFrais"]) ? $context["ficheFrais"] : $this->getContext($context, "ficheFrais")), "dateModif", array()), "d/m/Y"), "html", null, true);
        echo "
                </div>
            </div>


            <div class=\"row\">
                <div class=\"col-sm-3 col-xs-12\">
                   <p>Etat : ";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["etatFicheFrais"]) ? $context["etatFicheFrais"] : $this->getContext($context, "etatFicheFrais")), "libelle", array()), "html", null, true);
        echo "</p>
                </div>
            </div>


            <div class=\"row\">
                <h3>Frais Forfait</h3>

                <table class=\"table table-bordered\">
                    <thead>
                      <tr>
                        <th>Libelle</th>
                        <th>Quantité</th>
                        <th>Etat</th>
                      </tr>
                    </thead>
                    <tbody>
                       ";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tabLigneFraisForfait"]) ? $context["tabLigneFraisForfait"] : $this->getContext($context, "tabLigneFraisForfait")));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 44
            echo "                           <tr>

                                <td>";
            // line 46
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "</td>
                                <td>";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "quantite", array()), "html", null, true);
            echo "</td>
                                <td> ";
            // line 48
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["etatLigneFrais"]) ? $context["etatLigneFrais"] : $this->getContext($context, "etatLigneFrais")));
            foreach ($context['_seq'] as $context["_key"] => $context["etat"]) {
                // line 49
                echo "                                        ";
                if (($this->getAttribute($context["etat"], "id", array()) == $this->getAttribute($context["item"], "idEtatLigneFrais", array()))) {
                    // line 50
                    echo "                                            ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["etat"], "libelleEtatLigneFrais", array()), "html", null, true);
                    echo "
                                        ";
                }
                // line 52
                echo "                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['etat'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            echo "                                </td>
                           </tr>
                       ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "
                    </tbody>
                </table>
            </div>



            <div class=\"row\">
                <h3>Frais Hors Forfait</h3>
                ";
        // line 65
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ligneFraisHorsForfait"]) ? $context["ligneFraisHorsForfait"] : $this->getContext($context, "ligneFraisHorsForfait")));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 66
            echo "                <table class=\"table table-bordered\">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Etat</th>
                      </tr>

                    </thead>
                    <tbody>
                         <tr>
                                <td>";
            // line 77
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["item"], "date", array()), "d/m/Y"), "html", null, true);
            echo "</td>
                                <td>";
            // line 78
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "montant", array()), "html", null, true);
            echo " €</td>
                                <td>
                                    ";
            // line 80
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["etatLigneFrais"]) ? $context["etatLigneFrais"] : $this->getContext($context, "etatLigneFrais")));
            foreach ($context['_seq'] as $context["_key"] => $context["etat"]) {
                // line 81
                echo "                                        ";
                if (($this->getAttribute($context["etat"], "id", array()) == $this->getAttribute($context["item"], "idEtatLigneFrais", array()))) {
                    // line 82
                    echo "                                            ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["etat"], "libelleEtatLigneFrais", array()), "html", null, true);
                    echo "
                                        ";
                }
                // line 84
                echo "                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['etat'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 85
            echo "
                                </td>
                                <table class=\"table table-bordered\">
                                    <thead>
                                        <tr>
                                         <th>Libelle</th>
                                         </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                             <td>";
            // line 96
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "libelleLigneHorsForfait", array()), "html", null, true);
            echo "</td>
                                         </tr>
                                    </tbody>
                                </table>
                         ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 101
        echo "                         </tr>

                    </tbody>
                </table>
            </div>

            <div class=\"bandeau col-xs-12\"></div>



        </div>
    </div>
</div>

";
        
        $__internal_3da22eea4e9464ca5093504d46ab3ddc0ce6b215cf0ad6f1624cb4d63775ad0d->leave($__internal_3da22eea4e9464ca5093504d46ab3ddc0ce6b215cf0ad6f1624cb4d63775ad0d_prof);

    }

    public function getTemplateName()
    {
        return "GestionFraisBundle:Utilisateur:consulterFiche.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  231 => 101,  220 => 96,  207 => 85,  201 => 84,  195 => 82,  192 => 81,  188 => 80,  183 => 78,  179 => 77,  166 => 66,  162 => 65,  151 => 56,  143 => 53,  137 => 52,  131 => 50,  128 => 49,  124 => 48,  120 => 47,  116 => 46,  112 => 44,  108 => 43,  88 => 26,  78 => 19,  71 => 15,  63 => 12,  55 => 6,  49 => 5,  35 => 3,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* */
/* {% block stylesheets %}<link href="{{ asset('Css/form.css') }}" rel="stylesheet">{% endblock %}*/
/* */
/* {%  block body %}*/
/* */
/* <div class="container">*/
/*     <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12" id="contenu">*/
/*         <div class="container">*/
/*             <div class="row">*/
/*                 <div class="col-sm-3 col-xs-6">*/
/*                     {{ visiteur.nom }} {{ visiteur.prenom }}*/
/*                 </div>*/
/*                 <div class="col-sm-3 col-xs-6">*/
/*                     Mois : {{ ficheFrais.mois }}*/
/*                 </div>*/
/* */
/*                 <div class="col-sm-6 col-xs-12">*/
/*                     Date modification : {{ ficheFrais.dateModif|date("d/m/Y")  }}*/
/*                 </div>*/
/*             </div>*/
/* */
/* */
/*             <div class="row">*/
/*                 <div class="col-sm-3 col-xs-12">*/
/*                    <p>Etat : {{ etatFicheFrais.libelle }}</p>*/
/*                 </div>*/
/*             </div>*/
/* */
/* */
/*             <div class="row">*/
/*                 <h3>Frais Forfait</h3>*/
/* */
/*                 <table class="table table-bordered">*/
/*                     <thead>*/
/*                       <tr>*/
/*                         <th>Libelle</th>*/
/*                         <th>Quantité</th>*/
/*                         <th>Etat</th>*/
/*                       </tr>*/
/*                     </thead>*/
/*                     <tbody>*/
/*                        {% for key, item in tabLigneFraisForfait %}*/
/*                            <tr>*/
/* */
/*                                 <td>{{ key }}</td>*/
/*                                 <td>{{ item.quantite }}</td>*/
/*                                 <td> {% for etat in etatLigneFrais %}*/
/*                                         {% if etat.id == item.idEtatLigneFrais %}*/
/*                                             {{ etat.libelleEtatLigneFrais }}*/
/*                                         {% endif %}*/
/*                                     {% endfor %}*/
/*                                 </td>*/
/*                            </tr>*/
/*                        {% endfor %}*/
/* */
/*                     </tbody>*/
/*                 </table>*/
/*             </div>*/
/* */
/* */
/* */
/*             <div class="row">*/
/*                 <h3>Frais Hors Forfait</h3>*/
/*                 {% for key, item in ligneFraisHorsForfait %}*/
/*                 <table class="table table-bordered">*/
/*                     <thead>*/
/*                       <tr>*/
/*                         <th>Date</th>*/
/*                         <th>Montant</th>*/
/*                         <th>Etat</th>*/
/*                       </tr>*/
/* */
/*                     </thead>*/
/*                     <tbody>*/
/*                          <tr>*/
/*                                 <td>{{ item.date|date("d/m/Y") }}</td>*/
/*                                 <td>{{ item.montant }} €</td>*/
/*                                 <td>*/
/*                                     {% for etat in etatLigneFrais %}*/
/*                                         {% if etat.id == item.idEtatLigneFrais %}*/
/*                                             {{ etat.libelleEtatLigneFrais }}*/
/*                                         {% endif %}*/
/*                                     {% endfor %}*/
/* */
/*                                 </td>*/
/*                                 <table class="table table-bordered">*/
/*                                     <thead>*/
/*                                         <tr>*/
/*                                          <th>Libelle</th>*/
/*                                          </tr>*/
/*                                     </thead>*/
/* */
/*                                     <tbody>*/
/*                                         <tr>*/
/*                                              <td>{{ item.libelleLigneHorsForfait }}</td>*/
/*                                          </tr>*/
/*                                     </tbody>*/
/*                                 </table>*/
/*                          {% endfor %}*/
/*                          </tr>*/
/* */
/*                     </tbody>*/
/*                 </table>*/
/*             </div>*/
/* */
/*             <div class="bandeau col-xs-12"></div>*/
/* */
/* */
/* */
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* {% endblock  %}*/
/* */
/* */
