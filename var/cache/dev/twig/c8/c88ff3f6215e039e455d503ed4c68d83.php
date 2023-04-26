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

/* commentaire/index.html.twig */
class __TwigTemplate_07ac6dc36901e7f10461ce7865ac3f92 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "commentaire/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "commentaire/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "commentaire/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Commentaire index";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "    <h1>Commentaires</h1>
    <div class=\"card\">
                    <h5 class=\"card-header\">Comments</h5>
                    <div class=\"table-responsive text-nowrap\">
    <table class=\"table\">
        <thead>
            <tr>
                <th>Nomuser</th>
                <th>Post_Id</th>
                <th>Descriptionc</th>
                <th>Datec</th>
                ";
        // line 19
        echo "                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["commentaires"]) || array_key_exists("commentaires", $context) ? $context["commentaires"] : (function () { throw new RuntimeError('Variable "commentaires" does not exist.', 23, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["commentaire"]) {
            // line 24
            echo "            <tr>
                <td>";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["commentaire"], "nomuser", [], "any", false, false, false, 25), "html", null, true);
            echo "</td>
                <td>";
            // line 26
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["commentaire"], "post", [], "any", false, false, false, 26), "id", [], "any", false, false, false, 26), "html", null, true);
            echo "</td>
                <td>";
            // line 27
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["commentaire"], "descriptionc", [], "any", false, false, false, 27), "html", null, true);
            echo "</td>
                <td>";
            // line 28
            ((twig_get_attribute($this->env, $this->source, $context["commentaire"], "datec", [], "any", false, false, false, 28)) ? (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["commentaire"], "datec", [], "any", false, false, false, 28), "Y-m-d H:i:s"), "html", null, true))) : (print ("")));
            echo "</td>
                ";
            // line 31
            echo "                ";
            // line 35
            echo "
                <td>
                              <div class=\"dropdown\">
                                <button type=\"button\" class=\"btn p-0 dropdown-toggle hide-arrow\" data-bs-toggle=\"dropdown\">
                                  <i class=\"bx bx-dots-vertical-rounded\"></i>
                                </button>
                                <div class=\"dropdown-menu\">
                                  
                                  <a class=\"dropdown-item\" href=\"";
            // line 43
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_commentaire_edit", ["id" => twig_get_attribute($this->env, $this->source, $context["commentaire"], "id", [], "any", false, false, false, 43)]), "html", null, true);
            echo "\"> <i class=\"bx bx-edit-alt me-1\"></i>edit</a>
                                  
                                  <a class=\"dropdown-item\" href=\"";
            // line 45
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_commentaire_show", ["id" => twig_get_attribute($this->env, $this->source, $context["commentaire"], "id", [], "any", false, false, false, 45)]), "html", null, true);
            echo "\"><i class=\"bx bx-trash me-1\"></i>  show</a>
                                </div>
                              </div>
                            </td>
            </tr>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 51
            echo "            <tr>
                <td colspan=\"8\">no records found</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['commentaire'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "        </tbody>
    </table>
    </div>
                  </div>

    <a href=\"";
        // line 60
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_commentaire_new");
        echo "\" class=\" btn bt-primary \">Create new</a>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "commentaire/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 60,  168 => 55,  159 => 51,  148 => 45,  143 => 43,  133 => 35,  131 => 31,  127 => 28,  123 => 27,  119 => 26,  115 => 25,  112 => 24,  107 => 23,  101 => 19,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Commentaire index{% endblock %}

{% block body %}
    <h1>Commentaires</h1>
    <div class=\"card\">
                    <h5 class=\"card-header\">Comments</h5>
                    <div class=\"table-responsive text-nowrap\">
    <table class=\"table\">
        <thead>
            <tr>
                <th>Nomuser</th>
                <th>Post_Id</th>
                <th>Descriptionc</th>
                <th>Datec</th>
                {# <th>AnalyseCo</th>
                <th>DatecTs</th> #}
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        {% for commentaire in commentaires %}
            <tr>
                <td>{{ commentaire.nomuser }}</td>
                <td>{{ commentaire.post.id }}</td>
                <td>{{ commentaire.descriptionc }}</td>
                <td>{{ commentaire.datec ? commentaire.datec|date('Y-m-d H:i:s') : '' }}</td>
                {# <td>{{ commentaire.analyseCo }}</td>
                <td>{{ commentaire.datecTs ? commentaire.datecTs|date('Y-m-d H:i:s') : '' }}</td> #}
                {# <td>
                    <a href=\"{{ path('app_commentaire_show', {'id': commentaire.id}) }}\">show</a>
                    <a href=\"{{ path('app_commentaire_edit', {'id': commentaire.id}) }}\">edit</a>
                </td> #}

                <td>
                              <div class=\"dropdown\">
                                <button type=\"button\" class=\"btn p-0 dropdown-toggle hide-arrow\" data-bs-toggle=\"dropdown\">
                                  <i class=\"bx bx-dots-vertical-rounded\"></i>
                                </button>
                                <div class=\"dropdown-menu\">
                                  
                                  <a class=\"dropdown-item\" href=\"{{ path('app_commentaire_edit', {'id': commentaire.id}) }}\"> <i class=\"bx bx-edit-alt me-1\"></i>edit</a>
                                  
                                  <a class=\"dropdown-item\" href=\"{{ path('app_commentaire_show', {'id': commentaire.id}) }}\"><i class=\"bx bx-trash me-1\"></i>  show</a>
                                </div>
                              </div>
                            </td>
            </tr>
        {% else %}
            <tr>
                <td colspan=\"8\">no records found</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
    </div>
                  </div>

    <a href=\"{{ path('app_commentaire_new') }}\" class=\" btn bt-primary \">Create new</a>
{% endblock %}
", "commentaire/index.html.twig", "C:\\Users\\mehdi\\OneDrive\\Bureau\\FancyTrade\\FancyTrade\\templates\\commentaire\\index.html.twig");
    }
}
