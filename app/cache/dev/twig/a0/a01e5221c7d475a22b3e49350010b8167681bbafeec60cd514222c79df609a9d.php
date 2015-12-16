<?php

/* GestionFraisBundle:Utilisateur:index.html.twig */
class __TwigTemplate_81dd1d7d20dd0e235f09c31a5c09cd0fd5b901cc6f978621e99949486e8ad48c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "GestionFraisBundle:Utilisateur:index.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_37c788784294ab426d5d8364d3a43860ee46249cb256b8f8b61c287e0af7b910 = $this->env->getExtension("native_profiler");
        $__internal_37c788784294ab426d5d8364d3a43860ee46249cb256b8f8b61c287e0af7b910->enter($__internal_37c788784294ab426d5d8364d3a43860ee46249cb256b8f8b61c287e0af7b910_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "GestionFraisBundle:Utilisateur:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_37c788784294ab426d5d8364d3a43860ee46249cb256b8f8b61c287e0af7b910->leave($__internal_37c788784294ab426d5d8364d3a43860ee46249cb256b8f8b61c287e0af7b910_prof);

    }

    // line 2
    public function block_body($context, array $blocks = array())
    {
        $__internal_d2b806980bdebdba124c61312190b104e83433cbff5db98e1757f646c4a40e67 = $this->env->getExtension("native_profiler");
        $__internal_d2b806980bdebdba124c61312190b104e83433cbff5db98e1757f646c4a40e67->enter($__internal_d2b806980bdebdba124c61312190b104e83433cbff5db98e1757f646c4a40e67_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 3
        echo "
    <div class=\"container\">
        <dv class=\"col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12\" id=\"contenu\" >
            <h2 class=\"\">Fiche Frais</h2>
            <div class=\"bandeau\"></div>

                ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ficheFrais"]) ? $context["ficheFrais"] : $this->getContext($context, "ficheFrais")));
        foreach ($context['_seq'] as $context["_key"] => $context["fiche"]) {
            // line 10
            echo "                    ";
            $context["etatFiche"] = "";
            // line 11
            echo "                    ";
            $context["action"] = "";
            // line 12
            echo "                    ";
            $context["libelleMois"] = twig_join_filter(array(0 => twig_slice($this->env, $this->getAttribute($context["fiche"], "mois", array()), 0, 2), 1 => twig_slice($this->env, $this->getAttribute($context["fiche"], "mois", array()), 2, null)), "/");
            // line 13
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["etatFicheFrais"]) ? $context["etatFicheFrais"] : $this->getContext($context, "etatFicheFrais")));
            foreach ($context['_seq'] as $context["_key"] => $context["etat"]) {
                // line 14
                echo "                        ";
                if (($this->getAttribute($context["etat"], "id", array()) == $this->getAttribute($context["fiche"], "idEtatFicheFrais", array()))) {
                    // line 15
                    echo "                            ";
                    $context["etatFiche"] = $this->getAttribute($context["etat"], "libelle", array());
                    // line 16
                    echo "                            ";
                    if (((isset($context["etatFiche"]) ? $context["etatFiche"] : $this->getContext($context, "etatFiche")) != "Fiche créée, saisie en cours")) {
                        // line 17
                        echo "                                ";
                        $context["action"] = "utilisateur_consulter";
                        // line 18
                        echo "                            ";
                    } else {
                        // line 19
                        echo "                                ";
                        $context["action"] = "utilisateur_renseigner";
                        // line 20
                        echo "                            ";
                    }
                    // line 21
                    echo "                        ";
                }
                // line 22
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['etat'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "
                    <a class=\"lien-fiche\" href=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), array("mois" => $this->getAttribute($context["fiche"], "mois", array()))), "html", null, true);
            echo "\">
                        <div class=\"row\" id = \"";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute($context["fiche"], "mois", array()), "html", null, true);
            echo "\">
                            <div class=\"col-sm-6\">
                                <p>Mois : ";
            // line 27
            echo twig_escape_filter($this->env, (isset($context["libelleMois"]) ? $context["libelleMois"] : $this->getContext($context, "libelleMois")), "html", null, true);
            echo "</p>
                            </div>
                            <div class=\"col-sm-6\">
                                <p>Date de modification : ";
            // line 30
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["fiche"], "dateModif", array()), "d/m/Y"), "html", null, true);
            echo "</p>
                            </div>
                            <div class=\"col-xs-12\">
                                <p>Etat : ";
            // line 33
            echo twig_escape_filter($this->env, (isset($context["etatFiche"]) ? $context["etatFiche"] : $this->getContext($context, "etatFiche")), "html", null, true);
            echo "</p>
                            </div>
                        </div>
                    </a>
                    <div class=\"bandeau-small\"></div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fiche'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "        </div>
    </div>

";
        
        $__internal_d2b806980bdebdba124c61312190b104e83433cbff5db98e1757f646c4a40e67->leave($__internal_d2b806980bdebdba124c61312190b104e83433cbff5db98e1757f646c4a40e67_prof);

    }

    public function getTemplateName()
    {
        return "GestionFraisBundle:Utilisateur:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 39,  120 => 33,  114 => 30,  108 => 27,  103 => 25,  99 => 24,  96 => 23,  90 => 22,  87 => 21,  84 => 20,  81 => 19,  78 => 18,  75 => 17,  72 => 16,  69 => 15,  66 => 14,  61 => 13,  58 => 12,  55 => 11,  52 => 10,  48 => 9,  40 => 3,  34 => 2,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* {%  block body %}*/
/* */
/*     <div class="container">*/
/*         <dv class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12" id="contenu" >*/
/*             <h2 class="">Fiche Frais</h2>*/
/*             <div class="bandeau"></div>*/
/* */
/*                 {% for fiche in ficheFrais %}*/
/*                     {% set etatFiche = "" %}*/
/*                     {% set action = "" %}*/
/*                     {% set libelleMois = [fiche.mois[0:2],fiche.mois[2:]]|join('/') %}*/
/*                     {% for etat in etatFicheFrais %}*/
/*                         {% if etat.id == fiche.idEtatFicheFrais %}*/
/*                             {%  set etatFiche = etat.libelle %}*/
/*                             {% if etatFiche != "Fiche créée, saisie en cours" %}*/
/*                                 {% set action = "utilisateur_consulter" %}*/
/*                             {% else %}*/
/*                                 {% set action = "utilisateur_renseigner" %}*/
/*                             {% endif %}*/
/*                         {% endif %}*/
/*                     {% endfor %}*/
/* */
/*                     <a class="lien-fiche" href="{{ path(action, {mois: fiche.mois}) }}">*/
/*                         <div class="row" id = "{{ fiche.mois }}">*/
/*                             <div class="col-sm-6">*/
/*                                 <p>Mois : {{ libelleMois }}</p>*/
/*                             </div>*/
/*                             <div class="col-sm-6">*/
/*                                 <p>Date de modification : {{ fiche.dateModif|date("d/m/Y") }}</p>*/
/*                             </div>*/
/*                             <div class="col-xs-12">*/
/*                                 <p>Etat : {{ etatFiche }}</p>*/
/*                             </div>*/
/*                         </div>*/
/*                     </a>*/
/*                     <div class="bandeau-small"></div>*/
/*                 {% endfor %}*/
/*         </div>*/
/*     </div>*/
/* */
/* {% endblock  %}*/
/* */
