# 

## Model Factories

The base should be the most common actionable user.

Sometimes I tend to use the simplest model and then most of my tests have states. It became annoying.

```php
# Good

// This creates an activated starndard user.
factory(User::class)->create(); 

// Admin user
factory(User::class)->states('admin')->create();

// Create an inactive user for testing the registration layer.
factory(User::class)->states('admin')->create();

```

Before my initial instinct was to use states to _add_ more into the model, rather than think of it has scaffolding for the test. So most of my feature tests end up having filled with unnecessary states.
