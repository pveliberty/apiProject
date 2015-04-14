<?php

/* TwigBundle:Exception:trace.txt.twig */
class __TwigTemplate_c19b6cd92a4d8cede0e50bb8ad3ceaa84ef039316b180c712bfe91285d74a78d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_769130574616cc4ea02e7e0b0cfe23ea8e6ccdefbcac4f79214df693f8ee5ee2 = $this->env->getExtension("native_profiler");
        $__internal_769130574616cc4ea02e7e0b0cfe23ea8e6ccdefbcac4f79214df693f8ee5ee2->enter($__internal_769130574616cc4ea02e7e0b0cfe23ea8e6ccdefbcac4f79214df693f8ee5ee2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:trace.txt.twig"));

        // line 1
        if (twig_template_get_attributes($this, (isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "function", array())) {
            // line 2
            echo "    at ";
            echo ((twig_template_get_attributes($this, (isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "class", array()) . twig_template_get_attributes($this, (isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "type", array())) . twig_template_get_attributes($this, (isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "function", array()));
            echo "(";
            echo $this->env->getExtension('code')->formatArgsAsText(twig_template_get_attributes($this, (isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "args", array()));
            echo ")
";
        } else {
            // line 4
            echo "    at n/a
";
        }
        // line 6
        if ((twig_template_get_attributes($this, (isset($context["trace"]) ? $context["trace"] : null), "file", array(), "any", true, true) && twig_template_get_attributes($this, (isset($context["trace"]) ? $context["trace"] : null), "line", array(), "any", true, true))) {
            // line 7
            echo "        in ";
            echo twig_template_get_attributes($this, (isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "file", array());
            echo " line ";
            echo twig_template_get_attributes($this, (isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "line", array());
            echo "
";
        }
        
        $__internal_769130574616cc4ea02e7e0b0cfe23ea8e6ccdefbcac4f79214df693f8ee5ee2->leave($__internal_769130574616cc4ea02e7e0b0cfe23ea8e6ccdefbcac4f79214df693f8ee5ee2_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:trace.txt.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 7,  36 => 6,  32 => 4,  24 => 2,  22 => 1,);
    }
}
