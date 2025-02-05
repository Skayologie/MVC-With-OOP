<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* front/article.twig */
class __TwigTemplate_f2c9228c4c1ab64078b6aacbf76ae790 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield "</title>
</head>
<body>
";
        // line 9
        if (($context["msg"] ?? null)) {
            // line 10
            yield "hello
";
        }
        // line 12
        yield "
<a href=\"/\">Back To Home</a><br>
";
        // line 14
        if (($context["isAuth"] ?? null)) {
        } else {
            // line 16
            yield "    <a href=\"/login\">login</a><br>
    <a href=\"/register\">Create An Account</a><br>
";
        }
        // line 19
        yield "

";
        // line 21
        if (($context["isAuth"] ?? null)) {
            // line 22
            yield "    <h1>Here your can add an article </h1>
    ";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["msg"] ?? null), "msg", [], "any", false, false, false, 23), "html", null, true);
            yield "
    <form method=\"post\" action=\"article\">
        <label>Title</label>
        <input name=\"title\" type=\"text\" placeholder=\"Enter the article Product\"/>
        <br>
        <label>Description</label>
        <textarea name=\"description\" ></textarea>
        <br>
        <label>Category</label>
        <input name=\"categorie\"  type=\"text\" placeholder=\"Enter the article Product\"/>
        <br>
        <button name=\"submit\" type=\"submit\">Add Article</button>
    </form>
";
        }
        // line 37
        yield "<div>
<ul>
    ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["articles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 40
            yield "        <li>
            <a href=\"../../../articleDetails/";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "article_id", [], "any", false, false, false, 41), "html", null, true);
            yield "\">
                ";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "article_id", [], "any", false, false, false, 42), "html", null, true);
            yield "
            </a>
        </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        yield "</ul>

</div>
</body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "front/article.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  124 => 46,  114 => 42,  110 => 41,  107 => 40,  103 => 39,  99 => 37,  82 => 23,  79 => 22,  77 => 21,  73 => 19,  68 => 16,  65 => 14,  61 => 12,  57 => 10,  55 => 9,  49 => 6,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "front/article.twig", "S:\\Sprint 5\\MVC\\app\\views\\front\\article.twig");
    }
}
