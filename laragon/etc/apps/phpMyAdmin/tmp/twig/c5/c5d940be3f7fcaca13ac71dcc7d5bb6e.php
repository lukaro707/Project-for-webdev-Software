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

/* database/designer/page_save_as.twig */
class __TwigTemplate_271791a774f0f63782b0cfc42bf939ed extends Template
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
        yield PhpMyAdmin\Url::getFromRoute("/database/designer");
        yield "\" method=\"post\" name=\"save_as_pages\" id=\"save_as_pages\" class=\"ajax\">
    ";
        // line 2
        yield PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
        yield "
    <fieldset class=\"pma-fieldset\" id=\"page_save_as_options\">
        <table class=\"table table-borderless\">
            <tbody>
                <tr>
                    <td>
                        <input type=\"hidden\" name=\"operation\" value=\"savePage\">
                        ";
        // line 9
        yield from         $this->loadTemplate("database/designer/page_selector.twig", "database/designer/page_save_as.twig", 9)->unwrap()->yield(CoreExtension::toArray(["pdfwork" =>         // line 10
($context["pdfwork"] ?? null), "pages" =>         // line 11
($context["pages"] ?? null)]));
        // line 13
        yield "                    </td>
                </tr>
                <tr>
                    <td>
                      <div>
                        <input type=\"radio\" name=\"save_page\" id=\"savePageSameRadio\" value=\"same\" checked>
                        <label for=\"savePageSameRadio\">";
yield _gettext("Save to selected page");
        // line 19
        yield "</label>
                      </div>
                      <div>
                        <input type=\"radio\" name=\"save_page\" id=\"savePageNewRadio\" value=\"new\">
                        <label for=\"savePageNewRadio\">";
yield _gettext("Create a page and save to it");
        // line 23
        yield "</label>
                      </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for=\"selected_value\">";
yield _gettext("New page name");
        // line 29
        yield "</label>
                        <input type=\"text\" name=\"selected_value\" id=\"selected_value\">
                    </td>
                </tr>
            </tbody>
        </table>
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
        return "database/designer/page_save_as.twig";
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
        return array (  82 => 29,  73 => 23,  66 => 19,  57 => 13,  55 => 11,  54 => 10,  53 => 9,  43 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "database/designer/page_save_as.twig", "C:\\Users\\chine\\OneDrive\\Documents\\Project-for-webdev-Software\\laragon\\etc\\apps\\phpMyAdmin\\templates\\database\\designer\\page_save_as.twig");
    }
}
