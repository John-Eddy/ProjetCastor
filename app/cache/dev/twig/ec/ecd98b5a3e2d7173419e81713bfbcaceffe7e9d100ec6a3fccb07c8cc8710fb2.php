<?php

/* TwigBundle:Exception:exception_full.html.twig */
class __TwigTemplate_6049856a38f43bbfdc76feca03b72f318e680bfe6c9cab7df2a1e30f51331205 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("TwigBundle::layout.html.twig", "TwigBundle:Exception:exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TwigBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_07a9cafaa79b484bf2c6f7708c4d759858fb3f2e6dba423c23dce39e2b8dde84 = $this->env->getExtension("native_profiler");
        $__internal_07a9cafaa79b484bf2c6f7708c4d759858fb3f2e6dba423c23dce39e2b8dde84->enter($__internal_07a9cafaa79b484bf2c6f7708c4d759858fb3f2e6dba423c23dce39e2b8dde84_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_07a9cafaa79b484bf2c6f7708c4d759858fb3f2e6dba423c23dce39e2b8dde84->leave($__internal_07a9cafaa79b484bf2c6f7708c4d759858fb3f2e6dba423c23dce39e2b8dde84_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_16e24cde712e05453d8326a4970835221d96d4ce0360139a90b9e22817c1bee3 = $this->env->getExtension("native_profiler");
        $__internal_16e24cde712e05453d8326a4970835221d96d4ce0360139a90b9e22817c1bee3->enter($__internal_16e24cde712e05453d8326a4970835221d96d4ce0360139a90b9e22817c1bee3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_16e24cde712e05453d8326a4970835221d96d4ce0360139a90b9e22817c1bee3->leave($__internal_16e24cde712e05453d8326a4970835221d96d4ce0360139a90b9e22817c1bee3_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_ae88df714627a0747a99965526af03bd38c9766ef22cf26fbfa53d14ca37414d = $this->env->getExtension("native_profiler");
        $__internal_ae88df714627a0747a99965526af03bd38c9766ef22cf26fbfa53d14ca37414d->enter($__internal_ae88df714627a0747a99965526af03bd38c9766ef22cf26fbfa53d14ca37414d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_ae88df714627a0747a99965526af03bd38c9766ef22cf26fbfa53d14ca37414d->leave($__internal_ae88df714627a0747a99965526af03bd38c9766ef22cf26fbfa53d14ca37414d_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_ac5d591e9f850e99fd87945b7a7f7884a2b5fc22297e21baf845a3f9f8351a1b = $this->env->getExtension("native_profiler");
        $__internal_ac5d591e9f850e99fd87945b7a7f7884a2b5fc22297e21baf845a3f9f8351a1b->enter($__internal_ac5d591e9f850e99fd87945b7a7f7884a2b5fc22297e21baf845a3f9f8351a1b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("TwigBundle:Exception:exception.html.twig", "TwigBundle:Exception:exception_full.html.twig", 12)->display($context);
        
        $__internal_ac5d591e9f850e99fd87945b7a7f7884a2b5fc22297e21baf845a3f9f8351a1b->leave($__internal_ac5d591e9f850e99fd87945b7a7f7884a2b5fc22297e21baf845a3f9f8351a1b_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends 'TwigBundle::layout.html.twig' %}*/
/* */
/* {% block head %}*/
/*     <link href="{{ absolute_url(asset('bundles/framework/css/exception.css')) }}" rel="stylesheet" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block title %}*/
/*     {{ exception.message }} ({{ status_code }} {{ status_text }})*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% include 'TwigBundle:Exception:exception.html.twig' %}*/
/* {% endblock %}*/
/* */
