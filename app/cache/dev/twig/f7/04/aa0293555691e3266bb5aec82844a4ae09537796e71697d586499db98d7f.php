<?php

/* TwigBundle:Exception:exception_full.html.twig */
class __TwigTemplate_f704aa0293555691e3266bb5aec82844a4ae09537796e71697d586499db98d7f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("TwigBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

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
        $__internal_7be27bceac0495693e821f8658d480e1d3387fa82c21d9f4d1b94cdb416af893 = $this->env->getExtension("native_profiler");
        $__internal_7be27bceac0495693e821f8658d480e1d3387fa82c21d9f4d1b94cdb416af893->enter($__internal_7be27bceac0495693e821f8658d480e1d3387fa82c21d9f4d1b94cdb416af893_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7be27bceac0495693e821f8658d480e1d3387fa82c21d9f4d1b94cdb416af893->leave($__internal_7be27bceac0495693e821f8658d480e1d3387fa82c21d9f4d1b94cdb416af893_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_7c9c361b2eadd5a1b8b57a6bf5d5e3bf75abc86ef2cf6ddf6ff0d1f339c72ca4 = $this->env->getExtension("native_profiler");
        $__internal_7c9c361b2eadd5a1b8b57a6bf5d5e3bf75abc86ef2cf6ddf6ff0d1f339c72ca4->enter($__internal_7c9c361b2eadd5a1b8b57a6bf5d5e3bf75abc86ef2cf6ddf6ff0d1f339c72ca4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_7c9c361b2eadd5a1b8b57a6bf5d5e3bf75abc86ef2cf6ddf6ff0d1f339c72ca4->leave($__internal_7c9c361b2eadd5a1b8b57a6bf5d5e3bf75abc86ef2cf6ddf6ff0d1f339c72ca4_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_f9c6caf5ca7b89d8c84be6c852a791921a6531c01ae085a9ef05e548790a689f = $this->env->getExtension("native_profiler");
        $__internal_f9c6caf5ca7b89d8c84be6c852a791921a6531c01ae085a9ef05e548790a689f->enter($__internal_f9c6caf5ca7b89d8c84be6c852a791921a6531c01ae085a9ef05e548790a689f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, twig_template_get_attributes($this, (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_f9c6caf5ca7b89d8c84be6c852a791921a6531c01ae085a9ef05e548790a689f->leave($__internal_f9c6caf5ca7b89d8c84be6c852a791921a6531c01ae085a9ef05e548790a689f_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_34f97774c57a64fc56dd113f042fda54618a17cdf498ddb17d1e6048e8ee4f1c = $this->env->getExtension("native_profiler");
        $__internal_34f97774c57a64fc56dd113f042fda54618a17cdf498ddb17d1e6048e8ee4f1c->enter($__internal_34f97774c57a64fc56dd113f042fda54618a17cdf498ddb17d1e6048e8ee4f1c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->env->loadTemplate("TwigBundle:Exception:exception.html.twig")->display($context);
        
        $__internal_34f97774c57a64fc56dd113f042fda54618a17cdf498ddb17d1e6048e8ee4f1c->leave($__internal_34f97774c57a64fc56dd113f042fda54618a17cdf498ddb17d1e6048e8ee4f1c_prof);

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
        return array (  86 => 12,  80 => 11,  66 => 8,  60 => 7,  50 => 4,  44 => 3,  11 => 1,);
    }
}
