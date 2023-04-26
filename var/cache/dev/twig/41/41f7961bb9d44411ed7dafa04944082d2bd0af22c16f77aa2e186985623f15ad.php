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

/* post/addPost.html.twig */
class __TwigTemplate_28ee84ee1673b376d9ce78a8da76c7393058dc312b05fbecf10d6b23c9d81b1d extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'body' => [$this, 'block_body'],
            'js' => [$this, 'block_js'],
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/addPost.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/addPost.html.twig"));

        $this->parent = $this->loadTemplate("front.html.twig", "post/addPost.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 4
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 5
        echo "    <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/apple-icon-57x57.png"), "html", null, true);
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/apple-icon-60x60.png"), "html", null, true);
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/apple-icon-72x72.png"), "html", null, true);
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/apple-icon-76x76.png"), "html", null, true);
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/apple-icon-114x114.png"), "html", null, true);
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/apple-icon-120x120.png"), "html", null, true);
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/apple-icon-144x144.png"), "html", null, true);
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/apple-icon-152x152.png"), "html", null, true);
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/apple-icon-180x180.png"), "html", null, true);
        echo "\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"192x192\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/android-icon-192x192.png"), "html", null, true);
        echo "\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/favicon-32x32.png"), "html", null, true);
        echo "\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/favicon-96x96.png"), "html", null, true);
        echo "\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/images/favicons/favicon-16x16.png"), "html", null, true);
        echo "\">
    <link rel=\"manifest\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("/manifest.json"), "html", null, true);
        echo "\">
    <meta name=\"msapplication-TileColor\" content=\"#ffffff\">
    <meta name=\"msapplication-TileImage\" content=\"../assets/assets/images/favicons/ms-icon-144x144.png') }}\">
    <meta name=\"theme-color\" content=\"#ffffff\">
    <!--  
    Stylesheets
    =============================================
    
    -->
    <!-- Default stylesheets-->
    <link href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/bootstrap/dist/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <!-- Template specific stylesheets-->
    <link href=\"https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css?family=Volkhov:400i\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800\" rel=\"stylesheet\">
    <link href=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/animate.css/animate.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link href=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/components-font-awesome/css/font-awesome.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link href=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/et-line-font/et-line-font.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link href=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/flexslider/flexslider.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link href=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/owl.carousel/dist/assets/owl.carousel.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link href=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link href=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/magnific-popup/dist/magnific-popup.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link href=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/simple-text-rotator/simpletextrotator.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <!-- Main stylesheet and color file-->
    <link href=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/css/style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link id=\"color-scheme\" href=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/css/colors/default.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 48
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 49
        echo "

    <section class=\"module\">
          <div class=\"container\">
            <div class=\"post\">

            
