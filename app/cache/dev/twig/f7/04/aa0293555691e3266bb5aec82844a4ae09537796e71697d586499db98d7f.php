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
        $__internal_3b5063b1270db2aa0db52b254f8a04764a087ec83545b81ee9243c52f6501c63 = $this->env->getExtension("native_profiler");
        $__internal_3b5063b1270db2aa0db52b254f8a04764a087ec83545b81ee9243c52f6501c63->enter($__internal_3b5063b1270db2aa0db52b254f8a04764a087ec83545b81ee9243c52f6501c63_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3b5063b1270db2aa0db52b254f8a04764a087ec83545b81ee9243c52f6501c63->leave($__internal_3b5063b1270db2aa0db52b254f8a04764a087ec83545b81ee9243c52f6501c63_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_48f803cd0afafa193a7dc8d4a8b92bc7228cc304f58f5679ca2373b29a940148 = $this->env->getExtension("native_profiler");
        $__internal_48f803cd0afafa193a7dc8d4a8b92bc7228cc304f58f5679ca2373b29a940148->enter($__internal_48f803cd0afafa193a7dc8d4a8b92bc7228cc304f58f5679ca2373b29a940148_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_48f803cd0afafa193a7dc8d4a8b92bc7228cc304f58f5679ca2373b29a940148->leave($__internal_48f803cd0afafa193a7dc8d4a8b92bc7228cc304f58f5679ca2373b29a940148_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_f77e968b58dd2e3528b95c498f6e8ca4f51890c026932ff4db72093e0303b5f3 = $this->env->getExtension("native_profiler");
        $__internal_f77e968b58dd2e3528b95c498f6e8ca4f51890c026932ff4db72093e0303b5f3->enter($__internal_f77e968b58dd2e3528b95c498f6e8ca4f51890c026932ff4db72093e0303b5f3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, twig_template_get_attributes($this, (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_f77e968b58dd2e3528b95c498f6e8ca4f51890c026932ff4db72093e0303b5f3->leave($__internal_f77e968b58dd2e3528b95c498f6e8ca4f51890c026932ff4db72093e0303b5f3_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_b1f22cf2bc8991807e4e707667dc4e2f9f3fd398065820c234d6405c15e54739 = $this->env->getExtension("native_profiler");
        $__internal_b1f22cf2bc8991807e4e707667dc4e2f9f3fd398065820c234d6405c15e54739->enter($__internal_b1f22cf2bc8991807e4e707667dc4e2f9f3fd398065820c234d6405c15e54739_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->env->loadTemplate("TwigBundle:Exception:exception.html.twig")->display($context);
        
        $__internal_b1f22cf2bc8991807e4e707667dc4e2f9f3fd398065820c234d6405c15e54739->leave($__internal_b1f22cf2bc8991807e4e707667dc4e2f9f3fd398065820c234d6405c15e54739_prof);

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
