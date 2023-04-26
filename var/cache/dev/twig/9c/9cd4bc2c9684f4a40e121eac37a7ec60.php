<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* commentaire/_form.html.twig */
class __TwigTemplate_8a3e6eaaf684e034dbcf66903953480a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "commentaire/_form.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "commentaire/_form.html.twig"));

        // line 1
        $this->displayBlock('body', $context, $blocks);
        // line 38
        echo " 
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 1
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 2
        echo "

";
        // line 4
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 4, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate"]]);
        echo "
        <form class=\"forms-sample\">

            <div class=\"form-group\">
                ";
        // line 8
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 8, $this->source); })()), "nomUser", [], "any", false, false, false, 8), 'label', ["label" => "nomUser"]);
        echo "
                ";
        // line 9
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 9, $this->source); })()), "nomUser", [], "any", false, false, false, 9), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "nomUser"]]);
        echo "
                <span class=\"text-danger\" >";
        // line 10
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 10, $this->source); })()), "nomUser", [], "any", false, false, false, 10), 'errors', ["attr" => ["class" => "text-danger"]]);
        echo "</span>
            </div>

            <div class=\"form-group\">
                ";
        // line 14
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 14, $this->source); })()), "descriptionc", [], "any", false, false, false, 14), 'label', ["label" => "descriptionc"]);
        echo "
                ";
        // line 15
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 15, $this->source); })()), "descriptionc", [], "any", false, false, false, 15), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "descriptionc"]]);
        echo "
                <span class=\"text-danger\" >";
        // line 16
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 16, $this->source); })()), "descriptionc", [], "any", false, false, false, 16), 'errors', ["attr" => ["class" => "text-danger"]]);
        echo "</span>
            </div>
            <div class=\"form-group\">
                ";
        // line 19
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 19, $this->source); })()), "post", [], "any", false, false, false, 19), 'label', ["label" => "post"]);
        echo "
                ";
        // line 20
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 20, $this->source); })()), "post", [], "any", false, false, false, 20), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "post"]]);
        echo "
                <span class=\"text-danger\" >";
        // line 21
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 21, $this->source); })()), "post", [], "any", false, false, false, 21), 'errors', ["attr" => ["class" => "text-danger"]]);
        echo "</span>
            </div>
            

            
            
            
            <div class=\"input-group col-md-6 mt-4\">
                <button class=\"form-control btn btn-primary mr-2\">";
        // line 29
        echo twig_escape_filter($this->env, ((array_key_exists("button_label", $context)) ? (_twig_default_filter((isset($context["button_label"]) || array_key_exists("button_label", $context) ? $context["button_label"] : (function () { throw new RuntimeError('Variable "button_label" does not exist.', 29, $this->source); })()), "Save")) : ("Save")), "html", null, true);
        echo "</button>

            </div>
            

            ";
        // line 34
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 34, $this->source); })()), 'form_end');
        echo "
        </form>


";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "commentaire/_form.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  134 => 34,  126 => 29,  115 => 21,  111 => 20,  107 => 19,  101 => 16,  97 => 15,  93 => 14,  86 => 10,  82 => 9,  78 => 8,  71 => 4,  67 => 2,  57 => 1,  46 => 38,  44 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% block body %}


{{ form_start(form,{'attr':{'novalidate':'novalidate'}}) }}
        <form class=\"forms-sample\">

            <div class=\"form-group\">
                {{ form_label(form.nomUser, 'nomUser', ) }}
                {{ form_widget(form.nomUser, {'attr': {'class': 'form-control','placeholder': 'nomUser'}}) }}
                <span class=\"text-danger\" >{{ form_errors(form.nomUser,{'attr': {'class':'text-danger'}}) }}</span>
            </div>

            <div class=\"form-group\">
                {{ form_label(form.descriptionc, 'descriptionc', ) }}
                {{ form_widget(form.descriptionc, {'attr': {'class': 'form-control','placeholder': 'descriptionc'}}) }}
                <span class=\"text-danger\" >{{ form_errors(form.descriptionc,{'attr': {'class':'text-danger'}}) }}</span>
            </div>
            <div class=\"form-group\">
                {{ form_label(form.post, 'post', ) }}
                {{ form_widget(form.post, {'attr': {'class': 'form-control','placeholder': 'post'}}) }}
                <span class=\"text-danger\" >{{ form_errors(form.post,{'attr': {'class':'text-danger'}}) }}</span>
            </div>
            

            
            
            
            <div class=\"input-group col-md-6 mt-4\">
                <button class=\"form-control btn btn-primary mr-2\">{{ button_label|default('Save') }}</button>

            </div>
            

            {{ form_end(form) }}
        </form>


{% endblock %} 
", "commentaire/_form.html.twig", "C:\\Users\\mehdi\\OneDrive\\Bureau\\FancyTrade\\FancyTrade\\templates\\commentaire\\_form.html.twig");
    }
}