";
        // line 56
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 56, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate"]]);
        echo "
        <form class=\"forms-sample\">

            <div class=\"form-group\">
                ";
        // line 60
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 60, $this->source); })()), "nomUser", [], "any", false, false, false, 60), 'label', ["label" => "nomUser"]);
        echo "
                ";
        // line 61
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 61, $this->source); })()), "nomUser", [], "any", false, false, false, 61), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "nomUser"]]);
        echo "
                <span class=\"text-danger\" >";
        // line 62
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 62, $this->source); })()), "nomUser", [], "any", false, false, false, 62), 'errors', ["attr" => ["class" => "text-danger"]]);
        echo "</span>
            </div>

            <div class=\"form-group\">
                ";
        // line 66
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 66, $this->source); })()), "sujet", [], "any", false, false, false, 66), 'label', ["label" => "sujet"]);
        echo "
                ";
        // line 67
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 67, $this->source); })()), "sujet", [], "any", false, false, false, 67), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "sujet"]]);
        echo "
                <span class=\"text-danger\" >";
        // line 68
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 68, $this->source); })()), "sujet", [], "any", false, false, false, 68), 'errors', ["attr" => ["class" => "text-danger"]]);
        echo "</span>
            </div>
            <div class=\"form-group\">
                ";
        // line 71
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 71, $this->source); })()), "description", [], "any", false, false, false, 71), 'label', ["label" => "description"]);
        echo "
                ";
        // line 72
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 72, $this->source); })()), "description", [], "any", false, false, false, 72), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "description"]]);
        echo "
                <span class=\"text-danger\" >";
        // line 73
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 73, $this->source); })()), "description", [], "any", false, false, false, 73), 'errors', ["attr" => ["class" => "text-danger"]]);
        echo "</span>
            </div>
            <div class=\"form-group \">
                ";
        // line 77
        echo "                <span class=\"text-danger\" >";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 77, $this->source); })()), "image", [], "any", false, false, false, 77), 'row', ["attr" => ["class" => "form-control file-upload-browse btn btn-primary"]]);
        echo "</span>

            </div>

            <div class=\"form-group\">
                ";
        // line 82
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 82, $this->source); })()), "communaute", [], "any", false, false, false, 82), 'label', ["label" => "communaute"]);
        echo "
                ";
        // line 83
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 83, $this->source); })()), "communaute", [], "any", false, false, false, 83), 'widget', ["attr" => ["class" => "form-control"]]);
        echo "
                <span class=\"text-danger\">";
        // line 84
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 84, $this->source); })()), "communaute", [], "any", false, false, false, 84), 'errors');
        echo "</span>
                
            </div>
            
            
            <div class=\"input-group col-md-6 mt-4\">
                <button class=\"form-control btn btn-primary mr-2\">";
        // line 90
        echo twig_escape_filter($this->env, ((array_key_exists("button_label", $context)) ? (_twig_default_filter((isset($context["button_label"]) || array_key_exists("button_label", $context) ? $context["button_label"] : (function () { throw new RuntimeError('Variable "button_label" does not exist.', 90, $this->source); })()), "Save")) : ("Save")), "html", null, true);
        echo "</button>

            </div>
            

            ";
        // line 95
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 95, $this->source); })()), 'form_end');
        echo "
        </form>
            </div>
        </div>
    </section>



    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 112
    public function block_js($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "js"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "js"));

        // line 113
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/jquery/dist/jquery.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 114
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/bootstrap/dist/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 115
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/wow/dist/wow.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 116
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 117
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/isotope/dist/isotope.pkgd.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 118
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/imagesloaded/imagesloaded.pkgd.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 119
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/flexslider/jquery.flexslider.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 120
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/owl.carousel/dist/owl.carousel.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 121
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/smoothscroll.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 122
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/magnific-popup/dist/jquery.magnific-popup.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 123
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 124
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/js/plugins.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 125
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../assets/assets/js/main.js"), "html", null, true);
        echo "\"></script>

    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "post/addPost.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  375 => 125,  371 => 124,  367 => 123,  363 => 122,  359 => 121,  355 => 120,  351 => 119,  347 => 118,  343 => 117,  339 => 116,  335 => 115,  331 => 114,  326 => 113,  316 => 112,  297 => 95,  289 => 90,  280 => 84,  276 => 83,  272 => 82,  263 => 77,  257 => 73,  253 => 72,  249 => 71,  243 => 68,  239 => 67,  235 => 66,  228 => 62,  224 => 61,  220 => 60,  213 => 56,  204 => 49,  194 => 48,  181 => 43,  177 => 42,  172 => 40,  168 => 39,  164 => 38,  160 => 37,  156 => 36,  152 => 35,  148 => 34,  144 => 33,  136 => 28,  123 => 18,  119 => 17,  115 => 16,  111 => 15,  107 => 14,  103 => 13,  99 => 12,  95 => 11,  91 => 10,  87 => 9,  83 => 8,  79 => 7,  75 => 6,  70 => 5,  60 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'front.html.twig' %}


