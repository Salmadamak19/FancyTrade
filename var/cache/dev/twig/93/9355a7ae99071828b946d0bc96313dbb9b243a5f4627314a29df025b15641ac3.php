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

/* post/_form.html.twig */
class __TwigTemplate_090d5b9ffa59a5a63fa13280153f6b6f801748cf559cafb4526716751128ee99 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/_form.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/_form.html.twig"));

        // line 5
        echo "

";
        // line 7
        $this->displayBlock('body', $context, $blocks);
        // line 53
        echo " ";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 8
        echo "

";
        // line 10
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 10, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate"]]);
        echo "
        <form class=\"forms-sample\">

            <div class=\"form-group\">
                ";
        // line 14
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 14, $this->source); })()), "nomUser", [], "any", false, false, false, 14), 'label', ["label" => "nomUser"]);
        echo "
                ";
        // line 15
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 15, $this->source); })()), "nomUser", [], "any", false, false, false, 15), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "nomUser"]]);
        echo "
                <span class=\"text-danger\" >";
        // line 16
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 16, $this->source); })()), "nomUser", [], "any", false, false, false, 16), 'errors', ["attr" => ["class" => "text-danger"]]);
        echo "</span>
            </div>

            <div class=\"form-group\">
                ";
        // line 20
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 20, $this->source); })()), "sujet", [], "any", false, false, false, 20), 'label', ["label" => "sujet"]);
        echo "
                ";
        // line 21
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 21, $this->source); })()), "sujet", [], "any", false, false, false, 21), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "sujet"]]);
        echo "
                <span class=\"text-danger\" >";
        // line 22
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 22, $this->source); })()), "sujet", [], "any", false, false, false, 22), 'errors', ["attr" => ["class" => "text-danger"]]);
        echo "</span>
            </div>
            <div class=\"form-group\">
                ";
        // line 25
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 25, $this->source); })()), "description", [], "any", false, false, false, 25), 'label', ["label" => "description"]);
        echo "
                ";
        // line 26
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 26, $this->source); })()), "description", [], "any", false, false, false, 26), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "description"]]);
        echo "
                <span class=\"text-danger\" >";
        // line 27
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 27, $this->source); })()), "description", [], "any", false, false, false, 27), 'errors', ["attr" => ["class" => "text-danger"]]);
        echo "</span>
            </div>
            <div class=\"form-group \">
                ";
        // line 31
        echo "                <span class=\"text-danger\" >";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 31, $this->source); })()), "image", [], "any", false, false, false, 31), 'row', ["attr" => ["class" => "form-control file-upload-browse btn btn-primary"]]);
        echo "</span>

            </div>

            <div class=\"form-group\">
                ";
        // line 36
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 36, $this->source); })()), "communaute", [], "any", false, false, false, 36), 'label', ["label" => "communaute"]);
        echo "
                ";
        // line 37
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 37, $this->source); })()), "communaute", [], "any", false, false, false, 37), 'widget', ["attr" => ["class" => "form-control"]]);
        echo "
                <span class=\"text-danger\">";
        // line 38
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "communaute", [], "any", false, false, false, 38), 'errors');
        echo "</span>
                
            </div>
            
            
            <div class=\"input-group col-md-6 mt-4\">
                <button class=\"form-control btn btn-primary mr-2\">";
        // line 44
        echo twig_escape_filter($this->env, ((array_key_exists("button_label", $context)) ? (_twig_default_filter((isset($context["button_label"]) || array_key_exists("button_label", $context) ? $context["button_label"] : (function () { throw new RuntimeError('Variable "button_label" does not exist.', 44, $this->source); })()), "Save")) : ("Save")), "html", null, true);
        echo "</button>

            </div>
            

            ";
        // line 49
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 49, $this->source); })()), 'form_end');
        echo "
        </form>


";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "post/_form.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  158 => 49,  150 => 44,  141 => 38,  137 => 37,  133 => 36,  124 => 31,  118 => 27,  114 => 26,  110 => 25,  104 => 22,  100 => 21,  96 => 20,  89 => 16,  85 => 15,  81 => 14,  74 => 10,  70 => 8,  60 => 7,  50 => 53,  48 => 7,  44 => 5,);
    }

    public function getSourceContext()
    {
        return new Source("{# {{ form_start(form) }}
    {{ form_widget(form) }}
    
{{ form_end(form) }} #}


{% block body %}


{{ form_start(form,{'attr':{'novalidate':'novalidate'}}) }}
        <form class=\"forms-sample\">

            <div class=\"form-group\">
                {{ form_label(form.nomUser, 'nomUser', ) }}
                {{ form_widget(form.nomUser, {'attr': {'class': 'form-control','placeholder': 'nomUser'}}) }}
                <span class=\"text-danger\" >{{ form_errors(form.nomUser,{'attr': {'class':'text-danger'}}) }}</span>
            </div>

            <div class=\"form-group\">
                {{ form_label(form.sujet, 'sujet', ) }}
                {{ form_widget(form.sujet, {'attr': {'class': 'form-control','placeholder': 'sujet'}}) }}
                <span class=\"text-danger\" >{{ form_errors(form.sujet,{'attr': {'class':'text-danger'}}) }}</span>
            </div>
            <div class=\"form-group\">
                {{ form_label(form.description, 'description', ) }}
                {{ form_widget(form.description, {'attr': {'class': 'form-control','placeholder': 'description'}}) }}
                <span class=\"text-danger\" >{{ form_errors(form.description,{'attr': {'class':'text-danger'}}) }}</span>
            </div>
            <div class=\"form-group \">
                {# {{ form_label(form.image, 'Image', ) }} #}
                <span class=\"text-danger\" >{{ form_row(form.image,{'attr': {'class': 'form-control file-upload-browse btn btn-primary' }}) }}</span>

            </div>

            <div class=\"form-group\">
                {{ form_label(form.communaute, 'communaute') }}
                {{ form_widget(form.communaute, {'attr': {'class': 'form-control'}}) }}
                <span class=\"text-danger\">{{ form_errors(form.communaute) }}</span>
                
            </div>
            
            
            <div class=\"input-group col-md-6 mt-4\">
                <button class=\"form-control btn btn-primary mr-2\">{{ button_label|default('Save') }}</button>

            </div>
            

            {{ form_end(form) }}
        </form>


{% endblock %} ", "post/_form.html.twig", "C:\\Users\\DELL\\Desktop\\FancyTrade\\templates\\post\\_form.html.twig");
    }
}
