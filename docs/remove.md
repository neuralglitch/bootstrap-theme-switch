## Manual removal instructions

### Remove routing 
`config/routes/bootstrap_theme_switch.yaml`
```bash
rm -f config/routes/bootstrap_theme_switch.yaml
```

### Remove JavaScript library
```bash
rm -rf assets/vendor/neuralglitch/bootstrap-theme-switch
```

### Restore the base template
`templates/base.html.twig`

### Remove the include where it was used
i.e. `templates/partials/footer.html.twig`

### Remove JavaScript import
`assets/app.js`

### Clear cache
```bash
bin/console cache:clear
```

### Additionally
Execute the appropriate commands to build the frontend, if necessary.

[back](../README.md)