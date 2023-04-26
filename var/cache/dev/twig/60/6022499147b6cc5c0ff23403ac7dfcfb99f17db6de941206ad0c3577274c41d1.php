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

/* post/post.html.twig */
class __TwigTemplate_3e59c479296820d466636a11d43ce240d63e8c12ac999a42e154f38494bba0c1 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/post.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/post.html.twig"));

        $this->parent = $this->loadTemplate("front.html.twig", "post/post.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "

        <section class=\"module\">
          <div class=\"container\">
          ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 10, $this->source); })()), "flashes", [0 => "success"], "method", false, false, false, 10));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 11
            echo "              <div class=\"alert alert-success\"  id=\"flash-message\">";
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "</div>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "          ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 13, $this->source); })()), "flashes", [0 => "danger"], "method", false, false, false, 13));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 14
            echo "              <div class=\"alert alert-danger\"  id=\"flash-message\">";
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "</div>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "<script>
    // Set a timer to hide the flash message after 3 seconds
    setTimeout(function() {
        var flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.display = 'none';
        }
    }, 3000);
</script>

            <div class=\"btn btn-info btn-circle\"><a class=\"Comment\"  href=\"";
        // line 26
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_postfront_new");
        echo "\">Add New Post</a></div>
            


            <div class=\"row\">
            <form action=\"#\" class=\"nk-form nk-form-style-1\" style=\"margin-top:10px;margin-bottom:20px; margin-left:630px;\" novalidate=\"novalidate\">
                        <div class=\"input-group\">
                            <input type=\"text\" class=\"form-control\" placeholder=\"Search for post\" id=\"search\">

                        </div>
                    </form>
              <div class=\"col-sm-8\">
                
                <div  id=\"all\">
                    ";
        // line 40
        $this->loadTemplate("post/ajax.html.twig", "post/post.html.twig", 40)->display($context);
        // line 41
        echo "                </div>
                <div class=\"row vertical-gap\" id=\"search\">
                </div>
                
                
                
                <div class=\"pagination font-alt\"><a href=\"#\"><i class=\"fa fa-angle-left\"></i></a><a class=\"active\" href=\"#\">1</a><a href=\"#\">2</a><a href=\"#\">3</a><a href=\"#\">4</a><a href=\"#\"><i class=\"fa fa-angle-right\"></i></a></div>
              </div>
              <div class=\"col-sm-4 col-md-3 col-md-offset-1 sidebar\">
                <div class=\"widget\">
                  
                  

                  
                  
                </div>
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Blog Categories</h5>
                  <ul class=\"icon-list\">
                    <li><a href=\"#\">Photography - 7</a></li>
                    <li><a href=\"#\">Web Design - 3</a></li>
                    <li><a href=\"#\">Illustration - 12</a></li>
                    <li><a href=\"#\">Marketing - 1</a></li>
                    <li><a href=\"#\">Wordpress - 16</a></li>
                  </ul>
                </div>
                
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Popular Posts</h5>
                  <ul class=\"widget-posts\">
                  ";
        // line 71
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 71, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 72
            echo "                    <li class=\"clearfix\">
                      <div class=\"widget-posts-image\"><a href=\"#\"><img src=\"";
            // line 73
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . twig_get_attribute($this->env, $this->source, $context["post"], "image", [], "any", false, false, false, 73))), "html", null, true);
            echo "\" height=\"180\"  class=\"user_pic rounded img-raised\" alt=\"User\">     </a></div>
                      <div class=\"widget-posts-body\">
                        <div class=\"widget-posts-title\"><a href=\"#\">";
            // line 75
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "sujet", [], "any", false, false, false, 75), "html", null, true);
            echo "</a></div>
                        <div class=\"widget-posts-meta\">";
            // line 76
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "description", [], "any", false, false, false, 76), "html", null, true);
            echo "</div>
                      </div>
                    </li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "                  </ul>
                </div>


                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Tag</h5>
                  <div class=\"tags font-serif\"><a href=\"#\" rel=\"tag\">Blog</a><a href=\"#\" rel=\"tag\">Photo</a><a href=\"#\" rel=\"tag\">Video</a><a href=\"#\" rel=\"tag\">Image</a><a href=\"#\" rel=\"tag\">Minimal</a><a href=\"#\" rel=\"tag\">Post</a><a href=\"#\" rel=\"tag\">Theme</a><a href=\"#\" rel=\"tag\">Ideas</a><a href=\"#\" rel=\"tag\">Tags</a><a href=\"#\" rel=\"tag\">Bootstrap</a><a href=\"#\" rel=\"tag\">Popular</a><a href=\"#\" rel=\"tag\">English</a>
                  </div>
                </div>
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Text</h5>The languages only differ in their grammar, their pronunciation and their most common words. Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators.
                </div>
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Recent Comments</h5>
                  <ul class=\"icon-list\">
                    <li>Maria on <a href=\"#\">Designer Desk Essentials</a></li>
                    <li>John on <a href=\"#\">Realistic Business Card Mockup</a></li>
                    <li>Andy on <a href=\"#\">Eco bag Mockup</a></li>
                    <li>Jack on <a href=\"#\">Bottle Mockup</a></li>
                    <li>Mark on <a href=\"#\">Our trip to the Alps</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class=\"module-small bg-dark\">
          <div class=\"container\">
            <div class=\"row\">
              <div class=\"col-sm-3\">
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">About Titan</h5>
                  <p>The languages only differ in their grammar, their pronunciation and their most common words.</p>
                  <p>Phone: +1 234 567 89 10</p>Fax: +1 234 567 89 10
                  <p>Email:<a href=\"#\">somecompany@example.com</a></p>
                </div>
              </div>
              <div class=\"col-sm-3\">
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Recent Comments</h5>
                  <ul class=\"icon-list\">
                    <li>Maria on <a href=\"#\">Designer Desk Essentials</a></li>
                    <li>John on <a href=\"#\">Realistic Business Card Mockup</a></li>
                    <li>Andy on <a href=\"#\">Eco bag Mockup</a></li>
                    <li>Jack on <a href=\"#\">Bottle Mockup</a></li>
                    <li>Mark on <a href=\"#\">Our trip to the Alps</a></li>
                  </ul>
                </div>
              </div>
              <div class=\"col-sm-3\">
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Blog Categories</h5>
                  <ul class=\"icon-list\">
                    <li><a href=\"#\">Photography - 7</a></li>
                    <li><a href=\"#\">Web Design - 3</a></li>
                    <li><a href=\"#\">Illustration - 12</a></li>
                    <li><a href=\"#\">Marketing - 1</a></li>
                    <li><a href=\"#\">Wordpress - 16</a></li>
                  </ul>
                </div>
              </div>
              <div class=\"col-sm-3\">
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Popular Posts</h5>
                  <ul class=\"widget-posts\">
                    <li class=\"clearfix\">
                      <div class=\"widget-posts-image\"><a href=\"#\"><img src=\"assets/images/rp-1.jpg\" alt=\"Post Thumbnail\"/></a></div>
                      <div class=\"widget-posts-body\">
                        <div class=\"widget-posts-title\"><a href=\"#\">Designer Desk Essentials</a></div>
                        <div class=\"widget-posts-meta\">23 january</div>
                      </div>
                    </li>
                    <li class=\"clearfix\">
                      <div class=\"widget-posts-image\"><a href=\"#\"><img src=\"assets/images/rp-2.jpg\" alt=\"Post Thumbnail\"/></a></div>
                      <div class=\"widget-posts-body\">
                        <div class=\"widget-posts-title\"><a href=\"#\">Realistic Business Card Mockup</a></div>
                        <div class=\"widget-posts-meta\">15 February</div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>




        <script
            src=\"";
        // line 170
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"), "html", null, true);
        echo "\">
    </script>

    <script>
        \$( document ).ready(function() {
            var currentRequest = null;
            \$(\"#search\").keyup(function(e){
                /* La variable value va prendre la valeur insérer dans le champ de texte
                afin d’effectuer la recherche */
                var value = \$(this).val();
                if(currentRequest != null) {
                    currentRequest.abort();
                }
                /* Ajax est lancé lors du remplissage du champ texte dont l’id est
                « search » pour faire la recherche */
                currentRequest = \$.ajax({
                    url : \"";
        // line 186
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_searchpost");
        echo "\",
                    type : 'GET',
                    data: {
                        'searchValue' : value
                    },
                    success : function(retour)
                    {
                        \$('#all').html(retour);
                    },
                });
                return false;
            });
        });
    </script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "post/post.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  301 => 186,  282 => 170,  190 => 80,  180 => 76,  176 => 75,  171 => 73,  168 => 72,  164 => 71,  132 => 41,  130 => 40,  113 => 26,  101 => 16,  92 => 14,  87 => 13,  78 => 11,  74 => 10,  68 => 6,  58 => 5,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'front.html.twig' %}



