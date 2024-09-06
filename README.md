<p><img src="./logos/logo.svg" width="106" height="106" alt=" CMS"></p>

# Introduction

In this document you will find an explanation on how to use the Mosweed CMS starter kit.

# Requirements

To use this package, you'll need:

- > Laravel framework 11
- > To use with Livewire v3
- > PHP 8.2 or higher

When installing this package, the following packages will be installed:

- > Mollie / mollie-api-php
- >	Spatie/laravel-medialibary
- >	Barryvdh/laravel-dompdf : *2.1.0


# Installation

You can install the package via composer:

```shell script
composer require Mosweed/Mosweed_cms

Php artisan Mosweed_cms:install
```

# Installation Process:

1. First, the required packages will be installed.
2. All necessary files will be published.
3. You will be prompted with the following questions:
    - **Do you want to install Jetstream Livewire dark?**  
      You can answer with **YES** or **NO**, but we recommend installing it.
    - **New database migrations were added. Would you like to re-run your migrations and seeders?**  
      It is best to answer **YES** if you want to set up an admin or SMTP configuration.
    - **Create a new admin:**  
      ```bash
      php artisan create:admin
      ```  
      This will create an admin role, allowing you to manage the CMS.
    - **Create a new SMTP setting:**  
      ```bash
      php artisan smtp:setting
      ```  
      This will generate a new configuration, responsible for sending emails, and can also be managed in the CMS.

After these commands, the following will be automatically installed:

- `npm install`
- `npm run dev`
- `php artisan storage:link`

All old migrations, the User Model, errors folder in the view, and providers in the app will be removed.

# Block Editor Elements:

To create a block, use the following command:  

```bash
php artisan dropblockeditor:make {name}
```

Like

```shell script
php artisan dropblockeditor:make Text
```

After **make**, you can specify a name for the element.

Two files will be created:

- `App/view/components/blocks/{name}`
- `Resources/views/components/blocks/{name}`

In the first file, you'll find variables:

- **Title**: This is the block name.
- **Icon**: The SVG icon with dimensions `0 0 24 24`.
- **Category**: The category under which this block will be listed.
- **Data**: This contains an array of data related to the element.

In the second file, the data will be displayed and processed. When a field is changed, the **UPDATE** function will be triggered.




# Migrations

- > users
- > products
- > shopcarts
- > shipping_methods
- > payments_methods
- > customers
- > order_items
- > orders
- > addresses
- > pages
- > roles
- > coupons
- > categories
- > emailconfiguraties
- > orders_emails
- > api_configrations

# Model

- > **Name:** pages
- > **Data:** [title, slug, status, content]
- > The Route key is a slug


## Credits

- [Mohmad Yazan Sweed](https://github.com/ps200735)
- Hamzah Sari

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
