# yii2-sweetalert
SweetAlert asset for Yii2 framework

# Install 

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Add composer dependence in composer.json

```
"omnilight/yii2-sweetalert": "1.0.*"
```

and run composer update

# Usage

Just register SweetAlert asset in your view as:
```
use omnilight\assets\SweetAlertAsset;

SweetAlertAsset::register($this);
```

and you are ready to use SweetAlert JS code:
```
swal("Hello world!");
```

## License
Extension is released under the MIT License. See the bundled `LICENSE.md` for details.
