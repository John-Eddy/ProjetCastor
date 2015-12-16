<?php

/* ::base.html.twig */
class __TwigTemplate_67d0401f58272677922083888a1f0a19099539e4dc9871eb5951e64bb48bfde2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e43dab5369892235af5178e7b7550f0742dd292e1a277c06786b3dc02bb96d41 = $this->env->getExtension("native_profiler");
        $__internal_e43dab5369892235af5178e7b7550f0742dd292e1a277c06786b3dc02bb96d41->enter($__internal_e43dab5369892235af5178e7b7550f0742dd292e1a277c06786b3dc02bb96d41_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">


    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("Css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <!-- Custom CSS -->
    <link href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("Css/style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

    ";
        // line 16
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 17
        echo "

    <!-- Custom Fonts -->
    <link rel=\"icon\" type=\"image/png\" href=\"img/favicon.png\" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
    <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->

    <title>";
        // line 29
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
</head>

<body onload=\"footerDown()\">
<header id=\"header\">
<nav class=\"navbar navbar-inverse\">
    <div class=\"container-fluid\">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
                <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            <a class=\"navbar-brand\" href=\"#\">
                <img onclick=\"footerDown()\" alt=\"Brand\" src=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("Images/logo_gsb.png"), "html", null, true);
        echo "\">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">



            ";
        // line 56
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 57
            echo "
                <ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"";
            // line 59
            echo $this->env->getExtension('routing')->getPath("fos_user_security_logout");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logout", array(), "FOSUserBundle"), "html", null, true);
            echo "</a></li>
                    <p class=\"navbar-text\">";
            // line 60
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logged_in_as", array("%username%" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "username", array())), "FOSUserBundle"), "html", null, true);
            echo " </p>
                   </ul>
            ";
        } else {
            // line 63
            echo "                <ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"";
            // line 64
            echo $this->env->getExtension('routing')->getPath("fos_user_security_login");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.login", array(), "FOSUserBundle"), "html", null, true);
            echo "</a></li>
                </ul>
            ";
        }
        // line 67
        echo "
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

</header>






    ";
        // line 79
        $this->displayBlock('body', $context, $blocks);
        // line 80
        echo "


<div class=\"bandeau\"></div>

<footer class=\"container\" id=\"footer\">

</footer>

";
        // line 89
        $this->displayBlock('javascripts', $context, $blocks);
        // line 90
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("JavaScript/form.js"), "html", null, true);
        echo "\"></script>

</body>

</html>
";
        
        $__internal_e43dab5369892235af5178e7b7550f0742dd292e1a277c06786b3dc02bb96d41->leave($__internal_e43dab5369892235af5178e7b7550f0742dd292e1a277c06786b3dc02bb96d41_prof);

    }

    // line 16
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_a568e2e41f937a2ac4a3485b6ba97416b286bdb65f0276413aaf934f3f1193c5 = $this->env->getExtension("native_profiler");
        $__internal_a568e2e41f937a2ac4a3485b6ba97416b286bdb65f0276413aaf934f3f1193c5->enter($__internal_a568e2e41f937a2ac4a3485b6ba97416b286bdb65f0276413aaf934f3f1193c5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_a568e2e41f937a2ac4a3485b6ba97416b286bdb65f0276413aaf934f3f1193c5->leave($__internal_a568e2e41f937a2ac4a3485b6ba97416b286bdb65f0276413aaf934f3f1193c5_prof);

    }

    // line 29
    public function block_title($context, array $blocks = array())
    {
        $__internal_ec52d41fb68ca7183d025301ebf712c902d70291da56f42ea58ca91eadd0bb7a = $this->env->getExtension("native_profiler");
        $__internal_ec52d41fb68ca7183d025301ebf712c902d70291da56f42ea58ca91eadd0bb7a->enter($__internal_ec52d41fb68ca7183d025301ebf712c902d70291da56f42ea58ca91eadd0bb7a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_ec52d41fb68ca7183d025301ebf712c902d70291da56f42ea58ca91eadd0bb7a->leave($__internal_ec52d41fb68ca7183d025301ebf712c902d70291da56f42ea58ca91eadd0bb7a_prof);

    }

    // line 79
    public function block_body($context, array $blocks = array())
    {
        $__internal_9c7ab09dc4c7de0f97a1cddaa530fe14e5f87ca12d13f45f6489134cc46083cd = $this->env->getExtension("native_profiler");
        $__internal_9c7ab09dc4c7de0f97a1cddaa530fe14e5f87ca12d13f45f6489134cc46083cd->enter($__internal_9c7ab09dc4c7de0f97a1cddaa530fe14e5f87ca12d13f45f6489134cc46083cd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_9c7ab09dc4c7de0f97a1cddaa530fe14e5f87ca12d13f45f6489134cc46083cd->leave($__internal_9c7ab09dc4c7de0f97a1cddaa530fe14e5f87ca12d13f45f6489134cc46083cd_prof);

    }

    // line 89
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_40bb7d83ca7faf10cd21f4608faf46ce92503a2d2e359275ea0d5d53784256d3 = $this->env->getExtension("native_profiler");
        $__internal_40bb7d83ca7faf10cd21f4608faf46ce92503a2d2e359275ea0d5d53784256d3->enter($__internal_40bb7d83ca7faf10cd21f4608faf46ce92503a2d2e359275ea0d5d53784256d3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_40bb7d83ca7faf10cd21f4608faf46ce92503a2d2e359275ea0d5d53784256d3->leave($__internal_40bb7d83ca7faf10cd21f4608faf46ce92503a2d2e359275ea0d5d53784256d3_prof);

    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  206 => 89,  195 => 79,  184 => 29,  173 => 16,  159 => 90,  157 => 89,  146 => 80,  144 => 79,  130 => 67,  122 => 64,  119 => 63,  113 => 60,  107 => 59,  103 => 57,  101 => 56,  89 => 47,  70 => 31,  65 => 29,  51 => 17,  49 => 16,  44 => 14,  39 => 12,  26 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <meta charset="UTF-8" />*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1">*/
/*     <meta name="description" content="">*/
/*     <meta name="author" content="">*/
/* */
/* */
/*     <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->*/
/*     <link href="{{ asset('Css/bootstrap.min.css') }}" rel="stylesheet">*/
/*     <!-- Custom CSS -->*/
/*     <link href="{{ asset('Css/style.css') }}" rel="stylesheet">*/
/* */
/*     {% block stylesheets %}{% endblock %}*/
/* */
/* */
/*     <!-- Custom Fonts -->*/
/*     <link rel="icon" type="image/png" href="img/favicon.png" />*/
/* */
/*     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->*/
/*     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->*/
/*     <!--[if lt IE 9]>*/
/*     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>*/
/*     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>*/
/*     <![endif]-->*/
/* */
/*     <title>{% block title %}{% endblock %}</title>*/
/* */
/*     <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />*/
/* </head>*/
/* */
/* <body onload="footerDown()">*/
/* <header id="header">*/
/* <nav class="navbar navbar-inverse">*/
/*     <div class="container-fluid">*/
/*         <!-- Brand and toggle get grouped for better mobile display -->*/
/*         <div class="navbar-header">*/
/*             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">*/
/*                 <span class="sr-only">Toggle navigation</span>*/
/*                 <span class="icon-bar"></span>*/
/*                 <span class="icon-bar"></span>*/
/*                 <span class="icon-bar"></span>*/
/*             </button>*/
/*             <a class="navbar-brand" href="#">*/
/*                 <img onclick="footerDown()" alt="Brand" src="{{ asset('Images/logo_gsb.png') }}">*/
/*             </a>*/
/*         </div>*/
/* */
/*         <!-- Collect the nav links, forms, and other content for toggling -->*/
/*         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">*/
/* */
/* */
/* */
/*             {% if is_granted("IS_AUTHENTICATED_REMEMBERED") %}*/
/* */
/*                 <ul class="nav navbar-nav navbar-right">*/
/*                     <li><a href="{{ path('fos_user_security_logout') }}">{{ 'layout.logout'|trans({}, 'FOSUserBundle') }}</a></li>*/
/*                     <p class="navbar-text">{{ 'layout.logged_in_as'|trans({'%username%': app.user.username}, 'FOSUserBundle') }} </p>*/
/*                    </ul>*/
/*             {% else %}*/
/*                 <ul class="nav navbar-nav navbar-right">*/
/*                     <li><a href="{{ path('fos_user_security_login') }}">{{ 'layout.login'|trans({}, 'FOSUserBundle') }}</a></li>*/
/*                 </ul>*/
/*             {% endif %}*/
/* */
/*         </div><!-- /.navbar-collapse -->*/
/*     </div><!-- /.container-fluid -->*/
/* </nav>*/
/* */
/* </header>*/
/* */
/* */
/* */
/* */
/* */
/* */
/*     {% block body %}{% endblock %}*/
/* */
/* */
/* */
/* <div class="bandeau"></div>*/
/* */
/* <footer class="container" id="footer">*/
/* */
/* </footer>*/
/* */
/* {% block javascripts %}{% endblock %}*/
/* <script src="{{ asset('JavaScript/form.js') }}"></script>*/
/* */
/* </body>*/
/* */
/* </html>*/
/* */