{% block body %}


        <section class=\"module\">
          <div class=\"container\">
          {% for message in app.flashes('success') %}
              <div class=\"alert alert-success\"  id=\"flash-message\">{{ message }}</div>
          {% endfor %}
          {% for message in app.flashes('danger') %}
              <div class=\"alert alert-danger\"  id=\"flash-message\">{{ message }}</div>
          {% endfor %}
<script>
    // Set a timer to hide the flash message after 3 seconds
    setTimeout(function() {
        var flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.display = 'none';
        }
    }, 3000);
</script>

            <div class=\"btn btn-info btn-circle\"><a class=\"Comment\"  href=\"{{ path('app_postfront_new') }}\">Add New Post</a></div>
            


            <div class=\"row\">
            <form action=\"#\" class=\"nk-form nk-form-style-1\" style=\"margin-top:10px;margin-bottom:20px; margin-left:630px;\" novalidate=\"novalidate\">
                        <div class=\"input-group\">
                            <input type=\"text\" class=\"form-control\" placeholder=\"Search for post\" id=\"search\">

                        </div>
                    </form>
              <div class=\"col-sm-8\">
                
                <div  id=\"all\">
                    {% include 'post/ajax.html.twig' %}
                </div>
                <div class=\"row vertical-gap\" id=\"search\">
                </div>
                
                
                
                <div class=\"pagination font-alt\"><a href=\"#\"><i class=\"fa fa-angle-left\"></i></a><a class=\"active\" href=\"#\">1</a><a href=\"#\">2</a><a href=\"#\">3</a><a href=\"#\">4</a><a href=\"#\"><i class=\"fa fa-angle-right\"></i></a></div>
              </div>
              <div class=\"col-sm-4 col-md-3 col-md-offset-1 sidebar\">
                <div class=\"widget\">
                  
                  

                  
                  
                </div>
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Blog Categories</h5>
                  <ul class=\"icon-list\">
                    <li><a href=\"#\">Photography - 7</a></li>
                    <li><a href=\"#\">Web Design - 3</a></li>
                    <li><a href=\"#\">Illustration - 12</a></li>
                    <li><a href=\"#\">Marketing - 1</a></li>
                    <li><a href=\"#\">Wordpress - 16</a></li>
                  </ul>
                </div>
                
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Popular Posts</h5>
                  <ul class=\"widget-posts\">
                  {% for post in posts %}
                    <li class=\"clearfix\">
                      <div class=\"widget-posts-image\"><a href=\"#\"><img src=\"{{asset('uploads/'~ post.image)}}\" height=\"180\"  class=\"user_pic rounded img-raised\" alt=\"User\">     </a></div>
                      <div class=\"widget-posts-body\">
                        <div class=\"widget-posts-title\"><a href=\"#\">{{ post.sujet }}</a></div>
                        <div class=\"widget-posts-meta\">{{ post.description }}</div>
                      </div>
                    </li>
                    {% endfor %}
                  </ul>
                </div>


                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Tag</h5>
                  <div class=\"tags font-serif\"><a href=\"#\" rel=\"tag\">Blog</a><a href=\"#\" rel=\"tag\">Photo</a><a href=\"#\" rel=\"tag\">Video</a><a href=\"#\" rel=\"tag\">Image</a><a href=\"#\" rel=\"tag\">Minimal</a><a href=\"#\" rel=\"tag\">Post</a><a href=\"#\" rel=\"tag\">Theme</a><a href=\"#\" rel=\"tag\">Ideas</a><a href=\"#\" rel=\"tag\">Tags</a><a href=\"#\" rel=\"tag\">Bootstrap</a><a href=\"#\" rel=\"tag\">Popular</a><a href=\"#\" rel=\"tag\">English</a>
                  </div>
                </div>
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Text</h5>The languages only differ in their grammar, their pronunciation and their most common words. Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators.
                </div>
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Recent Comments</h5>
                  <ul class=\"icon-list\">
                    <li>Maria on <a href=\"#\">Designer Desk Essentials</a></li>
                    <li>John on <a href=\"#\">Realistic Business Card Mockup</a></li>
                    <li>Andy on <a href=\"#\">Eco bag Mockup</a></li>
                    <li>Jack on <a href=\"#\">Bottle Mockup</a></li>
                    <li>Mark on <a href=\"#\">Our trip to the Alps</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class=\"module-small bg-dark\">
          <div class=\"container\">
            <div class=\"row\">
              <div class=\"col-sm-3\">
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">About Titan</h5>
                  <p>The languages only differ in their grammar, their pronunciation and their most common words.</p>
                  <p>Phone: +1 234 567 89 10</p>Fax: +1 234 567 89 10
                  <p>Email:<a href=\"#\">somecompany@example.com</a></p>
                </div>
              </div>
              <div class=\"col-sm-3\">
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Recent Comments</h5>
                  <ul class=\"icon-list\">
                    <li>Maria on <a href=\"#\">Designer Desk Essentials</a></li>
                    <li>John on <a href=\"#\">Realistic Business Card Mockup</a></li>
                    <li>Andy on <a href=\"#\">Eco bag Mockup</a></li>
                    <li>Jack on <a href=\"#\">Bottle Mockup</a></li>
                    <li>Mark on <a href=\"#\">Our trip to the Alps</a></li>
                  </ul>
                </div>
              </div>
              <div class=\"col-sm-3\">
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Blog Categories</h5>
                  <ul class=\"icon-list\">
                    <li><a href=\"#\">Photography - 7</a></li>
                    <li><a href=\"#\">Web Design - 3</a></li>
                    <li><a href=\"#\">Illustration - 12</a></li>
                    <li><a href=\"#\">Marketing - 1</a></li>
                    <li><a href=\"#\">Wordpress - 16</a></li>
                  </ul>
                </div>
              </div>
              <div class=\"col-sm-3\">
                <div class=\"widget\">
                  <h5 class=\"widget-title font-alt\">Popular Posts</h5>
                  <ul class=\"widget-posts\">
                    <li class=\"clearfix\">
                      <div class=\"widget-posts-image\"><a href=\"#\"><img src=\"assets/images/rp-1.jpg\" alt=\"Post Thumbnail\"/></a></div>
                      <div class=\"widget-posts-body\">
                        <div class=\"widget-posts-title\"><a href=\"#\">Designer Desk Essentials</a></div>
                        <div class=\"widget-posts-meta\">23 january</div>
                      </div>
                    </li>
                    <li class=\"clearfix\">
                      <div class=\"widget-posts-image\"><a href=\"#\"><img src=\"assets/images/rp-2.jpg\" alt=\"Post Thumbnail\"/></a></div>
                      <div class=\"widget-posts-body\">
                        <div class=\"widget-posts-title\"><a href=\"#\">Realistic Business Card Mockup</a></div>
                        <div class=\"widget-posts-meta\">15 February</div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>




        <script
            src=\"{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}\">
    </script>

    <script>
        \$( document ).ready(function() {
            var currentRequest = null;
            \$(\"#search\").keyup(function(e){
                /* La variable value va prendre la valeur insérer dans le champ de texte
                afin d’effectuer la recherche */
                var value = \$(this).val();
                if(currentRequest != null) {
                    currentRequest.abort();
                }
                /* Ajax est lancé lors du remplissage du champ texte dont l’id est
                « search » pour faire la recherche */
                currentRequest = \$.ajax({
                    url : \"{{ path('app_searchpost') }}\",
                    type : 'GET',
                    data: {
                        'searchValue' : value
                    },
                    success : function(retour)
                    {
                        \$('#all').html(retour);
                    },
                });
                return false;
            });
        });
    </script>
{% endblock %}



", "post/post.html.twig", "C:\\Users\\DELL\\Desktop\\FancyTrade\\FancyTrade\\templates\\post\\post.html.twig");
    }
}
