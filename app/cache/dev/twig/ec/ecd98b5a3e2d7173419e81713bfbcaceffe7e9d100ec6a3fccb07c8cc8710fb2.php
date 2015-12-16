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
        $__internal_3ed3d3b66ee9872de689ebda2511701c4ae5ca5c6ff8dc1bbf0db546466ab10d = $this->env->getExtension("native_profiler");
        $__internal_3ed3d3b66ee9872de689ebda2511701c4ae5ca5c6ff8dc1bbf0db546466ab10d->enter($__internal_3ed3d3b66ee9872de689ebda2511701c4ae5ca5c6ff8dc1bbf0db546466ab10d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3ed3d3b66ee9872de689ebda2511701c4ae5ca5c6ff8dc1bbf0db546466ab10d->leave($__internal_3ed3d3b66ee9872de689ebda2511701c4ae5ca5c6ff8dc1bbf0db546466ab10d_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_27b0a0685029be91536f50459d806fd6ca6dd3dee9ed6b821372a19f8137a98c = $this->env->getExtension("native_profiler");
        $__internal_27b0a0685029be91536f50459d806fd6ca6dd3dee9ed6b821372a19f8137a98c->enter($__internal_27b0a0685029be91536f50459d806fd6ca6dd3dee9ed6b821372a19f8137a98c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_27b0a0685029be91536f50459d806fd6ca6dd3dee9ed6b821372a19f8137a98c->leave($__internal_27b0a0685029be91536f50459d806fd6ca6dd3dee9ed6b821372a19f8137a98c_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_d09e371fd4ba66944772cd6e4b57f098b143e81168f76620f6d110c4828d3a03 = $this->env->getExtension("native_profiler");
        $__internal_d09e371fd4ba66944772cd6e4b57f098b143e81168f76620f6d110c4828d3a03->enter($__internal_d09e371fd4ba66944772cd6e4b57f098b143e81168f76620f6d110c4828d3a03_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_d09e371fd4ba66944772cd6e4b57f098b143e81168f76620f6d110c4828d3a03->leave($__internal_d09e371fd4ba66944772cd6e4b57f098b143e81168f76620f6d110c4828d3a03_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_655ef116f5d2051d8397e7963f2d2fdb9cd4af1d4eb55e197f8d35a8d3df19ea = $this->env->getExtension("native_profiler");
        $__internal_655ef116f5d2051d8397e7963f2d2fdb9cd4af1d4eb55e197f8d35a8d3df19ea->enter($__internal_655ef116f5d2051d8397e7963f2d2fdb9cd4af1d4eb55e197f8d35a8d3df19ea_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("TwigBundle:Exception:exception.html.twig", "TwigBundle:Exception:exception_full.html.twig", 12)->display($context);
        
        $__internal_655ef116f5d2051d8397e7963f2d2fdb9cd4af1d4eb55e197f8d35a8d3df19ea->leave($__internal_655ef116f5d2051d8397e7963f2d2fdb9cd4af1d4eb55e197f8d35a8d3df19ea_prof);

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
