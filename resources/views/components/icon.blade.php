@props([
    'name' => null,
    'icon' => null,
    'size' => 24,
    'width' => null,
    'height' => null,
    'color' => 'currentColor',
    'label' => null,
])

@php
    $iconName = $name ?? $icon;

    $normalizeDimension = static function ($value) {
        if ($value === null || $value === '') {
            return null;
        }

        return is_numeric($value) ? $value . 'px' : $value;
    };

    $resolvedWidth = $normalizeDimension($width ?? $size);
    $resolvedHeight = $normalizeDimension($height ?? $size);
    $iconFile = $iconName ? (str_ends_with($iconName, '.svg') ? $iconName : $iconName . '.svg') : null;
    $iconPath = $iconFile ? public_path('icons/' . $iconFile) : null;
    $svg = null;

    if ($iconPath && file_exists($iconPath)) {
        $svg = file_get_contents($iconPath);

        $svg = preg_replace_callback(
            '/\b(fill|stroke)="([^"]+)"/i',
            static function (array $matches) {
                $value = trim($matches[2]);
                $attribute = strtolower($matches[1]);

                if (
                    $value === '' ||
                    strtolower($value) === 'none' ||
                    strtolower($value) === 'currentcolor' ||
                    str_starts_with(strtolower($value), 'url(')
                ) {
                    return $matches[0];
                }

                if ($attribute === 'fill') {
                    return $matches[0];
                }

                return $matches[1] . '="currentColor"';
            },
            $svg
        );

        $svgAttributes = $attributes
            ->class('inline-block shrink-0 align-middle')
            ->merge([
                'width' => $resolvedWidth,
                'height' => $resolvedHeight,
                'style' => "color: {$color};",
                'aria-hidden' => $label ? null : 'true',
                'role' => $label ? 'img' : null,
                'aria-label' => $label,
            ]);

        $svg = preg_replace_callback(
            '/<svg\b([^>]*)>/i',
            static function (array $matches) use ($svgAttributes) {
                $existingAttributes = preg_replace(
                    '/\s(?:width|height|class|style|aria-hidden|role|aria-label)="[^"]*"/i',
                    '',
                    $matches[1]
                );

                return '<svg' . $existingAttributes . ' ' . $svgAttributes . '>';
            },
            $svg,
            1
        );
    }
@endphp

{!! $svg !!}
