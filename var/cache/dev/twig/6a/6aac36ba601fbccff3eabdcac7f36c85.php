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

/* commentaire/showcomments.html.twig */
class __TwigTemplate_4f07eb77e0904e0d4df61b00e202c3a6 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "commentaire/showcomments.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "commentaire/showcomments.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "commentaire/showcomments.html.twig", 1);
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

        echo "Edit Commentaire";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 4
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 5
        echo "
<link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/img/favicon/favicon.ico"), "html", null, true);
        echo "\" />

    <!-- Fonts -->
    <link rel=\"preconnect\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("https://fonts.googleapis.com"), "html", null, true);
        echo "\" />
    <link rel=\"preconnect\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("https://fonts.gstatic.com"), "html", null, true);
        echo "\" crossorigin />
    <link
      href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"), "html", null, true);
        echo "\"
      rel=\"stylesheet\"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/vendor/fonts/boxicons.css"), "html", null, true);
        echo "\" />

    <!-- Core CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/vendor/css/core.css"), "html", null, true);
        echo "\" class=\"template-customizer-core-css\" />
    <link rel=\"stylesheet\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/vendor/css/theme-default.css"), "html", null, true);
        echo "\" class=\"template-customizer-theme-css\" />
    <link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/css/demo.css"), "html", null, true);
        echo "\" />

    <!-- Vendors CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"), "html", null, true);
        echo "\" />

    <link rel=\"stylesheet\" href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/vendor/libs/apex-charts/apex-charts.css"), "html", null, true);
        echo "\" />

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 32
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 33
        echo "    <h1>Commentaires</h1>
    <div class=\"card\">
                    <h5 class=\"card-header\">Comments</h5>
                    <div class=\"table-responsive text-nowrap\">
    <table class=\"table\">
        <thead>
            <tr>
                <th>Nomuser</th>
                <th>Descriptionc</th>
                <th>Datec</th>
                ";
        // line 45
        echo "                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 49, $this->source); })()), "commentaires", [], "any", false, false, false, 49));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["var"]) {
            // line 50
            echo "            <tr>
                <td>";
            // line 51
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["var"], "nomuser", [], "any", false, false, false, 51), "html", null, true);
            echo "</td>
                <td>";
            // line 52
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["var"], "descriptionc", [], "any", false, false, false, 52), "html", null, true);
            echo "</td>
                <td>";
            // line 53
            ((twig_get_attribute($this->env, $this->source, $context["var"], "datec", [], "any", false, false, false, 53)) ? (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["var"], "datec", [], "any", false, false, false, 53), "Y-m-d H:i:s"), "html", null, true))) : (print ("")));
            echo "</td>
                ";
            // line 56
            echo "                ";
            // line 60
            echo "
                <td>
                                
                                  
                                  <a href=\"";
            // line 64
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_commentaire_edit", ["id" => twig_get_attribute($this->env, $this->source, $context["var"], "id", [], "any", false, false, false, 64)]), "html", null, true);
            echo "\"> <i class=\"bx bx-edit-alt me-1\"></i>edit</a>
                                  
                                  <a href=\"";
            // line 66
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_commentaire_show", ["id" => twig_get_attribute($this->env, $this->source, $context["var"], "id", [], "any", false, false, false, 66)]), "html", null, true);
            echo "\"><i class=\"bx bx-trash me-1\"></i>  show</a>
                                
                            </td>
            </tr>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 71
            echo "            <tr>
                <td colspan=\"8\">Pas de commentaires pour ce poste</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['var'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "        </tbody>
    </table>
    </div>
                  </div>

    <a href=\"";
        // line 80
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_commentaire_new");
        echo "\" class=\" btn bt-primary \">Create new</a>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "commentaire/showcomments.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  240 => 80,  233 => 75,  224 => 71,  214 => 66,  209 => 64,  203 => 60,  201 => 56,  197 => 53,  193 => 52,  189 => 51,  186 => 50,  181 => 49,  175 => 45,  163 => 33,  153 => 32,  140 => 27,  135 => 25,  129 => 22,  125 => 21,  121 => 20,  115 => 17,  107 => 12,  102 => 10,  98 => 9,  92 => 6,  89 => 5,  79 => 4,  60 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Edit Commentaire{% endblock %}
{% block stylesheets %}

<link rel=\"icon\" type=\"image/x-icon\" href=\"{{asset('../assets/img/favicon/favicon.ico')}}\" />

    <!-- Fonts -->
    <link rel=\"preconnect\" href=\"{{asset('https://fonts.googleapis.com')}}\" />
    <link rel=\"preconnect\" href=\"{{asset('https://fonts.gstatic.com')}}\" crossorigin />
    <link
      href=\"{{asset('https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap')}}\"
      rel=\"stylesheet\"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel=\"stylesheet\" href=\"{{asset('../assets/vendor/fonts/boxicons.css')}}\" />

    <!-- Core CSS -->
    <link rel=\"stylesheet\" href=\"{{asset('../assets/vendor/css/core.css')}}\" class=\"template-customizer-core-css\" />
    <link rel=\"stylesheet\" href=\"{{asset('../assets/vendor/css/theme-default.css')}}\" class=\"template-customizer-theme-css\" />
    <link rel=\"stylesheet\" href=\"{{asset('../assets/css/demo.css')}}\" />

    <!-- Vendors CSS -->
    <link rel=\"stylesheet\" href=\"{{asset('../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}\" />

    <link rel=\"stylesheet\" href=\"{{asset('../assets/vendor/libs/apex-charts/apex-charts.css')}}\" />

{% endblock %}


{% block body %}
    <h1>Commentaires</h1>
    <div class=\"card\">
                    <h5 class=\"card-header\">Comments</h5>
                    <div class=\"table-responsive text-nowrap\">
    <table class=\"table\">
        <thead>
            <tr>
                <th>Nomuser</th>
                <th>Descriptionc</th>
                <th>Datec</th>
                {# <th>AnalyseCo</th>
                <th>DatecTs</th> #}
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        {% for var in post.commentaires %}
            <tr>
                <td>{{ var.nomuser }}</td>
                <td>{{ var.descriptionc }}</td>
                <td>{{ var.datec ? var.datec|date('Y-m-d H:i:s') : '' }}</td>
                {# <td>{{ commentaire.analyseCo }}</td>
                <td>{{ commentaire.datecTs ? commentaire.datecTs|date('Y-m-d H:i:s') : '' }}</td> #}
                {# <td>
                    <a href=\"{{ path('app_commentaire_show', {'id': commentaire.id}) }}\">show</a>
                    <a href=\"{{ path('app_commentaire_edit', {'id': commentaire.id}) }}\">edit</a>
                </td> #}

                <td>
                                
                                  
                                  <a href=\"{{ path('app_commentaire_edit', {'id': var.id}) }}\"> <i class=\"bx bx-edit-alt me-1\"></i>edit</a>
                                  
                                  <a href=\"{{ path('app_commentaire_show', {'id': var.id}) }}\"><i class=\"bx bx-trash me-1\"></i>  show</a>
                                
                            </td>
            </tr>
        {% else %}
            <tr>
                <td colspan=\"8\">Pas de commentaires pour ce poste</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
    </div>
                  </div>

    <a href=\"{{ path('app_commentaire_new') }}\" class=\" btn bt-primary \">Create new</a>
{% endblock %}
", "commentaire/showcomments.html.twig", "C:\\Users\\mehdi\\OneDrive\\Bureau\\FancyTrade\\FancyTrade\\templates\\commentaire\\showcomments.html.twig");
    }
}
