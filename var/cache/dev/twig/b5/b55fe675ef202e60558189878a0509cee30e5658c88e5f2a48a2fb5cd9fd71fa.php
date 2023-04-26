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

/* commentaire/comments.html.twig */
class __TwigTemplate_41ac1be906f9ba9af68fbbaf184b0aa54c5cdca8512a2ba1e709a3f5ad53c38b extends Template
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
        return "front.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "commentaire/comments.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "commentaire/comments.html.twig"));

        $this->parent = $this->loadTemplate("front.html.twig", "commentaire/comments.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "


<section class=\"module\">
          <div class=\"container\">
<div class=\"post\">
                <div class=\"btn btn-default btn-circle\"><a class=\"Comment\"  href=\"";
        // line 10
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_post_front");
        echo "\">All posts</a></div>

<h1> Post Details :  </h1>
                  <div class=\"post-video embed-responsive embed-responsive-16by9\">
                    <img src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . twig_get_attribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 14, $this->source); })()), "image", [], "any", false, false, false, 14))), "html", null, true);
        echo "\" height=\"180\"  class=\"user_pic rounded img-raised\" alt=\"User\">                  </div>
                  <div class=\"post-header font-alt\">
                    <h2 class=\"post-title\"><a href=\"#\"><strong>";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 16, $this->source); })()), "sujet", [], "any", false, false, false, 16), "html", null, true);
        echo "</strong></a></h2>
                    <div class=\"post-meta\">By&nbsp;<a href=\"#\"><strong>";
        // line 17
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 17, $this->source); })()), "nomuser", [], "any", false, false, false, 17), "html", null, true);
        echo "</strong></a>  <strong>";
        ((twig_get_attribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 17, $this->source); })()), "dateP", [], "any", false, false, false, 17)) ? (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 17, $this->source); })()), "dateP", [], "any", false, false, false, 17), "Y-m-d H:i:s"), "html", null, true))) : (print ("")));
        echo "</strong> 
                    </div>
                  </div>
                  <div class=\"post-entry\">
                    <h4>Description: </h4>
                    <p><strong>";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 22, $this->source); })()), "description", [], "any", false, false, false, 22), "html", null, true);
        echo "</strong></p>
                  </div>
                  ";
        // line 25
        echo "                  
                </div>
            <h2>Comment Section: </h2>

            </br>
            <div class=\"row multi-columns-row\">
              <div class=\"col-sm-12\">
                ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 32, $this->source); })()), "commentaires", [], "any", false, false, false, 32));
        foreach ($context['_seq'] as $context["_key"] => $context["var"]) {
            // line 33
            echo "                <div class=\"menu\">
                  <div class=\"row\">
                    <div class=\"col-sm-8\">
                      <h4 class=\"menu-title font-alt\">";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["var"], "descriptionc", [], "any", false, false, false, 36), "html", null, true);
            echo "</h4>
                      <div class=\"menu-detail font-serif\">";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["var"], "nomuser", [], "any", false, false, false, 37), "html", null, true);
            echo "</div>
                    </div>
                    <div class=\"col-sm-4 menu-price-detail\">
                      <h4 class=\"menu-price font-alt\">";
            // line 40
            ((twig_get_attribute($this->env, $this->source, $context["var"], "datec", [], "any", false, false, false, 40)) ? (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["var"], "datec", [], "any", false, false, false, 40), "Y-m-d H:i:s"), "html", null, true))) : (print ("")));
            echo "</h4>

                      <a class=\"form-group\" href=\"";
            // line 42
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_commentaire_editfront", ["id" => twig_get_attribute($this->env, $this->source, $context["var"], "id", [], "any", false, false, false, 42)]), "html", null, true);
            echo "\"> <i class=\"bx bx-edit-alt me-1\"></i>edit</a>
                      <a class=\"btn btn-outline-danger\" href=\"";
            // line 43
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_commentaire_remove", ["id" => twig_get_attribute($this->env, $this->source, $context["var"], "id", [], "any", false, false, false, 43)]), "html", null, true);
            echo "\"><i class=\"fa-solid fa-trash\"></i></i>Delete</a>

                    </div>
                  </div>
                </div>
                

                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['var'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "                <div class=\"btn btn-default btn-circle\"><a class=\"Comment\"  href=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_post_showcomment", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 51, $this->source); })()), "id", [], "any", false, false, false, 51)]), "html", null, true);
        echo "\">Add a comment</a></div>



                
                
              </div>
              
          </div>
        </section>

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "commentaire/comments.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  158 => 51,  144 => 43,  140 => 42,  135 => 40,  129 => 37,  125 => 36,  120 => 33,  116 => 32,  107 => 25,  102 => 22,  92 => 17,  88 => 16,  83 => 14,  76 => 10,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'front.html.twig' %}

{% block body  %}



<section class=\"module\">
          <div class=\"container\">
<div class=\"post\">
                <div class=\"btn btn-default btn-circle\"><a class=\"Comment\"  href=\"{{ path('app_post_front')}}\">All posts</a></div>

<h1> Post Details :  </h1>
                  <div class=\"post-video embed-responsive embed-responsive-16by9\">
                    <img src=\"{{asset('uploads/'~ post.image)}}\" height=\"180\"  class=\"user_pic rounded img-raised\" alt=\"User\">                  </div>
                  <div class=\"post-header font-alt\">
                    <h2 class=\"post-title\"><a href=\"#\"><strong>{{ post.sujet }}</strong></a></h2>
                    <div class=\"post-meta\">By&nbsp;<a href=\"#\"><strong>{{ post.nomuser }}</strong></a>  <strong>{{ post.dateP ? post.dateP|date('Y-m-d H:i:s') : '' }}</strong> 
                    </div>
                  </div>
                  <div class=\"post-entry\">
                    <h4>Description: </h4>
                    <p><strong>{{ post.description }}</strong></p>
                  </div>
                  {# <div class=\"btn btn-default btn-circle\"><a class=\"Comment\"  href=\"{{ path('app_comment_post', {'id': post.id}) }}\">Comment Section</a></div> #}
                  
                </div>
            <h2>Comment Section: </h2>

            </br>
            <div class=\"row multi-columns-row\">
              <div class=\"col-sm-12\">
                {% for var in post.commentaires %}
                <div class=\"menu\">
                  <div class=\"row\">
                    <div class=\"col-sm-8\">
                      <h4 class=\"menu-title font-alt\">{{ var.descriptionc }}</h4>
                      <div class=\"menu-detail font-serif\">{{var.nomuser}}</div>
                    </div>
                    <div class=\"col-sm-4 menu-price-detail\">
                      <h4 class=\"menu-price font-alt\">{{ var.datec ? var.datec|date('Y-m-d H:i:s') : '' }}</h4>

                      <a class=\"form-group\" href=\"{{ path('app_commentaire_editfront', {'id': var.id}) }}\"> <i class=\"bx bx-edit-alt me-1\"></i>edit</a>
                      <a class=\"btn btn-outline-danger\" href=\"{{ path('app_commentaire_remove', {'id': var.id}) }}\"><i class=\"fa-solid fa-trash\"></i></i>Delete</a>

                    </div>
                  </div>
                </div>
                

                {% endfor %}
                <div class=\"btn btn-default btn-circle\"><a class=\"Comment\"  href=\"{{ path('app_post_showcomment', {'id': post.id}) }}\">Add a comment</a></div>



                
                
              </div>
              
          </div>
        </section>

{% endblock %}", "commentaire/comments.html.twig", "C:\\Users\\DELL\\Desktop\\FancyTrade\\FancyTrade\\templates\\commentaire\\comments.html.twig");
    }
}
