<?php

/* GestionFraisBundle:Comptable:index.html.twig */
class __TwigTemplate_a33b9159234bbd23eb36973d1b05efcc98140ea4545baea6e019d01afb26bfe3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "GestionFraisBundle:Comptable:index.html.twig", 1);
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
        $__internal_b8b35505a3451ae7f796b17bec7f1917d6c07a74529fb4f1d7b1185faa9af881 = $this->env->getExtension("native_profiler");
        $__internal_b8b35505a3451ae7f796b17bec7f1917d6c07a74529fb4f1d7b1185faa9af881->enter($__internal_b8b35505a3451ae7f796b17bec7f1917d6c07a74529fb4f1d7b1185faa9af881_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "GestionFraisBundle:Comptable:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b8b35505a3451ae7f796b17bec7f1917d6c07a74529fb4f1d7b1185faa9af881->leave($__internal_b8b35505a3451ae7f796b17bec7f1917d6c07a74529fb4f1d7b1185faa9af881_prof);

    }

    // line 2
    public function block_body($context, array $blocks = array())
    {
        $__internal_1c1de3091c3b10fa7905a1b7023fd7305b1f8df764f58364e0b08a7243c91798 = $this->env->getExtension("native_profiler");
        $__internal_1c1de3091c3b10fa7905a1b7023fd7305b1f8df764f58364e0b08a7243c91798->enter($__internal_1c1de3091c3b10fa7905a1b7023fd7305b1f8df764f58364e0b08a7243c91798_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 3
        echo "
    <div class=\"container\">
        <div class=\"col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12\" id=\"contenu\" >
            <h3 class=\"text-center\">Index Comptable !</h3>
        </div>
    </div>

";
        
        $__internal_1c1de3091c3b10fa7905a1b7023fd7305b1f8df764f58364e0b08a7243c91798->leave($__internal_1c1de3091c3b10fa7905a1b7023fd7305b1f8df764f58364e0b08a7243c91798_prof);

    }

    public function getTemplateName()
    {
        return "GestionFraisBundle:Comptable:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 3,  34 => 2,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* {%  block body %}*/
/* */
/*     <div class="container">*/
/*         <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12" id="contenu" >*/
/*             <h3 class="text-center">Index Comptable !</h3>*/
/*         </div>*/
/*     </div>*/
/* */
/* {% endblock  %}*/
/* */
