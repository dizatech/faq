 Faq
=======
# Laravel Faq Package
[![GitHub issues](https://img.shields.io/github/issues/dizatech/faq?style=flat-square)](https://github.com/dizatech/faq/issues)
[![GitHub stars](https://img.shields.io/github/stars/dizatech/faq?style=flat-square)](https://github.com/dizatech/faq/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/dizatech/faq?style=flat-square)](https://github.com/dizatech/faq/network)
[![GitHub license](https://img.shields.io/github/license/dizatech/faq?style=flat-square)](https://github.com/dizatech/faq/blob/master/LICENSE)


A laravel package for faq transaction

## How to install and config [dizatech/faq](https://github.com/dizatech/faq) package?

#### Installation

```
PHP Package:
composer require dizatech/faq


packagist : https://packagist.org/packages/dizatech/faq
```
#### Publish Config file
```
php artisan vendor:publish --tag=dizatech_faq
```

#### Migrate tables, to add faq and wallet tables to database
```
php artisan migrate
```

#### require
```
"php": "^7.2",
"laravel/framework": "7.*|8.*|9.*",
    
```

### add to menu
```
add to sidebar.php page below line:

@component('dizatechFaq::components.menu-faq') @endcomponent
```
### add into webpack.mix.js
```

.js('resources/js/vendor/dizatech-faq/dizatech-faq.js', 'public/modules/js')
.sass('resources/sass/vendor/dizatech-faq/dizatech-faq.scss', 'public/modules/css')
```