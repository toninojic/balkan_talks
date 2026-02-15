<?php

namespace BalkanTalks\Views;

class TemplateRenderer
{
    /**
     * @param array<string, mixed> $args
     */
    public function renderTemplatePart(string $slug, ?string $name = null, array $args = []): string
    {
        ob_start();
        get_template_part($slug, $name, $args);

        return (string) ob_get_clean();
    }

    /**
     * @param array<string, mixed> $context
     */
    public function renderPhpView(string $absolutePath, array $context = []): void
    {
        extract($context, EXTR_SKIP);
        include $absolutePath;
    }
}
