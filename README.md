# LaravelApiDebugger

LaravelApiDebugger is a simple library for debugging APIs in Laravel applications. It provides functionality similar to `dd()` and `dump()` but tailored for API responses.

## Installation

To install LaravelApiDebugger, require it using Composer:

```bash
composer require hasanh47/laravel-api-debugger
```

## Usage

Use the ApiDebugger class to debug API responses:

```php
use HasanH47\ApiDebugger\ApiDebugger;

public function someMethod(Request $request)
{
    $data = ['key' => 'value'];

    // For debugging API
    ApiDebugger::dd($data);

    return response()->json(['success' => true]);
}
```

## License
This library is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.