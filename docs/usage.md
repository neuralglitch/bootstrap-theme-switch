## Advanced usage

### Optional variables

#### System default mode
Use `bs_theme_switch_has_sync_mode` to determine if the theme switcher should include a "Sync with system" 
element.
- **Values:** `'0'` (without) and `'1'` (with "System default mode")
- **Defaults:** 
  - `'0'` in the button component
  - `'1'` in the select component

#### Variant
Use `bs_theme_switch_button_variant` to apply an available Bootstrap variant.
- **Values:** one of the available [variants](https://getbootstrap.com/docs/5.3/components/buttons/#variants)
with an optional [outline](https://getbootstrap.com/docs/5.3/components/buttons/#outline-buttons)
- **Default:** `''` (empty) - the colors of the element toggle with the applied theme

> [!NOTE]
> As the name implies, the `bs_theme_switch_button_variant` is only available for the button component.

### Advanced button usage
```twig
{% include '@BootstrapThemeSwitch//button.html.twig' with {
   bs_theme_switch_has_sync_mode: '1',
   bs_theme_switch_button_variant: 'primary'
} %}
```
### Advanced select usage
```twig
{% include '@BootstrapThemeSwitch//select.html.twig' with {
   bs_theme_switch_has_sync_mode: '0'
} %}
```

[back](../README.md)