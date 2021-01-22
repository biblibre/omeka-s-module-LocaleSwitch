# Locale Switch

Locale Switch is an Omeka S module that provides a view helper for allowing
users to change the locale. The chosen locale is then stored inside user's
session.

## Usage

Enable the module then add this into your theme:

```php
<?php
    echo $this->localeSwitch([
        'en' => $this->translate('English'),
        'fr' => $this->translate('French'),
        /* ... */
    ]);
?>
```

You can customize the HTML output of the view helper by overriding
`locale-switch/helper/locale-switch.phtml`
