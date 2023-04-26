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

/* post/index.html.twig */
class __TwigTemplate_0a57c637616700429f675bffa67ca197 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "post/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <h1>Posts</h1>
<div class=\"btn btn-warning btn-circle\"><a class=\"Comment\"  href=\"";
        // line 5
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_post_sujet");
        echo "\">Trier par sujet</a></div>
            <div class=\"btn btn-warning btn-circle\"><a class=\"Comment\"  href=\"";
        // line 6
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_post_date");
        echo "\">Trier par date</a></div>
                <div class=\"card\">
                    <h5 class=\"card-header\">Posts</h5>
                    <div class=\"table-responsive text-nowrap\">
                      <table class=\"table\">
                        <thead>
                          <tr>
                            <th>NomUser</th>
                            <th>Sujet</th>
                            <th>Description</th>
                            <th>NbrJ'aime</th>
                            <th>Image</th>
                            <th>dateP</th>
                            <th>communaute</th>
                            ";
        // line 23
        echo "                          </tr>
                        </thead>
                        <tbody class=\"table-border-bottom-0\">
                            ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 26, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 27
            echo "                          <tr>
                          <td>";
            // line 28
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "nomuser", [], "any", false, false, false, 28), "html", null, true);
            echo "</td>
                            <td><i class=\"fab fa-angular fa-lg text-danger me-3\"></i> <strong>";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "sujet", [], "any", false, false, false, 29), "html", null, true);
            echo "</strong></td>
                            <td>";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "description", [], "any", false, false, false, 30), "html", null, true);
            echo "</td>
                            <td>
                              ";
            // line 32
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "nbrjaime", [], "any", false, false, false, 32), "html", null, true);
            echo "
                            </td>
                            <td><img src=\"";
            // line 34
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . twig_get_attribute($this->env, $this->source, $context["post"], "image", [], "any", false, false, false, 34))), "html", null, true);
            echo "\" height=\"180\"  class=\"user_pic rounded img-raised\" alt=\"User\"> </td>
                            <td><span class=\"badge bg-label-primary me-1\">";
            // line 35
            ((twig_get_attribute($this->env, $this->source, $context["post"], "dateP", [], "any", false, false, false, 35)) ? (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "dateP", [], "any", false, false, false, 35), "Y-m-d H:i:s"), "html", null, true))) : (print ("")));
            echo "</span></td>
                            <td>";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "communaute", [], "any", false, false, false, 36), "html", null, true);
            echo "</td>
                            ";
            // line 41
            echo "
                            

                            <td>
                              <div class=\"dropdown\">
                                <button type=\"button\" class=\"btn p-0 dropdown-toggle hide-arrow\" data-bs-toggle=\"dropdown\">
                                  <i class=\"bx bx-dots-vertical-rounded\"></i>
                                </button>
                                <div class=\"dropdown-menu\">
                                  
                                  <a class=\"dropdown-item\" href=\"";
            // line 51
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_post_showcomments", ["id" => twig_get_attribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 51)]), "html", null, true);
            echo "\"> <i class=\"bx bx-edit-alt me-1\"></i>show Comments</a>
                                  
                                  <a class=\"dropdown-item\" href=\"";
            // line 53
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_post_show", ["id" => twig_get_attribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 53)]), "html", null, true);
            echo "\"><i class=\"bx bx-trash me-1\"></i>  show</a>
                                </div>
                              </div>
                            </td>
                          </tr>

                          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        echo "                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "post/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 60,  151 => 53,  146 => 51,  134 => 41,  130 => 36,  126 => 35,  122 => 34,  117 => 32,  112 => 30,  108 => 29,  104 => 28,  101 => 27,  97 => 26,  92 => 23,  75 => 6,  71 => 5,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <h1>Posts</h1>
<div class=\"btn btn-warning btn-circle\"><a class=\"Comment\"  href=\"{{ path('app_post_sujet') }}\">Trier par sujet</a></div>
            <div class=\"btn btn-warning btn-circle\"><a class=\"Comment\"  href=\"{{ path('app_post_date') }}\">Trier par date</a></div>
                <div class=\"card\">
                    <h5 class=\"card-header\">Posts</h5>
                    <div class=\"table-responsive text-nowrap\">
                      <table class=\"table\">
                        <thead>
                          <tr>
                            <th>NomUser</th>
                            <th>Sujet</th>
                            <th>Description</th>
                            <th>NbrJ'aime</th>
                            <th>Image</th>
                            <th>dateP</th>
                            <th>communaute</th>
                            {# <th>analysePo</th>
                            <th>liked</th>
                            <th>badlevel</th> #}
                          </tr>
                        </thead>
                        <tbody class=\"table-border-bottom-0\">
                            {% for post in posts %}
                          <tr>
                          <td>{{ post.nomuser }}</td>
                            <td><i class=\"fab fa-angular fa-lg text-danger me-3\"></i> <strong>{{ post.sujet }}</strong></td>
                            <td>{{ post.description }}</td>
                            <td>
                              {{ post.nbrjaime}}
                            </td>
                            <td><img src=\"{{asset('uploads/'~ post.image)}}\" height=\"180\"  class=\"user_pic rounded img-raised\" alt=\"User\"> </td>
                            <td><span class=\"badge bg-label-primary me-1\">{{ post.dateP ? post.dateP|date('Y-m-d H:i:s') : '' }}</span></td>
                            <td>{{ post.communaute }}</td>
                            {# <td>{{ post.analysePo }}</td>

                            <td>{{ post.liked }}</td>
                            <td>{{ post.badlevel }}</td> #}

                            

                            <td>
                              <div class=\"dropdown\">
                                <button type=\"button\" class=\"btn p-0 dropdown-toggle hide-arrow\" data-bs-toggle=\"dropdown\">
                                  <i class=\"bx bx-dots-vertical-rounded\"></i>
                                </button>
                                <div class=\"dropdown-menu\">
                                  
                                  <a class=\"dropdown-item\" href=\"{{ path('app_post_showcomments', {'id': post.id}) }}\"> <i class=\"bx bx-edit-alt me-1\"></i>show Comments</a>
                                  
                                  <a class=\"dropdown-item\" href=\"{{ path('app_post_show', {'id': post.id}) }}\"><i class=\"bx bx-trash me-1\"></i>  show</a>
                                </div>
                              </div>
                            </td>
                          </tr>

                          {% endfor %}
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                {% endblock %}", "post/index.html.twig", "C:\\Users\\mehdi\\OneDrive\\Bureau\\FancyTrade\\FancyTrade\\templates\\post\\index.html.twig");
    }
}