{% block stylesheets %}
    <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"{{ asset('../assets/assets/images/favicons/apple-icon-57x57.png') }}\">
    <link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"{{ asset('../assets/assets/images/favicons/apple-icon-60x60.png') }}\">
    <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"{{ asset('../assets/assets/images/favicons/apple-icon-72x72.png') }}\">
    <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"{{ asset('../assets/assets/images/favicons/apple-icon-76x76.png') }}\">
    <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"{{ asset('../assets/assets/images/favicons/apple-icon-114x114.png') }}\">
    <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"{{ asset('../assets/assets/images/favicons/apple-icon-120x120.png') }}\">
    <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"{{ asset('../assets/assets/images/favicons/apple-icon-144x144.png') }}\">
    <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"{{ asset('../assets/assets/images/favicons/apple-icon-152x152.png') }}\">
    <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"{{ asset('../assets/assets/images/favicons/apple-icon-180x180.png') }}\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"192x192\" href=\"{{ asset('../assets/assets/images/favicons/android-icon-192x192.png') }}\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"{{ asset('../assets/assets/images/favicons/favicon-32x32.png') }}\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"{{ asset('../assets/assets/images/favicons/favicon-96x96.png') }}\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"{{ asset('../assets/assets/images/favicons/favicon-16x16.png') }}\">
    <link rel=\"manifest\" href=\"{{ asset('/manifest.json') }}\">
    <meta name=\"msapplication-TileColor\" content=\"#ffffff\">
    <meta name=\"msapplication-TileImage\" content=\"../assets/assets/images/favicons/ms-icon-144x144.png') }}\">
    <meta name=\"theme-color\" content=\"#ffffff\">
    <!--  
    Stylesheets
    =============================================
    
    -->
    <!-- Default stylesheets-->
    <link href=\"{{ asset('../assets/assets/lib/bootstrap/dist/css/bootstrap.min.css') }}\" rel=\"stylesheet\">
    <!-- Template specific stylesheets-->
    <link href=\"https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css?family=Volkhov:400i\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800\" rel=\"stylesheet\">
    <link href=\"{{ asset('../assets/assets/lib/animate.css/animate.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('../assets/assets/lib/components-font-awesome/css/font-awesome.min.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('../assets/assets/lib/et-line-font/et-line-font.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('../assets/assets/lib/flexslider/flexslider.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('../assets/assets/lib/owl.carousel/dist/assets/owl.carousel.min.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('../assets/assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('../assets/assets/lib/magnific-popup/dist/magnific-popup.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('../assets/assets/lib/simple-text-rotator/simpletextrotator.css') }}\" rel=\"stylesheet\">
    <!-- Main stylesheet and color file-->
    <link href=\"{{ asset('../assets/assets/css/style.css') }}\" rel=\"stylesheet\">
    <link id=\"color-scheme\" href=\"{{ asset('../assets/assets/css/colors/default.css') }}\" rel=\"stylesheet\">

    {% endblock %}


    {% block body  %}


    <section class=\"module\">
          <div class=\"container\">
            <div class=\"post\">

            
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
            </div>
        </div>
    </section>



    {% endblock %}








    {% block js  %}
    <script src=\"{{ asset('../assets/assets/lib/jquery/dist/jquery.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/lib/bootstrap/dist/js/bootstrap.min.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/lib/wow/dist/wow.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/lib/isotope/dist/isotope.pkgd.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/lib/imagesloaded/imagesloaded.pkgd.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/lib/flexslider/jquery.flexslider.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/lib/owl.carousel/dist/owl.carousel.min.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/lib/smoothscroll.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/lib/magnific-popup/dist/jquery.magnific-popup.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/js/plugins.js')}}\"></script>
    <script src=\"{{ asset('../assets/assets/js/main.js')}}\"></script>

    {% endblock %}", "post/addPost.html.twig", "C:\\Users\\DELL\\Desktop\\FancyTrade\\FancyTrade\\templates\\post\\addPost.html.twig");
    }
}
