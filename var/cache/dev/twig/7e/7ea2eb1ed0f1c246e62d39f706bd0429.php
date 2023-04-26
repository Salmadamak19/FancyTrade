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

/* post/ajax.html.twig */
class __TwigTemplate_7752aeab7ae56e8c6376e08782068709 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/ajax.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/ajax.html.twig"));

        // line 1
        echo "
";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 2, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 3
            echo "                <div class=\"post\">
                  <div class=\"post-video embed-responsive embed-responsive-16by9\">
                <img src=\"";
            // line 5
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . twig_get_attribute($this->env, $this->source, $context["post"], "image", [], "any", false, false, false, 5))), "html", null, true);
            echo "\" height=\"180\"  class=\"user_pic rounded img-raised\" alt=\"User\">                  </div>
                  <div class=\"post-header font-alt\">
                    <h2 class=\"post-title\"><a href=\"#\"><strong>";
            // line 7
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "sujet", [], "any", false, false, false, 7), "html", null, true);
            echo "</strong></a></h2>
                    <div class=\"post-meta\">By&nbsp;<a href=\"#\"><strong>";
            // line 8
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "nomuser", [], "any", false, false, false, 8), "html", null, true);
            echo "</strong></a>  <strong>";
            ((twig_get_attribute($this->env, $this->source, $context["post"], "dateP", [], "any", false, false, false, 8)) ? (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "dateP", [], "any", false, false, false, 8), "Y-m-d H:i:s"), "html", null, true))) : (print ("")));
            echo "</strong>  
                    <div style=\"margin-left:600px;\" > 
                    <a class=\"btn btn-primary\" href=\"";
            // line 10
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_post_editfront", ["id" => twig_get_attribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 10)]), "html", null, true);
            echo "\">Edit Post</a> 
                    ";
            // line 11
            echo twig_include($this->env, $context, "post/_delete_form.html.twig");
            echo "
                    </div>
                    ";
            // line 15
            echo "
                    </div>
                  </div>
                  <div class=\"post-entry\">
                    <h4>Description: </h4>
                    <p><strong>";
            // line 20
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "description", [], "any", false, false, false, 20), "html", null, true);
            echo "</strong></p>
                  </div>
                  <div class=\"btn btn-default btn-circle\" ><a class=\"Comment\"  href=\"";
            // line 22
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_comment_post", ["id" => twig_get_attribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 22)]), "html", null, true);
            echo "\">Comment Section</a></div>
                  
                </div>
                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "post/ajax.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 22,  99 => 20,  92 => 15,  87 => 11,  83 => 10,  76 => 8,  72 => 7,  67 => 5,  63 => 3,  46 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
{% for post in posts %}
                <div class=\"post\">
                  <div class=\"post-video embed-responsive embed-responsive-16by9\">
                <img src=\"{{asset('uploads/'~ post.image)}}\" height=\"180\"  class=\"user_pic rounded img-raised\" alt=\"User\">                  </div>
                  <div class=\"post-header font-alt\">
                    <h2 class=\"post-title\"><a href=\"#\"><strong>{{ post.sujet }}</strong></a></h2>
                    <div class=\"post-meta\">By&nbsp;<a href=\"#\"><strong>{{ post.nomuser }}</strong></a>  <strong>{{ post.dateP ? post.dateP|date('Y-m-d H:i:s') : '' }}</strong>  
                    <div style=\"margin-left:600px;\" > 
                    <a class=\"btn btn-primary\" href=\"{{ path('app_post_editfront', {'id': post.id}) }}\">Edit Post</a> 
                    {{ include('post/_delete_form.html.twig') }}
                    </div>
                    {# <a class=\"form-group\" href=\"{{ path('app_commentaire_editfront', {'id': var.id}) }}\"> <i class=\"bx bx-edit-alt me-1\"></i>edit</a>
                      <a class=\"btn btn-outline-danger\" href=\"{{ path('app_commentaire_remove', {'id': var.id}) }}\"><i class=\"fa-solid fa-trash\"></i></i>Delete</a> #}

                    </div>
                  </div>
                  <div class=\"post-entry\">
                    <h4>Description: </h4>
                    <p><strong>{{ post.description }}</strong></p>
                  </div>
                  <div class=\"btn btn-default btn-circle\" ><a class=\"Comment\"  href=\"{{ path('app_comment_post', {'id': post.id}) }}\">Comment Section</a></div>
                  
                </div>
                {% endfor %}", "post/ajax.html.twig", "C:\\Users\\mehdi\\OneDrive\\Bureau\\FancyTrade\\FancyTrade\\templates\\post\\ajax.html.twig");
    }
}
