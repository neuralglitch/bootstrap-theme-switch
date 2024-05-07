## Manual installation instructions

### Add routing 
`config/routes/bootstrap_theme_switch.yaml`
```bash
cp -f vendor/neuralglitch/bootstrap-theme-switch/config/routing.yaml config/routes/bootstrap_theme_switch.yaml
```

### Copy JavaScript library
```bash
mkdir -p assets/vendor/neuralglitch/bootstrap-theme-switch/dist && \
  cp -f vendor/neuralglitch/bootstrap-theme-switch/assets/dist/bootstrap-theme-switch.min.js \
        assets/vendor/neuralglitch/bootstrap-theme-switch/dist/
```

### Add JavaScript import 
`assets/app.js`
```javascript
import './vendor/neuralglitch/bootstrap-theme-switch/dist/bootstrap-theme-switch.min.js';
```

### Clear cache
```bash
bin/console cache:clear
```

### Additionally
Execute the appropriate commands to build the frontend, if necessary.

[back](../README.md)