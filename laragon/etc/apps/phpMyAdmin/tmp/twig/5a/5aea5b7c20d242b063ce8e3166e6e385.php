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

/* table/structure/partition_definition_form.twig */
class __TwigTemplate_608dc45a81bfb89e6cda24bd5c64bd31 extends Template
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
        // line 1
        yield "<form action=\"";
        yield PhpMyAdmin\Url::getFromRoute("/table/structure/partitioning");
        yield "\" method=\"post\">
    ";
        // line 2
        yield PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null), ($context["table"] ?? null));
        yield "

    <fieldset class=\"pma-fieldset\">
        <legend>";
yield _gettext("Edit partitioning");
        // line 5
        yield "</legend>
        ";
        // line 6
        yield from         $this->loadTemplate("columns_definitions/partitions.twig", "table/structure/partition_definition_form.twig", 6)->unwrap()->yield(CoreExtension::toArray(["partition_details" =>         // line 7
($context["partition_details"] ?? null), "storage_engines" =>         // line 8
($context["storage_engines"] ?? null)]));
        // line 10
        yield "    </fieldset>
    <fieldset class=\"pma-fieldset tblFooters\">
        <input class=\"btn btn-primary\" type=\"submit\" name=\"save_partitioning\" value=\"";
yield _gettext("Save");
        // line 12
        yield "\">
    </fieldset>
</form>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "table/structure/partition_definition_form.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  62 => 12,  57 => 10,  55 => 8,  54 => 7,  53 => 6,  50 => 5,  43 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "table/structure/partition_definition_form.twig", "C:\\Users\\chine\\OneDrive\\Documents\\Project-for-webdev-Software\\laragon\\etc\\apps\\phpMyAdmin\\templates\\table\\structure\\partition_definition_form.twig");
    }
}
