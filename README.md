# Facebook Repository for  >= Laravel 5.5

This package is able to load the latest posts from a facebook feed and return them. An optional caching decorator is available.

## Usage

### Step 1: Install Through Composer

```
composer require campaigningbureau/facebook-repository
```

### Step 2: Register the Service Provider

Add the service provider to `config/app.php`.

```php
	/*
	 * Package Service Providers...
	 */
	\CampaigningBureau\FacebookRepository\FacebookRepositoryServiceProvider::class,
```

### Step 3: Publish and edit the config file

```bash
$ php artisan vendor:publish --provider="CampaigningBureau\FacebookRepository\FacebookRepositoryServiceProvider"
```

## Configuration

The `facebook_app_id` and `facebook_app_secret` fields need to be set with the API Key and Secret of your Facebook app.  
By default they are populated with the .env variables `FACEBOOK_APP_ID` and `FACEBOOK_APP_SECRET`.

The caching configuration is required for the optional caching decorator. 