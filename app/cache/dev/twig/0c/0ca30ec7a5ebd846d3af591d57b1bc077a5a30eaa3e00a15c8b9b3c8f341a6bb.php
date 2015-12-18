<?php

/* FOSUserBundle:Security:login.html.twig */
class __TwigTemplate_072ce3a1f03b77c9e7a214a6be4538ad18f4ad072c9e8a1767e0c65db5798b48 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "FOSUserBundle:Security:login.html.twig", 1);
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
        $__internal_29bac4a973636714adad96b7b09314172ba960d9d0cdbd6757cb372a8227972c = $this->env->getExtension("native_profiler");
        $__internal_29bac4a973636714adad96b7b09314172ba960d9d0cdbd6757cb372a8227972c->enter($__internal_29bac4a973636714adad96b7b09314172ba960d9d0cdbd6757cb372a8227972c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Security:login.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_29bac4a973636714adad96b7b09314172ba960d9d0cdbd6757cb372a8227972c->leave($__internal_29bac4a973636714adad96b7b09314172ba960d9d0cdbd6757cb372a8227972c_prof);

    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        $__internal_2d4921d26c6fac9e5a6f58c3cdacfe076944f968d0940c1438d3e83c89c1b3e7 = $this->env->getExtension("native_profiler");
        $__internal_2d4921d26c6fac9e5a6f58c3cdacfe076944f968d0940c1438d3e83c89c1b3e7->enter($__internal_2d4921d26c6fac9e5a6f58c3cdacfe076944f968d0940c1438d3e83c89c1b3e7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "

<div class=\"container\">
    <div class=\" col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12\" id=\"contenu\" >

        <div class=\"container\">

            <form class=\"form-signin\" action=\"";
        // line 13
        echo $this->env->getExtension('routing')->getPath("fos_user_security_check");
        echo "\" method=\"post\">
                <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 14
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\">

                <h3 class=\"text-center\">Connection</h3>

                <div class=\"bandeau-small\"></div>

                <label for=\"username\" class=\"sr-only\">";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>
                <input type=\"text\" id=\"unsername\"  class=\"form-control\" placeholder=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "FOSUserBundle"), "html", null, true);
        echo "\"
                       autofocus=\"\" name=\"_username\" value=\"";
        // line 22
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\" required=\"required\">

                <label for=\"password\" class=\"sr-only\"for=\"remember_me\">";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>
                <input type=\"password\" id=\"password\" name=\"_password\" class=\"form-control\" placeholder=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.password", array(), "FOSUserBundle"), "html", null, true);
        echo "\" required=\"required\">
                ";
        // line 26
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 27
            echo "                    <p style=\"color:red\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "messageKey", array()), $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "messageData", array()), "security"), "html", null, true);
            echo "</p>
                ";
        }
        // line 29
        echo "                <div class=\"checkbox\">
                    <label>
                        <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\">";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "
                    </label>
                </div>
                <div class=\"bandeau-small\"></div>
                <input class=\"btn btn-lg btn-primary btn-block\" type=\"submit\" id=\"_submit\" name=\"_submit\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\" />
                <div class=\"bandeau-small\"></div>
            </form>
        </div> <!-- /container -->
    </div>
</div>
";
        
        $__internal_2d4921d26c6fac9e5a6f58c3cdacfe076944f968d0940c1438d3e83c89c1b3e7->leave($__internal_2d4921d26c6fac9e5a6f58c3cdacfe076944f968d0940c1438d3e83c89c1b3e7_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 35,  95 => 31,  91 => 29,  85 => 27,  83 => 26,  79 => 25,  75 => 24,  70 => 22,  66 => 21,  62 => 20,  53 => 14,  49 => 13,  40 => 6,  34 => 5,  11 => 1,);
    }
}
/* {% extends "::base.html.twig" %}*/
/* */
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* {% block body %}*/
/* */
/* */
/* <div class="container">*/
/*     <div class=" col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12" id="contenu" >*/
/* */
/*         <div class="container">*/
/* */
/*             <form class="form-signin" action="{{ path("fos_user_security_check") }}" method="post">*/
/*                 <input type="hidden" name="_csrf_token" value="{{ csrf_token }}">*/
/* */
/*                 <h3 class="text-center">Connection</h3>*/
/* */
/*                 <div class="bandeau-small"></div>*/
/* */
/*                 <label for="username" class="sr-only">{{ 'security.login.username'|trans }}</label>*/
/*                 <input type="text" id="unsername"  class="form-control" placeholder="{{ 'security.login.username'|trans }}"*/
/*                        autofocus="" name="_username" value="{{ last_username }}" required="required">*/
/* */
/*                 <label for="password" class="sr-only"for="remember_me">{{ 'security.login.remember_me'|trans }}</label>*/
/*                 <input type="password" id="password" name="_password" class="form-control" placeholder="{{  'security.login.password'|trans }}" required="required">*/
/*                 {% if error %}*/
/*                     <p style="color:red">{{ error.messageKey|trans(error.messageData, 'security') }}</p>*/
/*                 {% endif %}*/
/*                 <div class="checkbox">*/
/*                     <label>*/
/*                         <input type="checkbox" id="remember_me" name="_remember_me" value="on">{{ 'security.login.remember_me'|trans }}*/
/*                     </label>*/
/*                 </div>*/
/*                 <div class="bandeau-small"></div>*/
/*                 <input class="btn btn-lg btn-primary btn-block" type="submit" id="_submit" name="_submit" value="{{ 'security.login.submit'|trans }}" />*/
/*                 <div class="bandeau-small"></div>*/
/*             </form>*/
/*         </div> <!-- /container -->*/
/*     </div>*/
/* </div>*/
/* {% endblock body %}*/
/* */
