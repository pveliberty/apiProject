<?php

/* TwigBundle:Exception:traces.txt.twig */
class __TwigTemplate_278b9daf7d85098e481d0cfff953ed2d37a76d175bcf1642bfdf065a018f63cc extends Twig_Template
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
        $__internal_b228ae873b3e2fe9a80b163a461493b4ddf897b8d09cec2404121ded07dc804b = $this->env->getExtension("native_profiler");
        $__internal_b228ae873b3e2fe9a80b163a461493b4ddf897b8d09cec2404121ded07dc804b->enter($__internal_b228ae873b3e2fe9a80b163a461493b4ddf897b8d09cec2404121ded07dc804b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:traces.txt.twig"));

        // line 1
        if (twig_length_filter($this->env, twig_template_get_attributes($this, (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "trace", array()))) {
            // line 2
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_template_get_attributes($this, (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "trace", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["trace"]) {
                // line 3
                $this->env->loadTemplate("TwigBundle:Exception:trace.txt.twig")->display(array("trace" => $context["trace"]));
                // line 4
                echo "
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trace'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        
        $__internal_b228ae873b3e2fe9a80b163a461493b4ddf897b8d09cec2404121ded07dc804b->leave($__internal_b228ae873b3e2fe9a80b163a461493b4ddf897b8d09cec2404121ded07dc804b_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:traces.txt.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 4,  28 => 3,  24 => 2,  22 => 1,);
    }
}
