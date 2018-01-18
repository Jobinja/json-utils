# Jobinja Json Response Utils
Jobinja json responses daily used utils

## Installation
```zsh
composer require jobinja/json-utils
```

## JRes
- validation
- store
- update
- index
- pagination
- error
- errorException

```php
final class MyAction extends Controller
{
    public function action()
    {
        try {
            $users = User::paginate();
            
            return JRes::pagination($users)->getResponse();
        } catch (\Exception $e) {
            return JRes::errorException($e)->getResponse();
        }
    }
}
```