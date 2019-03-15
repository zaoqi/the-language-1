<?php
mb_internal_encoding("UTF-8");
function _void() {
  return null;
}
function _new($fn) {
  if (!($fn instanceof Func)) {
    throw new Ex(Err::create(_typeof($fn) . " is not a function"));
  }
  $args = array_slice(func_get_args(), 1);
  return call_user_func_array(array($fn, 'construct'), $args);
}
function _instanceof($obj, $fn) {
  if (!($obj instanceof Object)) {
    return false;
  }
  if (!($fn instanceof Func)) {
    throw new Ex(Err::create('Expecting a function in instanceof check'));
  }
  $proto = $obj->proto;
  $prototype = get($fn, 'prototype');
  while ($proto !== Object::$null) {
    if ($proto === $prototype) {
      return true;
    }
    $proto = $proto->proto;
  }
  return false;
}
function _divide($a, $b) {
  $a = to_number($a);
  $b = to_number($b);
  if ($b === 0.0) {
    if ($a === 0.0) return NAN;
    return ($a < 0.0) ? -INF : INF;
  }
  return $a / $b;
}
function _plus() {
  $total = 0;
  $strings = array();
  $isString = false;
  foreach (func_get_args() as $arg) {
    if (is_string($arg)) {
      $isString = true;
    }
    $strings[] = to_string($arg);
    if (!$isString) {
      $total += to_number($arg);
    }
  }
  return $isString ? join('', $strings) : $total;
}
function _concat() {
  $strings = array();
  foreach (func_get_args() as $arg) {
    $strings[] = to_string($arg);
  }
  return join('', $strings);
}
function _negate($val) {
  return (float)(0 - $val);
}
function _and($a, $b) {
  return $a ? $b : $a;
}
function _or($a, $b) {
  return $a ? $a : $b;
}
function _delete($obj, $key = null) {
  if (func_num_args() === 1) {
    return false;
  }
  if ($obj === null || $obj === Object::$null) {
    throw new Ex(Err::create("Cannot convert undefined or null to object"));
  }
  $obj = objectify($obj);
  $obj->remove($key);
  return true;
}
function _in($key, $obj) {
  if (!($obj instanceof Object)) {
    throw new Ex(Err::create("Cannot use 'in' operator to search for '" . $key . "' in " . to_string($obj)));
  }
  return $obj->hasProperty($key);
}
function _typeof($value) {
  if ($value === null) {
    return 'undefined';
  }
  if ($value === Object::$null) {
    return 'object';
  }
  $type = gettype($value);
  if ($type === 'integer' || $type === 'double') {
    return 'number';
  }
  if ($type === 'string' || $type === 'boolean') {
    return $type;
  }
  if ($value instanceof Func) {
    return 'function';
  }
  if ($value instanceof Object) {
    return 'object';
  }
  return 'unknown';
}
function _seq() {
  $args = func_get_args();
  return array_pop($args);
}
function is($x) {
  return $x !== false && $x !== 0.0 && $x !== '' && $x !== null && $x !== Object::$null && $x === $x ;
}
function not($x) {
  return $x === false || $x === 0.0 || $x === '' || $x === null || $x === Object::$null || $x !== $x ;
}
function eq($a, $b) {
  $typeA = ($a === null || $a === Object::$null ? 'null' : ($a instanceof Object ? 'object' : gettype($a)));
  $typeB = ($b === null || $b === Object::$null ? 'null' : ($b instanceof Object ? 'object' : gettype($b)));
  if ($typeA === 'null' && $typeB === 'null') {
    return true;
  }
  if ($typeA === 'integer') {
    $a = (float)$a;
    $typeA = 'double';
  }
  if ($typeB === 'integer') {
    $b = (float)$b;
    $typeB = 'double';
  }
  if ($typeA === $typeB) {
    return $a === $b;
  }
  if ($typeA === 'double' && $typeB === 'string') {
    return $a === to_number($b);
  }
  if ($typeB === 'double' && $typeA === 'string') {
    return $b === to_number($a);
  }
  if ($typeA === 'boolean') {
    return eq((float)$a, $b);
  }
  if ($typeB === 'boolean') {
    return eq((float)$b, $a);
  }
  if (($typeA === 'string' || $typeA === 'double') && $typeB === 'object') {
    return eq($a, to_primitive($b));
  }
  if (($typeB === 'string' || $typeB === 'double') && $typeA === 'object') {
    return eq($b, to_primitive($a));
  }
  return false;
}
function keys($obj, &$arr = array()) {
  if (!($obj instanceof Object)) {
    return $arr;
  }
  return $obj->getKeys($arr);
}
function is_primitive($value) {
  return ($value === null || $value === Object::$null || is_scalar($value));
}
function is_int_or_float($value) {
  return (is_int($value) || is_float($value));
}
function to_string($value) {
  if ($value === null) {
    return 'undefined';
  }
  if ($value === Object::$null) {
    return 'null';
  }
  $type = gettype($value);
  if ($type === 'string') {
    return $value;
  }
  if ($type === 'boolean') {
    return $value ? 'true' : 'false';
  }
  if ($type === 'integer' || $type === 'double') {
    if ($value !== $value) return 'NaN';
    if ($value === INF) return 'Infinity';
    if ($value === -INF) return '-Infinity';
    return $value . '';
  }
  if ($value instanceof Object) {
    $fn = $value->get('toString');
    if ($fn instanceof Func) {
      return $fn->call($value);
    } else {
      throw new Ex(Err::create('Cannot convert object to primitive value'));
    }
  }
  throw new Ex(Err::create('Cannot cast PHP value to string: ' . _stringify($value)));
}
function to_number($value) {
  if ($value === null) {
    return NAN;
  }
  if ($value === Object::$null) {
    return 0.0;
  }
  if (is_float($value)) {
    return $value;
  }
  if (is_int($value)) {
    return (float)$value;
  }
  if (is_bool($value)) {
    return ($value ? 1.0 : 0.0);
  }
  if ($value instanceof Object) {
    return to_number(to_primitive($value));
  }
  $value = preg_replace('/^[\s\x0B\xA0]+|[\s\x0B\xA0]+$/u', '', $value);
  if ($value === '') {
    return 0.0;
  }
  if ($value === 'Infinity' || $value === '+Infinity') {
    return INF;
  }
  if ($value === '-Infinity') {
    return -INF;
  }
  if (preg_match('/^([+-]?)(\d+\.\d*|\.\d+|\d+)$/i', $value)) {
    return (float)$value;
  }
  if (preg_match('/^([+-]?)(\d+\.\d*|\.\d+|\d+)e([+-]?[0-9]+)$/i', $value, $m)) {
    return pow($m[1] . $m[2], $m[3]);
  }
  if (preg_match('/^0x[a-z0-9]+$/i', $value)) {
    return (float)hexdec(substr($value, 2));
  }
  return NAN;
}
function to_primitive($obj) {
  $value = $obj->callMethod('valueOf');
  if ($value instanceof Object) {
    $value = to_string($value);
  }
  return $value;
}
function objectify($value) {
  $type = gettype($value);
  if ($type === 'string') {
    return new Str($value);
  } elseif ($type === 'integer' || $type === 'double') {
    return new Number($value);
  } elseif ($type === 'boolean') {
    return new Bln($value);
  }
  return $value;
}
function get($obj, $name) {
  if ($obj === null || $obj === Object::$null) {
    throw new Ex(Err::create("Cannot read property '" . $name . "' of " . to_string($obj)));
  }
  $obj = objectify($obj);
  return $obj->get($name);
}
function set($obj, $name, $value, $op = '=', $returnOld = false) {
  if ($obj === null || $obj === Object::$null) {
    throw new Ex(Err::create("Cannot set property '" . $name . "' of " . to_string($obj)));
  }
  $obj = objectify($obj);
  if ($op === '=') {
    return $obj->set($name, $value);
  }
  $oldValue = $obj->get($name);
  switch ($op) {
    case '+=':
      $newValue = _plus($oldValue, $value);
      break;
    case '-=':
      $newValue = $oldValue - $value;
      break;
    case '*=':
      $newValue = $oldValue * $value;
      break;
    case '/=':
      $newValue = $oldValue / $value;
      break;
    case '%=':
      $newValue = $oldValue % $value;
      break;
  }
  $obj->set($name, $newValue);
  return $returnOld ? $oldValue : $newValue;
}
function call($fn) {
  if (!($fn instanceof Func)) {
    throw new Ex(Err::create(_typeof($fn) . " is not a function"));
  }
  $args = array_slice(func_get_args(), 1);
  return $fn->apply(Object::$global, $args);
}
function call_method($obj, $name) {
  if ($obj === null || $obj === Object::$null) {
    throw new Ex(Err::create("Cannot read property '" . $name . "' of " . to_string($obj)));
  }
  $obj = objectify($obj);
  $fn = $obj->get($name);
  if (!($fn instanceof Func)) {
    throw new Ex(Err::create(_typeof($fn) . " is not a function"));
  }
  $args = array_slice(func_get_args(), 2);
  return $fn->apply($obj, $args);
}
function write_all($stream, $data, $bytesTotal = null) {
  if ($bytesTotal === null) {
    $bytesTotal = strlen($data);
  }
  $bytesWritten = fwrite($stream, $data);
  while ($bytesWritten < $bytesTotal) {
    $bytesWritten += fwrite($stream, substr($data, $bytesWritten));
  }
}
class Object {
  public $data = array();
  public $dscr = array();
  public $proto = null;
  public $className = "Object";
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  static $null = null;
  static $global = null;
  function __construct() {
    $this->proto = self::$protoObject;
    $args = func_get_args();
    if (count($args) > 0) {
      $this->init($args);
    }
  }
  function init($arr) {
    $len = count($arr);
    for ($i = 0; $i < $len; $i += 2) {
      $this->set($arr[$i], $arr[$i + 1]);
    }
  }
  function get($key) {
    $key = (string)$key;
    if (method_exists($this, 'get_' . $key)) {
      return $this->{'get_' . $key}();
    }
    $obj = $this;
    while ($obj !== Object::$null) {
      if (array_key_exists($key, $obj->data)) {
        return $obj->data[$key];
      }
      $obj = $obj->proto;
    }
    return null;
  }
  function set($key, $value) {
    $key = (string)$key;
    if (method_exists($this, 'set_' . $key)) {
      return $this->{'set_' . $key}($value);
    }
    if (!array_key_exists($key, $this->dscr) || $this->dscr[$key]->writable) {
      $this->data[$key] = $value;
    }
    return $value;
  }
  function remove($key) {
    $key = (string)$key;
    if (array_key_exists($key, $this->dscr)) {
      if (!$this->dscr[$key]->configurable) {
        return false;
      }
      unset($this->dscr[$key]);
    }
    unset($this->data[$key]);
    return true;
  }
  function hasOwnProperty($key) {
    $key = (string)$key;
    if (method_exists($this, 'get_' . $key)) {
      return true;
    }
    return array_key_exists($key, $this->data);
  }
  function hasProperty($key) {
    $key = (string)$key;
    if ($this->hasOwnProperty($key)) {
      return true;
    }
    $proto = $this->proto;
    if ($proto instanceof Object) {
      return $proto->hasProperty($key);
    }
    return false;
  }
  function getOwnKeys($onlyEnumerable) {
    $arr = array();
    foreach ($this->data as $key => $value) {
      $key = (string)$key;
      if ($onlyEnumerable) {
        $dscr = isset($this->dscr[$key]) ? $this->dscr[$key] : null;
        if (!$dscr || $dscr->enumerable) {
          $arr[] = $key;
        }
      } else {
        $arr[] = $key;
      }
    }
    return $arr;
  }
  function getKeys(&$arr = array()) {
    foreach ($this->data as $key => $v) {
      $key = (string)$key;
      $dscr = isset($this->dscr[$key]) ? $this->dscr[$key] : null;
      if (!$dscr || $dscr->enumerable) {
        $arr[] = $key;
      }
    }
    $proto = $this->proto;
    if ($proto instanceof Object) {
      $proto->getKeys($arr);
    }
    return $arr;
  }
  function setProp($key, $value, $writable = null, $enumerable = null, $configurable = null) {
    $key = (string)$key;
    if (array_key_exists($key, $this->dscr)) {
      $result = $this->dscr[$key];
      unset($this->dscr[$key]);
    } else {
      $result = new Descriptor(true, true, true);
    }
    if ($writable !== null) {
      $result->writable = !!$writable;
    }
    if ($enumerable !== null) {
      $result->enumerable = !!$enumerable;
    }
    if ($configurable !== null) {
      $result->configurable = !!$configurable;
    }
    if (!$result->writable || !$result->enumerable || !$result->configurable) {
      $this->dscr[$key] = $result;
    }
    $this->data[$key] = $value;
    return $value;
  }
  function setProps($props, $writable = null, $enumerable = null, $configurable = null) {
    foreach ($props as $key => $value) {
      $this->setProp($key, $value, $writable, $enumerable, $configurable);
    }
  }
  function setMethods($methods, $writable = null, $enumerable = null, $configurable = null) {
    foreach ($methods as $name => $fn) {
      $func = new Func((string)$name, $fn);
      $func->strict = true;
      $this->setProp($name, $func, $writable, $enumerable, $configurable);
    }
  }
  function toArray() {
    $keys = $this->getOwnKeys(true);
    $results = array();
    foreach ($keys as $key) {
      $results[$key] = $this->get($key);
    }
    return $results;
  }
  function callMethod($name) {
    $fn = $this->get($name);
    if (!($fn instanceof Func)) {
      Debug::log($this, $name, $fn);
      throw new Ex(Err::create('Invalid method called'));
    }
    $args = array_slice(func_get_args(), 1);
    return $fn->apply($this, $args);
  }
  function __call($name, $args) {
    if (isset($this->{$name})) {
      return call_user_func_array($this->{$name}, $args);
    } else {
      throw new Ex(Err::create('Internal method `' . $name . '` not found on ' . gettype($this)));
    }
  }
  static function getGlobalConstructor() {
    $Object = new Func(function($value = null) {
      if ($value === null || $value === Object::$null) {
        return new Object();
      } else {
        return objectify($value);
      }
    });
    $Object->set('prototype', Object::$protoObject);
    $Object->setMethods(Object::$classMethods, true, false, true);
    return $Object;
  }
}
class Descriptor {
  public $writable = true;
  public $enumerable = true;
  public $configurable = true;
  function __construct($writable = null, $enumerable = null, $configurable = null) {
    $this->writable = ($writable === null) ? true : !!$writable;
    $this->enumerable = ($enumerable === null) ? true : !!$enumerable;
    $this->configurable = ($configurable === null) ? true : !!$configurable;
  }
  function toObject($value = null) {
    $result = new Object();
    $result->set('value', $value);
    $result->set('writable', $this->writable);
    $result->set('enumerable', $this->enumerable);
    $result->set('configurable', $this->configurable);
    return $result;
  }
  static function getDefault($value = null) {
    return new Object('value', $value, 'writable', true, 'enumerable', true, 'configurable', true);
  }
}
Object::$classMethods = array(
  'create' => function($proto) {
      if (!($proto instanceof Object) && $proto !== Object::$null) {
        throw new Ex(Err::create('Object prototype may only be an Object or null'));
      }
      $obj = new Object();
      $obj->proto = $proto;
      return $obj;
    },
  'keys' => function($obj) {
      if (!($obj instanceof Object)) {
        throw new Ex(Err::create('Object.keys called on non-object'));
      }
      return Arr::fromArray($obj->getOwnKeys(true));
    },
  'getOwnPropertyNames' => function($obj) {
      if (!($obj instanceof Object)) {
        throw new Ex(Err::create('Object.getOwnPropertyNames called on non-object'));
      }
      return Arr::fromArray($obj->getOwnKeys(false));
    },
  'getOwnPropertyDescriptor' => function($obj, $key) {
      if (!($obj instanceof Object)) {
        throw new Ex(Err::create('Object.getOwnPropertyDescriptor called on non-object'));
      }
      $key = (string)$key;
      if (method_exists($obj, 'get_' . $key)) {
        $hasProperty = true;
        $value = $obj->{'get_' . $key}();
      } else {
        $hasProperty = array_key_exists($key, $obj->data);
        $value = $hasProperty ? $obj->data[$key] : null;
      }
      if (array_key_exists($key, $obj->dscr)) {
        return $obj->dscr[$key]->toObject($value);
      } else if ($hasProperty) {
        return Descriptor::getDefault($value);
      } else {
        return null;
      }
    },
  'defineProperty' => function($obj, $key, $desc) {
      $key = (string)$key;
      if (!($obj instanceof Object)) {
        throw new Ex(Err::create('Object.defineProperty called on non-object'));
      }
      $writable = $desc->get('writable');
      $enumerable = $desc->get('enumerable');
      $configurable = $desc->get('configurable');
      $updateValue = false;
      if (array_key_exists($key, $obj->data)) {
        if (array_key_exists($key, $obj->dscr)) {
          $result = $obj->dscr[$key];
        } else {
          $result = $obj->dscr[$key] = new Descriptor(true, true, true);
        }
        if (!$result->configurable) {
          throw new Ex(TypeErr::create('Cannot redefine property: ' . $key));
        }
        if ($writable !== null) {
          $result->writable = !!$writable;
        }
        if ($enumerable !== null) {
          $result->enumerable = !!$enumerable;
        }
        if ($configurable !== null) {
          $result->configurable = !!$configurable;
        }
        if ($result->writable && $result->enumerable && $result->configurable) {
          unset($obj->dscr[$key]);
        }
        if ($desc->hasProperty('value')) {
          $value = $desc->get('value');
          $updateValue = true;
        }
      } else {
        $writable = ($writable === null) ? false : !!$writable;
        $enumerable = ($enumerable === null) ? false : !!$enumerable;
        $configurable = ($configurable === null) ? false : !!$configurable;
        if (!$writable || !$enumerable || !$configurable) {
          $result = new Descriptor($writable, $enumerable, $configurable);
          $obj->dscr[$key] = $result;
        }
        $value = $desc->get('value');
        $updateValue = true;
      }
      if ($updateValue) {
        if (method_exists($obj, 'set_' . $key)) {
          $obj->{'set_' . $key}($value);
        } else {
          $obj->data[$key] = $value;
        }
      }
    },
  'defineProperties' => function($obj, $items) {
      if (!($obj instanceof Object)) {
        throw new Ex(Err::create('Object.defineProperties called on non-object'));
      }
      if (!($items instanceof Object)) {
        throw new Ex(Err::create('Object.defineProperties called with invalid list of properties'));
      }
      $defineProperty = Object::$classMethods['defineProperty'];
      foreach ($items->data as $key => $value) {
        $dscr = isset($items->dscr[$key]) ? $items->dscr[$key] : null;
        if (!$dscr || $dscr->enumerable) {
          $defineProperty($obj, $key, $value);
        }
      }
    },
  'getPrototypeOf' => function() {
      throw new Ex(Err::create('Object.getPrototypeOf not implemented'));
    },
  'setPrototypeOf' => function() {
      throw new Ex(Err::create('Object.getPrototypeOf not implemented'));
    },
  'preventExtensions' => function() {
    },
  'isExtensible' => function() {
      return false;
    },
  'seal' => function() {
    },
  'isSealed' => function() {
      return false;
    },
  'freeze' => function() {
    },
  'isFrozen' => function() {
      return false;
    }
);
Object::$protoMethods = array(
  'hasOwnProperty' => function($key) {
      $self = Func::getContext();
      return array_key_exists($key, $self->data);
    },
  'toString' => function() {
      $self = Func::getContext();
      if ($self === null) {
        $className = 'Undefined';
      } else if ($self === Object::$null) {
        $className = 'Null';
      } else {
        $obj = objectify($self);
        $className = $obj->className;
      }
      return '[object ' . $className . ']';
    },
  'valueOf' => function() {
      return Func::getContext();
    }
);
class NullClass {}
Object::$null = new NullClass();
Object::$protoObject = new Object();
Object::$protoObject->proto = Object::$null;
class Func extends Object {
  public $name = "";
  public $className = "Function";
  public $fn = null;
  public $meta = null;
  public $strict = false;
  public $callStackPosition = null;
  public $args = null;
  public $boundArgs = null;
  public $context = null;
  public $boundContext = null;
  public $arguments = null;
  public $instantiate = null;
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  static $callStack = array();
  static $callStackLength = 0;
  function __construct() {
    parent::__construct();
    $this->proto = self::$protoObject;
    $args = func_get_args();
    if (gettype($args[0]) === 'string') {
      $this->name = array_shift($args);
    }
    $this->fn = array_shift($args);
    $this->meta = isset($args[0]) ? $args[0] : array();
    $this->strict = isset($this->meta['strict']);
    $prototype = new Object();
    $prototype->setProp('constructor', $this, true, false, true);
    $this->setProp('prototype', $prototype, true, false, true);
    $this->setProp('name', $this->name, false, false, false);
  }
  function construct() {
    if ($this->instantiate !== null) {
      $obj = call_user_func($this->instantiate);
    } else {
      $obj = new Object();
      $obj->proto = $this->get('prototype');
    }
    $result = $this->apply($obj, func_get_args());
    return is_primitive($result) ? $obj : $result;
  }
  function call($context = null) {
    return $this->apply($context, array_slice(func_get_args(), 1));
  }
  function apply($context, $args) {
    if ($this->boundContext !== null) {
      $context = $this->boundContext;
      if ($this->boundArgs) {
        $args = array_merge($this->boundArgs, $args);
      }
    }
    $this->args = $args;
    if (!$this->strict) {
      if ($context === null || $context === Object::$null) {
        $context = Object::$global;
      } else if (!($context instanceof Object)) {
        $context = objectify($context);
      }
    }
    $oldStackPosition = $this->callStackPosition;
    $oldArguments = $this->arguments;
    $oldContext = $this->context;
    $this->context = $context;
    $this->callStackPosition = self::$callStackLength;
    self::$callStack[self::$callStackLength++] = $this;
    $result = call_user_func_array($this->fn, $args);
    self::$callStack[--self::$callStackLength] = null;
    $this->callStackPosition = $oldStackPosition;
    $this->arguments = $oldArguments;
    $this->context = $oldContext;
    return $result;
  }
  function get_arguments() {
    $arguments = $this->arguments;
    if ($arguments === null && $this->callStackPosition !== null) {
      $arguments = $this->arguments = Args::create($this);
    }
    return $arguments;
  }
  function set_arguments($value) {
    return $value;
  }
  function get_caller() {
    $stackPosition = $this->callStackPosition;
    if ($stackPosition !== null && $stackPosition > 0) {
      return self::$callStack[$stackPosition - 1];
    } else {
      return null;
    }
  }
  function set_caller($value) {
    return $value;
  }
  function get_length() {
    $reflection = new ReflectionObject($this->fn);
    $method = $reflection->getMethod('__invoke');
    $arity = $method->getNumberOfParameters();
    if ($this->boundArgs) {
      $boundArgsLength = count($this->boundArgs);
      $arity = ($boundArgsLength >= $arity) ? 0 : $arity - $boundArgsLength;
    }
    return (float)$arity;
  }
  function set_length($value) {
    return $value;
  }
  function toJSON() {
    return null;
  }
  static function getCurrent() {
    return self::$callStack[self::$callStackLength - 1];
  }
  static function getContext() {
    $func = self::$callStack[self::$callStackLength - 1];
    return $func->context;
  }
  static function getArguments() {
    $func = self::$callStack[self::$callStackLength - 1];
    return $func->get_arguments();
  }
  static function getGlobalConstructor() {
    $Function = new Func(function($fn) {
      throw new Ex(Err::create('Cannot construct function at runtime.'));
    });
    $Function->set('prototype', Func::$protoObject);
    $Function->setMethods(Func::$classMethods, true, false, true);
    return $Function;
  }
}
class Args extends Object {
  public $args = null;
  public $length = 0;
  public $callee = null;
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  function toArray() {
    return array_slice($this->args, 0);
  }
  function get_callee() {
    return $this->callee;
  }
  function set_callee($value) {
    return $value;
  }
  function get_caller() {
    return $this->callee->get_caller();
  }
  function set_caller($value) {
    return $value;
  }
  function get_length() {
    return (float)$this->length;
  }
  function set_length($value) {
    return $value;
  }
  static function create($callee) {
    $self = new Args();
    foreach ($callee->args as $i => $arg) {
      $self->set($i, $arg);
      $self->length += 1;
    }
    $self->args = $callee->args;
    $self->callee = $callee;
    return $self;
  }
}
Func::$classMethods = array();
Func::$protoMethods = array(
  'bind' => function($context) {
      $self = Func::getContext();
      $fn = new Func($self->name, $self->fn, $self->meta);
      $fn->boundContext = $context;
      $args = array_slice(func_get_args(), 1);
      if (!empty($args)) {
        $fn->boundArgs = $args;
      }
      return $fn;
    },
  'call' => function() {
      $self = Func::getContext();
      $args = func_get_args();
      return $self->apply($args[0], array_slice($args, 1));
    },
  'apply' => function($context, $args = null) {
      $self = Func::getContext();
      if ($args === null) {
        $args = array();
      } else
      if ($args instanceof Args || $args instanceof Arr) {
        $args = $args->toArray();
      } else {
        throw new Ex(Err::create('Function.prototype.apply: Arguments list has wrong type'));
      }
      return $self->apply($context, $args);
    },
  'toString' => function() {
      $self = Func::getContext();
      $source = array_key_exists('source_', $GLOBALS) ? $GLOBALS['source_'] : null;
      if ($source) {
        $meta = $self->meta;
        if (isset($meta['id']) && isset($source[$meta['id']])) {
          $source = $source[$meta['id']];
          return substr($source, $meta['start'], $meta['end'] - $meta['start'] + 1);
        }
      }
      return 'function ' . $self->name . '() { [native code] }';
    }
);
Func::$protoObject = new Object();
Func::$protoObject->setMethods(Func::$protoMethods, true, false, true);
Object::$protoObject->setMethods(Object::$protoMethods, true, false, true);
class GlobalObject extends Object {
  public $className = "global";
  static $immutable = array('Array' => 1, 'Boolean' => 1, 'Buffer' => 1, 'Date' => 1, 'Error' => 1, 'RangeError' => 1, 'ReferenceError' => 1, 'SyntaxError' => 1, 'TypeError' => 1, 'Function' => 1, 'Infinity' => 1, 'JSON' => 1, 'Math' => 1, 'NaN' => 1, 'Number' => 1, 'Object' => 1, 'RegExp' => 1, 'String' => 1, 'console' => 1, 'decodeURI' => 1, 'decodeURIComponent' => 1, 'encodeURI' => 1, 'encodeURIComponent' => 1, 'escape' => 1, 'eval' => 1, 'isFinite' => 1, 'isNaN' => 1, 'parseFloat' => 1, 'parseInt' => 1, 'undefined' => 1, 'unescape' => 1);
  static $OLD_GLOBALS = null;
  static $SUPER_GLOBALS = array('GLOBALS' => 1, '_SERVER' => 1, '_GET' => 1, '_POST' => 1, '_FILES' => 1, '_COOKIE' => 1, '_SESSION' => 1, '_REQUEST' => 1, '_ENV' => 1);
  static $protoObject = null;
  static $classMethods = null;
  function set($key, $value) {
    if (array_key_exists($key, self::$immutable)) {
      return $value;
    }
    $key = self::encodeVar($key);
    return ($GLOBALS[$key] = $value);
  }
  function get($key) {
    $key = self::encodeVar($key);
    $value = array_key_exists($key, $GLOBALS) ? $GLOBALS[$key] : null;
    return $value;
  }
  function remove($key) {
    if (array_key_exists($key, self::$immutable)) {
      return false;
    }
    $key = self::encodeVar($key);
    if (array_key_exists($key, $GLOBALS)) {
      unset($GLOBALS[$key]);
    }
    return true;
  }
  function hasOwnProperty($key) {
    $key = self::encodeVar($key);
    return array_key_exists($key, $GLOBALS);
  }
  function hasProperty($key) {
    $key = self::encodeVar($key);
    if (array_key_exists($key, $GLOBALS)) {
      return true;
    }
    $proto = $this->proto;
    if ($proto instanceof Object) {
      return $proto->hasProperty($key);
    }
    return false;
  }
  function getOwnKeys($onlyEnumerable) {
    $arr = array();
    foreach ($GLOBALS as $key => $value) {
      if (!array_key_exists($key, self::$SUPER_GLOBALS)) {
        $arr[] = self::decodeVar($key);
      }
    }
    return $arr;
  }
  function getKeys(&$arr = array()) {
    foreach ($GLOBALS as $key => $value) {
      if (!array_key_exists($key, self::$SUPER_GLOBALS)) {
        $arr[] = self::decodeVar($key);
      }
    }
    $proto = $this->proto;
    if ($proto instanceof Object) {
      $proto->getKeys($arr);
    }
    return $arr;
  }
  static function encodeVar($str) {
    if (array_key_exists($str, self::$SUPER_GLOBALS)) {
      return $str . '_';
    }
    $str = preg_replace('/_$/', '__', $str);
    $str = preg_replace_callback('/[^a-zA-Z0-9_]/', 'self::encodeChar', $str);
    return $str;
  }
  static function encodeChar($matches) {
    return '«' . bin2hex($matches[0]) . '»';
  }
  static function decodeVar($str) {
    $len = strlen($str);
    if ($str[$len - 1] === '_') {
      $name = substr($str, 0, $len - 1);
      if (array_key_exists($name, self::$SUPER_GLOBALS)) {
        return $name;
      }
    }
    $str = preg_replace('/__$/', '_', $str);
    $str = preg_replace_callback('/«([a-z0-9]+)»/', 'self::decodeChar', $str);
    return $str;
  }
  static function decodeChar($matches) {
    return pack('H*', $matches[1]);
  }
  static function unsetGlobals() {
    self::$OLD_GLOBALS = array();
    foreach ($GLOBALS as $key => $value) {
      if (!array_key_exists($key, self::$SUPER_GLOBALS)) {
        self::$OLD_GLOBALS[$key] = $value;
        unset($GLOBALS[$key]);
      }
    }
  }
}
GlobalObject::unsetGlobals();
Object::$global = new GlobalObject();
class Arr extends Object {
  public $className = "Array";
  public $length = 0;
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  static $empty = null;
  function __construct() {
    parent::__construct();
    $this->proto = self::$protoObject;
    $this->setProp('length', null, true, false, false);
    if (func_num_args() > 0) {
      $this->init(func_get_args());
    } else {
      $this->length = 0;
    }
  }
  function init($arr) {
    $len = 0;
    foreach ($arr as $i => $item) {
      if ($item !== Arr::$empty) {
        $this->set($i, $item);
      }
      $len += 1;
    }
    $this->length = $len;
  }
  function push($value) {
    $i = $this->length;
    foreach (func_get_args() as $value) {
      $this->set($i, $value);
      $i += 1;
    }
    return ($this->length = $i);
  }
  function shift() {
    $el = $this->get(0);
    $this->shiftElementsBackward(1);
    return $el;
  }
  function unshift($value) {
    $num = func_num_args();
    $this->shiftElementsForward($num);
    foreach (func_get_args() as $i => $value) {
      $this->set($i, $value);
    }
    return $this->length;
  }
  function shiftElementsBackward($num, $startIndex = null) {
    if ($startIndex === null) {
      $startIndex = $num;
    }
    $len = $this->length;
    for ($pos = $startIndex; $pos < $len; $pos++) {
      $newPos = $pos - $num;
      if (array_key_exists($pos, $this->data)) {
        $this->data[$newPos] = $this->data[$pos];
      } else if (array_key_exists($newPos, $this->data)) {
        unset($this->data[$newPos]);
      }
      if (array_key_exists($pos, $this->dscr)) {
        $this->dscr[$newPos] = $this->dscr[$pos];
      } else if (array_key_exists($newPos, $this->dscr)) {
        unset($this->dscr[$newPos]);
      }
    }
    for ($pos = $len - $num; $pos < $len; $pos++) {
      unset($this->data[$pos]);
      unset($this->dscr[$pos]);
    }
    $this->length = $len - $num;
  }
  function shiftElementsForward($num, $startIndex = 0) {
    $pos = $this->length;
    while (($pos--) > $startIndex) {
      $newPos = $pos + $num;
      if (array_key_exists($pos, $this->data)) {
        $this->data[$newPos] = $this->data[$pos];
        unset($this->data[$pos]);
      } else if (array_key_exists($newPos, $this->data)) {
        unset($this->data[$newPos]);
      }
      if (array_key_exists($pos, $this->dscr)) {
        $this->dscr[$newPos] = $this->dscr[$pos];
        unset($this->dscr[$pos]);
      } else if (array_key_exists($newPos, $this->dscr)) {
        unset($this->dscr[$newPos]);
      }
    }
    $this->length += $num;
  }
  static function checkInt($s) {
    if (is_int($s) && $s >= 0) return $s;
    $s = to_string($s);
    return ((string)(int)$s === $s) ? (int)$s : null;
  }
  function set($key, $value) {
    $i = self::checkInt($key);
    if ($i !== null && $i >= $this->length) {
      $this->length = $i + 1;
    }
    return parent::set($key, $value);
  }
  function get_length() {
    return (float)$this->length;
  }
  function set_length($len) {
    $len = self::checkInt($len);
    if ($len === null) {
      throw new Ex(Err::create('Invalid array length'));
    }
    $oldLen = $this->length;
    if ($oldLen > $len) {
      for ($i = $len; $i < $oldLen; $i++) {
        $this->remove($i);
      }
    }
    $this->length = $len;
    return (float)$len;
  }
  function toArray() {
    $results = array();
    $len = $this->length;
    for ($i = 0; $i < $len; $i++) {
      $results[] = $this->get($i);
    }
    return $results;
  }
  static function fromArray($nativeArray) {
    $arr = new Arr();
    $arr->init($nativeArray);
    return $arr;
  }
  static function getGlobalConstructor() {
    $Array = new Func(function($value = null) {
      $arr = new Arr();
      $len = func_num_args();
      if ($len === 1 && is_int_or_float($value)) {
        $arr->length = (int)$value;
      } else if ($len > 0) {
        $arr->init(func_get_args());
      }
      return $arr;
    });
    $Array->set('prototype', Arr::$protoObject);
    $Array->setMethods(Arr::$classMethods, true, false, true);
    return $Array;
  }
}
Arr::$classMethods = array(
  'isArray' => function($arr) {
      return ($arr instanceof Arr);
    }
);
Arr::$protoMethods = array(
  'push' => function($value) {
      $self = Func::getContext();
      $length = call_user_func_array(array($self, 'push'), func_get_args());
      return (float)$length;
    },
  'pop' => function() {
      $self = Func::getContext();
      $i = $self->length - 1;
      $result = $self->get($i);
      $self->remove($i);
      $self->length = $i;
      return $result;
    },
  'unshift' => function($value) {
      $self = Func::getContext();
      $length = call_user_func_array(array($self, 'unshift'), func_get_args());
      return (float)$length;
    },
  'shift' => function() {
      $self = Func::getContext();
      return $self->shift();
    },
  'join' => function($str = ',') {
      $results = array();
      $self = Func::getContext();
      $len = $self->length;
      for ($i = 0; $i < $len; $i++) {
        $value = $self->get($i);
        $results[] = ($value === null || $value === Object::$null) ? '' : to_string($value);
      }
      return join(to_string($str), $results);
    },
  'indexOf' => function($value) {
      $self = Func::getContext();
      $len = $self->length;
      for ($i = 0; $i < $len; $i++) {
        if ($self->get($i) === $value) return (float)$i;
      }
      return -1.0;
    },
  'lastIndexOf' => function($value) {
      $self = Func::getContext();
      $i = $self->length;
      while ($i--) {
        if ($self->get($i) === $value) return (float)$i;
      }
      return -1.0;
    },
  'slice' => function($start = 0, $end = null) {
      $self = Func::getContext();
      $len = $self->length;
      if ($len === 0) {
        return new Arr();
      }
      $start = (int)$start;
      if ($start < 0) {
        $start = $len + $start;
        if ($start < 0) $start = 0;
      }
      if ($start >= $len) {
        return new Arr();
      }
      $end = ($end === null) ? $len : (int)$end;
      if ($end < 0) {
        $end = $len + $end;
      }
      if ($end < $start) {
        $end = $start;
      }
      if ($end > $len) {
        $end = $len;
      }
      $result = new Arr();
      for ($i = $start; $i < $end; $i++) {
        $value = $self->get($i);
        $result->push($value);
      }
      return $result;
    },
  'forEach' => function($fn, $context = null) {
      $self = Func::getContext();
      $len = $self->length;
      for ($i = 0; $i < $len; $i++) {
        if ($self->hasOwnProperty($i)) {
          $fn->call($context, $self->get($i), (float)$i, $self);
        }
      }
    },
  'map' => function($fn, $context = null) {
      $self = Func::getContext();
      $results = new Arr();
      $len = $results->length = $self->length;
      for ($i = 0; $i < $len; $i++) {
        if ($self->hasOwnProperty($i)) {
          $result = $fn->call($context, $self->get($i), (float)$i, $self);
          $results->set($i, $result);
        }
      }
      return $results;
    },
  'filter' => function($fn, $context = null) {
      $self = Func::getContext();
      $results = new Arr();
      $len = $self->length;
      for ($i = 0; $i < $len; $i++) {
        if ($self->hasOwnProperty($i)) {
          $item = $self->get($i);
          $result = $fn->call($context, $item, (float)$i, $self);
          if (is($result)) {
            $results->push($item);
          }
        }
      }
      return $results;
    },
  'sort' => function($fn = null) {
      $self = Func::getContext();
      if ($fn instanceof Func) {
        $results = $self->toArray();
        $comparator = function($a, $b) use (&$fn) {
          return $fn->call(null, $a, $b);
        };
        uasort($results, $comparator);
      } else {
        $results = array();
        $len = $self->length;
        for ($i = 0; $i < $len; $i++) {
          $results[$i] = to_string($self->get($i));
        }
        asort($results, SORT_STRING);
      }
      $i = 0;
      $temp = array();
      foreach ($results as $index => $str) {
        $temp[$i] = $self->data[$index];
        $i += 1;
      }
      foreach ($temp as $i => $prop) {
        $self->data[$i] = $prop;
      }
      return $self;
    },
  'concat' => function() {
      $self = Func::getContext();
      $items = $self->toArray();
      foreach (func_get_args() as $item) {
        if ($item instanceof Arr) {
          foreach ($item->toArray() as $subitem) {
            $items[] = $subitem;
          }
        } else {
          $items[] = $item;
        }
      }
      $arr = new Arr();
      $arr->init($items);
      return $arr;
    },
  'splice' => function($offset, $deleteCount) {
      $offset = (int)$offset;
      $deleteCount = (int)$deleteCount;
      $elements = array_slice(func_get_args(), 2);
      $self = Func::getContext();
      $data = &$self->data;
      unset($data['length']);
      $isSimpleArray = false;
      $len = $self->length;
      if (count($data) === $len) {
        $isSimpleArray = true;
        for ($i = 0; $i < $len; $i++) {
          if (!array_key_exists($i, $data) || array_key_exists($i, $self->dscr)) {
            $isSimpleArray = false;
            break;
          }
        }
      }
      if ($isSimpleArray) {
        array_splice($data, $offset, $deleteCount, $elements);
        $newLength = count($data);
      } else {
        $addCount = count($elements);
        $countChange = $addCount - $deleteCount;
        $nextOffset = $offset + $deleteCount;
        if ($countChange < 0) {
          $self->shiftElementsBackward(abs($countChange), $nextOffset);
        } else if ($countChange > 0) {
          $self->shiftElementsForward($countChange, $nextOffset);
        }
        foreach ($elements as $i => $el) {
          $data[$offset + $i] = $el;
          unset($self->dscr[$offset + $i]);
        }
        $newLength = $len + $countChange;
      }
      $data['length'] = null;
      $self->length = $newLength;
    },
  'reverse' => function() {
      $self = Func::getContext();
      $data = &$self->data;
      $newData = array();
      $dscr = &$self->dscr;
      $newDscr = array();
      $len = $self->length;
      for ($i = 0; $i < $len; $i++) {
        if (array_key_exists($i, $data)) {
          $newData[$len - $i - 1] = $data[$i];
          unset($data[$i]);
        }
        if (array_key_exists($i, $dscr)) {
          $newDscr[$len - $i - 1] = $dscr[$i];
        }
      }
      foreach ($data as $name => $value) {
        $newData[$name] = $value;
        if (array_key_exists($name, $dscr)) {
          $newDscr[$name] = $dscr[$name];
        }
      }
      $self->data = &$newData;
      $self->dscr = &$newDscr;
    },
  'some' => function($fn, $context = null) {
      $self = Func::getContext();
      $len = $self->length;
      for ($i = 0; $i < $len; $i++) {
        if ($self->hasOwnProperty($i)) {
          $item = $self->get($i);
          $result = $fn->call($context, $item, (float)$i, $self);
          if (is($result)) {
            return true;
          }
        }
      }
      return false;
    },
  'every' => function($fn, $context = null) {
      $self = Func::getContext();
      $len = $self->length;
      for ($i = 0; $i < $len; $i++) {
        if ($self->hasOwnProperty($i)) {
          $item = $self->get($i);
          $result = $fn->call($context, $item, (float)$i, $self);
          if (!is($result)) {
            return false;
          }
        }
      }
      return true;
    },
  'reduce' => function($fn, $initValue = null) {
      $self = Func::getContext();
      $value = $initValue;
      $len = $self->length;
      for ($i = 0; $i < $len; $i++) {
        if ($self->hasOwnProperty($i)) {
          $item = $self->get($i);
          $value = $fn->call(null, $value, $item, (float)$i, $self);
        }
      }
      return $value;
    },
  'reduceRight' => function($fn, $initValue = null) {
      $self = Func::getContext();
      $value = $initValue;
      $len = $self->length;
      for ($i = $len - 1; $i >= 0; $i--) {
        if ($self->hasOwnProperty($i)) {
          $item = $self->get($i);
          $value = $fn->call(null, $value, $item, (float)$i, $self);
        }
      }
      return $value;
    },
  'toString' => function() {
      $self = Func::getContext();
      return $self->callMethod('join');
    },
  'toLocaleString' => function() {
      $self = Func::getContext();
      return $self->callMethod('join');
    }
);
Arr::$protoObject = new Object();
Arr::$protoObject->setMethods(Arr::$protoMethods, true, false, true);
Arr::$empty = new StdClass();
class Date extends Object {
  public $className = "Date";
  public $date = null;
  public $value = null;
  static $LOCAL_TZ = null;
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  function __construct() {
    parent::__construct();
    $this->proto = Date::$protoObject;
    if (func_num_args() > 0) {
      $this->init(func_get_args());
    }
  }
  function init($arr) {
    $len = count($arr);
    if ($len === 1 && is_string($arr[0])) {
      $this->_initFromString($arr[0]);
    } else {
      $this->_initFromParts($arr);
    }
  }
  function _initFromString($str) {
    $a = Date::parse($str);
    if ($a['isLocal']) {
      $arr = array($a['year'], $a['month'] - 1, $a['day'], $a['hour'], $a['minute'], $a['second'], $a['ms']);
      $this->_initFromParts($arr);
    } else {
      $date = Date::create('UTC');
      $date->setDate($a['year'], $a['month'], $a['day']);
      $date->setTime($a['hour'], $a['minute'], $a['second']);
      $ms = $date->getTimestamp() * 1000 + $a['ms'];
      $this->date = Date::fromMilliseconds($ms);
      $this->value = $ms;
    }
  }
  function _initFromParts($arr, $tz = null) {
    $len = count($arr);
    if ($len > 1) {
      $arr = array_pad($arr, 7, 0);
      $date = Date::create($tz);
      $date->setDate($arr[0], $arr[1] + 1, $arr[2]);
      $date->setTime($arr[3], $arr[4], $arr[5]);
      $this->date = $date;
      $this->value = (int)($date->getTimestamp() * 1000 + $arr[6]);
    } else {
      $ms = ($len === 1) ? (int)$arr[0] : (int)Date::now();
      $this->date = Date::fromMilliseconds($ms);
      $this->value = $ms;
    }
  }
  function toJSON() {
    $date = Date::fromMilliseconds($this->value, 'UTC');
    $str = $date->format('Y-m-d\TH:i:s');
    $ms = $this->value % 1000;
    if ($ms < 0) $ms = 1000 + $ms;
    if ($ms < 0) $ms = 0;
    return $str . '.' . substr('00' . $ms, -3) . 'Z';
  }
  static function now() {
    return floor(microtime(true) * 1000);
  }
  static function create($tz = null) {
    if ($tz === null) {
      return new DateTime('now', new DateTimeZone(Date::$LOCAL_TZ));
    } else {
      return new DateTime('now', new DateTimeZone($tz));
    }
  }
  static function fromMilliseconds($ms, $tz = null) {
    $date = Date::create($tz);
    $seconds = floor($ms / 1000);
    $date->setTimestamp($seconds);
    return $date;
  }
  static function parse($str) {
    $str = to_string($str);
    $a = date_parse($str);
    if ($a['error_count'] > 0 || $a['warning_count'] > 0) {
      return null;
    }
    $hasTime = ($a['hour'] !== false || $a['minute'] !== false || $a['second'] !== false);
    $tz = array_key_exists('tz_abbr', $a) ? $a['tz_abbr'] : null;
    if ($tz === 'Z' || $tz === 'GMT') {
      $tz = 'UTC';
    }
    $isLocal = ($tz === null && $hasTime === true);
    return array(
      'year' => $a['year'] ?: 1970,
      'month' => $a['month'] ?: 1,
      'day' => $a['day'] ?: 1,
      'hour' => $a['hour'] ?: 0,
      'minute' => $a['minute'] ?: 0,
      'second' => $a['second'] ?: 0,
      'ms' => (int)($a['fraction'] * 1000),
      'timezone' => $tz,
      'isLocal' => $isLocal
    );
  }
  static function getGlobalConstructor() {
    $Date = new Func(function() {
      $date = new Date();
      $date->init(func_get_args());
      return $date;
    });
    $Date->set('prototype', Date::$protoObject);
    $Date->setMethods(Date::$classMethods, true, false, true);
    return $Date;
  }
}
Date::$classMethods = array(
  'now' => function() {
      return Date::now();
    },
  'parse' => function($str) {
      $date = new Date($str);
      return (float)$date->value;
    },
  'UTC' => function() {
      $date = new Date();
      $date->_initFromParts(func_get_args(), 'UTC');
      return (float)$date->value;
    }
);
Date::$protoMethods = array(
  'valueOf' => function() {
      $self = Func::getContext();
      return (float)$self->value;
    },
  'toString' => function() {
      $self = Func::getContext();
      return str_replace('~', 'GMT', $self->date->format('D M d Y H:i:s ~O (T)'));
    },
  'toLocaleString' => function() {
      $self = Func::getContext();
      return str_replace('~', 'GMT', $self->date->format('n/j/Y, g:i:s A'));
    },
  'toJSON' => function() {
      $self = Func::getContext();
      return $self->toJSON();
    },
  'toISOString' => function() {
      $self = Func::getContext();
      return $self->toJSON();
    },
  'toUTCString' => function() {
      $self = Func::getContext();
      $date = Date::fromMilliseconds($self->value, 'UTC');
      return $date->format('D, d M Y H:i:s') . ' GMT';
    },
  'toGMTString' => function() {
      $self = Func::getContext();
      $date = Date::fromMilliseconds($self->value, 'UTC');
      return $date->format('D, d M Y H:i:s') . ' GMT';
    },
  'toDateString' => function() {
      throw new Ex(Err::create('date.toDateString not implemented'));
    },
  'toLocaleDateString' => function() {
      throw new Ex(Err::create('date.toLocaleDateString not implemented'));
    },
  'toTimeString' => function() {
      throw new Ex(Err::create('date.toTimeString not implemented'));
    },
  'toLocaleTimeString' => function() {
      throw new Ex(Err::create('date.toLocaleTimeString not implemented'));
    },
  'getDate' => function() {
      throw new Ex(Err::create('date.getDate not implemented'));
    },
  'getDay' => function() {
      throw new Ex(Err::create('date.getDay not implemented'));
    },
  'getFullYear' => function() {
      throw new Ex(Err::create('date.getFullYear not implemented'));
    },
  'getHours' => function() {
      throw new Ex(Err::create('date.getHours not implemented'));
    },
  'getMilliseconds' => function() {
      throw new Ex(Err::create('date.getMilliseconds not implemented'));
    },
  'getMinutes' => function() {
      throw new Ex(Err::create('date.getMinutes not implemented'));
    },
  'getMonth' => function() {
      throw new Ex(Err::create('date.getMonth not implemented'));
    },
  'getSeconds' => function() {
      throw new Ex(Err::create('date.getSeconds not implemented'));
    },
  'getUTCDate' => function() {
      throw new Ex(Err::create('date.getUTCDate not implemented'));
    },
  'getUTCDay' => function() {
      throw new Ex(Err::create('date.getUTCDay not implemented'));
    },
  'getUTCFullYear' => function() {
      throw new Ex(Err::create('date.getUTCFullYear not implemented'));
    },
  'getUTCHours' => function() {
      throw new Ex(Err::create('date.getUTCHours not implemented'));
    },
  'getUTCMilliseconds' => function() {
      throw new Ex(Err::create('date.getUTCMilliseconds not implemented'));
    },
  'getUTCMinutes' => function() {
      throw new Ex(Err::create('date.getUTCMinutes not implemented'));
    },
  'getUTCMonth' => function() {
      throw new Ex(Err::create('date.getUTCMonth not implemented'));
    },
  'getUTCSeconds' => function() {
      throw new Ex(Err::create('date.getUTCSeconds not implemented'));
    },
  'setDate' => function() {
      throw new Ex(Err::create('date.setDate not implemented'));
    },
  'setFullYear' => function() {
      throw new Ex(Err::create('date.setFullYear not implemented'));
    },
  'setHours' => function() {
      throw new Ex(Err::create('date.setHours not implemented'));
    },
  'setMilliseconds' => function() {
      throw new Ex(Err::create('date.setMilliseconds not implemented'));
    },
  'setMinutes' => function() {
      throw new Ex(Err::create('date.setMinutes not implemented'));
    },
  'setMonth' => function() {
      throw new Ex(Err::create('date.setMonth not implemented'));
    },
  'setSeconds' => function() {
      throw new Ex(Err::create('date.setSeconds not implemented'));
    },
  'setUTCDate' => function() {
      throw new Ex(Err::create('date.setUTCDate not implemented'));
    },
  'setUTCFullYear' => function() {
      throw new Ex(Err::create('date.setUTCFullYear not implemented'));
    },
  'setUTCHours' => function() {
      throw new Ex(Err::create('date.setUTCHours not implemented'));
    },
  'setUTCMilliseconds' => function() {
      throw new Ex(Err::create('date.setUTCMilliseconds not implemented'));
    },
  'setUTCMinutes' => function() {
      throw new Ex(Err::create('date.setUTCMinutes not implemented'));
    },
  'setUTCMonth' => function() {
      throw new Ex(Err::create('date.setUTCMonth not implemented'));
    },
  'setUTCSeconds' => function() {
      throw new Ex(Err::create('date.setUTCSeconds not implemented'));
    },
  'getTimezoneOffset' => function() {
      throw new Ex(Err::create('date.getTimezoneOffset not implemented'));
    },
  'getTime' => function() {
      throw new Ex(Err::create('date.getTime not implemented'));
    },
  'getYear' => function() {
      throw new Ex(Err::create('date.getYear not implemented'));
    },
  'setTime' => function() {
      throw new Ex(Err::create('date.setTime not implemented'));
    },
  'setYear' => function() {
      throw new Ex(Err::create('date.setYear not implemented'));
    }
);
Date::$protoObject = new Object();
Date::$protoObject->setMethods(Date::$protoMethods, true, false, true);
Date::$LOCAL_TZ = getenv('LOCAL_TZ');
if (Date::$LOCAL_TZ === false && defined('LOCAL_TZ')) {
  Date::$LOCAL_TZ = constant('LOCAL_TZ');
}
if (Date::$LOCAL_TZ === false) {
  Date::$LOCAL_TZ = 'UTC';
}
class RegExp extends Object {
  public $className = "RegExp";
  public $source = '';
  public $ignoreCaseFlag = false;
  public $globalFlag = false;
  public $multilineFlag = false;
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  function __construct() {
    parent::__construct();
    $this->proto = self::$protoObject;
    $args = func_get_args();
    if (count($args) > 0) {
      $this->init($args);
    }
  }
  function init($args) {
    $this->source = ($args[0] === null) ? '(?:)' : to_string($args[0]);
    $flags = array_key_exists('1', $args) ? to_string($args[1]) : '';
    $this->ignoreCaseFlag = (strpos($flags, 'i') !== false);
    $this->globalFlag = (strpos($flags, 'g') !== false);
    $this->multilineFlag = (strpos($flags, 'm') !== false);
  }
  function get_source() {
    return $this->source;
  }
  function set_source($value) {
    return $value;
  }
  function get_ignoreCase() {
    return $this->ignoreCaseFlag;
  }
  function set_ignoreCase($value) {
    return $value;
  }
  function get_global() {
    return $this->globalFlag;
  }
  function set_global($value) {
    return $value;
  }
  function get_multiline() {
    return $this->multilineFlag;
  }
  function set_multiline($value) {
    return $value;
  }
  function toString($pcre = true) {
    $source = $this->source;
    $flags = '';
    if ($this->ignoreCaseFlag) {
      $flags .= 'i';
    }
    if (!$pcre && $this->globalFlag) {
      $flags .= 'g';
    }
    if ($pcre) {
      $flags .= 'u';
    }
    if ($this->multilineFlag) {
      $flags .= 'm';
    }
    return '/' . str_replace('/', '\\/', $source) . '/' . $flags;
  }
  static function toReplacementString($str) {
    $str = str_replace('\\', '\\\\', $str);
    $str = str_replace('$&', '$0', $str);
    return $str;
  }
  static function getGlobalConstructor() {
    $RegExp = new Func(function() {
      $reg = new RegExp();
      $reg->init(func_get_args());
      return $reg;
    });
    $RegExp->set('prototype', RegExp::$protoObject);
    $RegExp->setMethods(RegExp::$classMethods, true, false, true);
    return $RegExp;
  }
}
RegExp::$classMethods = array();
RegExp::$protoMethods = array(
  'exec' => function($str) {
      $self = Func::getContext();
      $str = to_string($str);
      $offset = 0;
      $result = preg_match($self->toString(true), $str, $matches, PREG_OFFSET_CAPTURE, $offset);
      if ($result === false) {
        throw new Ex(Err::create('Error executing Regular Expression: ' . $self->toString()));
      }
      if ($result === 0) {
        return Object::$null;
      }
      $index = $matches[0][1];
      $self->set('lastIndex', (float)($index + strlen($matches[0][0])));
      $arr = new Arr();
      foreach ($matches as $match) {
        $arr->push($match[0]);
      }
      $arr->set('index', (float)$index);
      $arr->set('input', $str);
      return $arr;
    },
  'test' => function($str) {
      $self = Func::getContext();
      $result = preg_match($self->toString(true), to_string($str));
      return ($result !== false);
    },
  'toString' => function() {
      $self = Func::getContext();
      return $self->toString(false);
    }
);
RegExp::$protoObject = new Object();
RegExp::$protoObject->setMethods(RegExp::$protoMethods, true, false, true);
class Str extends Object {
  public $className = "String";
  public $value = null;
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  function __construct($str = null) {
    parent::__construct();
    $this->proto = self::$protoObject;
    if (func_num_args() === 1) {
      $this->value = $str;
      $this->length = mb_strlen($str);
    }
  }
  function get_length() {
    return (float)$this->length;
  }
  function set_length($len) {
    return $len;
  }
  function get($key) {
    if (is_float($key)) {
      if ((float)(int)$key === $key && $key >= 0) {
        return $this->callMethod('charAt', $key);
      }
    }
    return parent::get($key);
  }
  static function getGlobalConstructor() {
    $String = new Func(function($value = '') {
      $self = Func::getContext();
      if ($self instanceof Str) {
        $self->value = to_string($value);
        return $self;
      } else {
        return to_string($value);
      }
    });
    $String->instantiate = function() {
      return new Str();
    };
    $String->set('prototype', Str::$protoObject);
    $String->setMethods(Str::$classMethods, true, false, true);
    return $String;
  }
}
Str::$classMethods = array(
  'fromCharCode' => function($code) {
      return chr($code);
    }
);
Str::$protoMethods = array(
  'charAt' => function($i) {
      $self = Func::getContext();
      $ch = mb_substr($self->value, $i, 1);
      return ($ch === false) ? '' : $ch;
    },
  'charCodeAt' => function($i) {
      $self = Func::getContext();
      $ch = mb_substr($self->value, $i, 1);
      if ($ch === false) return NAN;
      $len = strlen($ch);
      if ($len === 1) {
        $code = ord($ch[0]);
      } else {
        $ch = mb_convert_encoding($ch, 'UCS-2LE', 'UTF-8');
        $code = ord($ch[1]) * 256 + ord($ch[0]);
      }
      return (float)$code;
    },
  'indexOf' => function($search, $offset = 0) {
      $self = Func::getContext();
      $index = mb_strpos($self->value, $search, $offset);
      return ($index === false) ? -1.0 : (float)$index;
    },
  'lastIndexOf' => function($search, $offset = null) {
      $self = Func::getContext();
      $str = $self->value;
      if ($offset !== null) {
        $offset = to_number($offset);
        if ($offset > 0 && $offset < $self->length) {
          $str = mb_substr($str, 0, $offset + 1);
        }
      }
      $index = mb_strrpos($str, $search);
      return ($index === false) ? -1.0 : (float)$index;
    },
  'split' => function($delim) {
      $self = Func::getContext();
      $str = $self->value;
      if ($delim instanceof RegExp) {
        $arr = preg_split($delim->toString(true), $str);
      } else {
        $delim = to_string($delim);
        if ($delim === '') {
          $len = mb_strlen($str);
          $arr = array();
          for ($i = 0; $i < $len; $i++) {
            $arr[] = mb_substr($str, $i, 1);
          }
        } else {
          $arr = explode($delim, $str);
        }
      }
      return Arr::fromArray($arr);
    },
  'substr' => function($start, $num = null) {
      $self = Func::getContext();
      $len = $self->length;
      if ($len === 0) {
        return '';
      }
      $start = (int)$start;
      if ($start < 0) {
        $start = $len + $start;
        if ($start < 0) $start = 0;
      }
      if ($start >= $len) {
        return '';
      }
      if ($num === null) {
        return mb_substr($self->value, $start);
      } else {
        return mb_substr($self->value, $start, $num);
      }
    },
  'substring' => function($start, $end = null) {
      $self = Func::getContext();
      $len = $self->length;
      if (func_num_args() === 1) {
        $end = $len;
      }
      $start = (int)$start;
      $end = (int)$end;
      if ($start < 0) $start = 0;
      if ($start > $len) $start = $len;
      if ($end < 0) $end = 0;
      if ($end > $len) $end = $len;
      if ($start === $end) {
        return '';
      }
      if ($end < $start) {
        list($start, $end) = array($end, $start);
      }
      return mb_substr($self->value, $start, $end - $start);
    },
  'slice' => function($start, $end = null) {
      $self = Func::getContext();
      $len = $self->length;
      if ($len === 0) {
        return '';
      }
      $start = (int)$start;
      if ($start < 0) {
        $start = $len + $start;
        if ($start < 0) $start = 0;
      }
      if ($start >= $len) {
        return '';
      }
      $end = ($end === null) ? $len : (int)$end;
      if ($end < 0) {
        $end = $len + $end;
      }
      if ($end < $start) {
        $end = $start;
      }
      if ($end > $len) {
        $end = $len;
      }
      return mb_substr($self->value, $start, $end - $start);
    },
  'trim' => function() {
      $self = Func::getContext();
      return preg_replace('/^[\s\x0B\xA0]+|[\s\x0B\​xA0]+$/u', '', $self->value);
    },
  'match' => function($regex) use (&$RegExp) {
      $self = Func::getContext();
      $str = $self->value;
      if (!($regex instanceof RegExp)) {
        $regex = $RegExp->construct($regex);
      }
      if (!$regex->globalFlag) {
        return $regex->callMethod('exec', $str);
      }
      $results = new Arr();
      $index = 0;
      $preg = $regex->toString(true);
      while (preg_match($preg, $str, $matches, PREG_OFFSET_CAPTURE, $index) === 1) {
        $foundAt = $matches[0][1];
        $foundStr = $matches[0][0];
        $index = $foundAt + strlen($foundStr);
        $results->push($foundStr);
      }
      return $results;
    },
  'replace' => function($search, $replace) {
      $self = Func::getContext();
      $str = $self->value;
      $isRegEx = ($search instanceof RegExp);
      $limit = ($isRegEx && $search->globalFlag) ? -1 : 1;
      $search = $isRegEx ? $search->toString(true) : to_string($search);
      if ($replace instanceof Func) {
        if ($isRegEx) {
          $count = 0;
          $offset = 0;
          $result = array();
          $success = null;
          while (
              ($limit === -1 || $count < $limit) &&
              ($success = preg_match($search, $str, $matches, PREG_OFFSET_CAPTURE, $offset))
            ) {
            $matchIndex = $matches[0][1];
            $args = array();
            foreach ($matches as $match) {
              $args[] = $match[0];
            }
            $result[] = substr($str, $offset, $matchIndex - $offset);
            $mbIndex = mb_strlen(substr($str, 0, $matchIndex));
            array_push($args, $mbIndex);
            array_push($args, $str);
            $result[] = to_string($replace->apply(null, $args));
            $offset = $matchIndex + strlen($args[0]);
            $count += 1;
          }
          if ($success === false) {
            throw new Ex(Err::create('String.prototype.replace() failed'));
          }
          $result[] = substr($str, $offset);
          return join('', $result);
        } else {
          $matchIndex = strpos($str, $search);
          if ($matchIndex === false) {
            return $str;
          }
          $before = substr($str, 0, $matchIndex);
          $after = substr($str, $matchIndex + strlen($search));
          $args = array($search, mb_strlen($before), $str);
          return $before . to_string($replace->apply(null, $args)) . $after;
        }
      }
      $replace = to_string($replace);
      if ($isRegEx) {
        $replace = RegExp::toReplacementString($replace);
        return preg_replace($search, $replace, $str, $limit);
      } else {
        $parts = explode($search, $str);
        $first = array_shift($parts);
        return $first . $replace . implode($search, $parts);
      }
    },
  'concat' => function() {
      $self = Func::getContext();
      $result = array($self->value);
      foreach (func_get_args() as $arg) {
        $result[] = to_string($arg);
      }
      return implode('', $result);
    },
  'search' => function($regex) use (&$RegExp) {
      $self = Func::getContext();
      if (!($regex instanceof RegExp)) {
        $regex = $RegExp->construct($regex);
      }
      $preg = $regex->toString(true);
      $success = preg_match($preg, $self->value, $matches, PREG_OFFSET_CAPTURE);
      if (!$success) {
        return -1;
      }
      $start = substr($self->value, 0, $matches[0][1]);
      $startLen = mb_strlen($start);
      return (float)$startLen;
    },
  'toLowerCase' => function() {
      $self = Func::getContext();
      return mb_strtolower($self->value);
    },
  'toLocaleLowerCase' => function() {
      $self = Func::getContext();
      return mb_strtolower($self->value);
    },
  'toUpperCase' => function() {
      $self = Func::getContext();
      return mb_strtoupper($self->value);
    },
  'toLocaleUpperCase' => function() {
      $self = Func::getContext();
      return mb_strtoupper($self->value);
    },
  'localeCompare' => function($compareTo) {
      $self = Func::getContext();
      return (float)strcmp($self->value, to_string($compareTo));
    },
  'valueOf' => function() {
      $self = Func::getContext();
      return $self->value;
    },
  'toString' => function() {
      $self = Func::getContext();
      return $self->value;
    }
);
Str::$protoObject = new Object();
Str::$protoObject->setMethods(Str::$protoMethods, true, false, true);
class Number extends Object {
  public $className = "Number";
  public $value = null;
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  function __construct($value = null) {
    parent::__construct();
    $this->proto = self::$protoObject;
    if (func_num_args() === 1) {
      $this->value = (float)$value;
    }
  }
  static function getGlobalConstructor() {
    $Number = new Func(function($value = 0) {
      $self = Func::getContext();
      if ($self instanceof Number) {
        $self->value = to_number($value);
        return $self;
      } else {
        return to_number($value);
      }
    });
    $Number->instantiate = function() {
      return new Number();
    };
    $Number->set('prototype', Number::$protoObject);
    $Number->setMethods(Number::$classMethods, true, false, true);
    $Number->set('NaN', NAN);
    $Number->set('MAX_VALUE', 1.8e308);
    $Number->set('MIN_VALUE', -1.8e308);
    $Number->set('NEGATIVE_INFINITY', -INF);
    $Number->set('POSITIVE_INFINITY', INF);
    return $Number;
  }
}
Number::$classMethods = array(
  'isFinite' => function($value) {
      $value = to_number($value);
      return !($value === INF || $value === -INF || is_nan($value));
    },
  'parseInt' => function($value, $radix = null) {
      $value = to_string($value);
      $value = preg_replace('/^[\\t\\x0B\\f \\xA0\\r\\n]+/', '', $value);
      $sign = ($value[0] === '-') ? -1 : 1;
      $value = preg_replace('/^[+-]/', '', $value);
      if ($radix === null && strtolower(substr($value, 0, 2)) === '0x') {
        $radix = 16;
      }
      if ($radix === null) {
        $radix = 10;
      } else {
        $radix = to_number($radix);
        if (is_nan($radix) || $radix < 2 || $radix > 36) {
          return NAN;
        }
      }
      if ($radix === 10) {
        return preg_match('/^[0-9]/', $value) ? (float)(intval($value) * $sign) : NAN;
      } elseif ($radix === 16) {
        $value = preg_replace('/^0x/i', '', $value);
        return preg_match('/^[0-9a-f]/i', $value) ? (float)(hexdec($value) * $sign) : NAN;
      } elseif ($radix === 8) {
        return preg_match('/^[0-7]/', $value) ? (float)(octdec($value) * $sign) : NAN;
      }
      $value = strtoupper($value);
      $len = strlen($value);
      $numValidChars = 0;
      for ($i = 0; $i < $len; $i++) {
        $n = ord($value[$i]);
        if ($n >= 48 && $n <= 57) {
          $n = $n - 48;
        } elseif ($n >= 65 && $n <= 90) {
          $n = $n - 55;
        } else {
          $n = 36;
        }
        if ($n < $radix) {
          $numValidChars += 1;
        } else {
          break;
        }
      }
      if ($numValidChars > 0) {
        $value = substr($value, 0, $numValidChars);
        return floatval(base_convert($value, $radix, 10));
      }
      return NAN;
    },
  'parseFloat' => function($value) {
      $value = to_string($value);
      $value = preg_replace('/^[\\t\\x0B\\f \\xA0\\r\\n]+/', '', $value);
      $sign = ($value[0] === '-') ? -1 : 1;
      $value = preg_replace('/^[+-]/', '', $value);
      if (preg_match('/^(\d+\.\d*|\.\d+|\d+)e([+-]?[0-9]+)/i', $value, $m)) {
        return (float)($sign * $m[1] * pow(10, $m[2]));
      }
      if (preg_match('/^(\d+\.\d*|\.\d+|\d+)/i', $value, $m)) {
        return (float)($m[0] * $sign);
      }
      return NAN;
    },
  'isNaN' => function($value) {
      return is_nan(to_number($value));
    }
);
Number::$protoMethods = array(
  'valueOf' => function() {
      $self = Func::getContext();
      return $self->value;
    },
  'toString' => function($radix = null) {
      $self = Func::getContext();
      return to_string($self->value);
    }
);
Number::$protoObject = new Object();
Number::$protoObject->setMethods(Number::$protoMethods, true, false, true);
class Bln extends Object {
  public $className = "Boolean";
  public $value = null;
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  function __construct($value = null) {
    parent::__construct();
    $this->proto = self::$protoObject;
    if (func_num_args() === 1) {
      $this->value = $value;
    }
  }
  static function getGlobalConstructor() {
    $Boolean = new Func(function($value = false) {
      $self = Func::getContext();
      if ($self instanceof Bln) {
        $self->value = $value ? true : false;
        return $self;
      } else {
        return $value ? true : false;
      }
    });
    $Boolean->instantiate = function() {
      return new Bln();
    };
    $Boolean->set('prototype', Bln::$protoObject);
    $Boolean->setMethods(Bln::$classMethods, true, false, true);
    return $Boolean;
  }
}
Bln::$classMethods = array();
Bln::$protoMethods = array(
  'valueOf' => function() {
      $self = Func::getContext();
      return $self->value;
    },
  'toString' => function() {
      $self = Func::getContext();
      return to_string($self->value);
    }
);
Bln::$protoObject = new Object();
Bln::$protoObject->setMethods(Bln::$protoMethods, true, false, true);
class Err extends Object {
  public $className = "Error";
  public $stack = null;
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  function __construct($str = null) {
    parent::__construct();
    $this->proto = self::$protoObject;
    if (func_num_args() === 1) {
      $this->set('message', to_string($str));
    }
  }
  public function getMessage() {
    $message = $this->get('message');
    return $this->className . ($message ? ': ' . $message : '');
  }
  static function create($str, $framesToPop = 0) {
    $error = new Err($str);
    $stack = debug_backtrace();
    while ($framesToPop--) {
      array_shift($stack);
    }
    $error->stack = $stack;
    return $error;
  }
  static function getGlobalConstructor() {
    $Error = new Func(function($str = null) {
      $error = new Err($str);
      $error->stack = debug_backtrace();
      return $error;
    });
    $Error->set('prototype', Err::$protoObject);
    $Error->setMethods(Err::$classMethods, true, false, true);
    return $Error;
  }
}
class RangeErr extends Err {
  public $className = "RangeError";
}
class ReferenceErr extends Err {
  public $className = "ReferenceError";
}
class SyntaxErr extends Err {
  public $className = "SyntaxError";
}
class TypeErr extends Err {
  public $className = "TypeError";
}
Err::$classMethods = array();
Err::$protoMethods = array(
  'toString' => function() {
      $self = Func::getContext();
      return $self->get('message');
    }
);
Err::$protoObject = new Object();
Err::$protoObject->setMethods(Err::$protoMethods, true, false, true);
class Ex extends Exception {
  const MAX_STR_LEN = 32;
  public $value = null;
  static $errorOutputHandlers = array();
  function __construct($value) {
    if ($value instanceof Err) {
      $message = $value->getMessage();
    } else {
      $message = to_string($value);
    }
    parent::__construct($message);
    $this->value = $value;
  }
  static function handleError($level, $message, $file, $line, $context) {
    if ($level === E_NOTICE) {
      return false;
    }
    $err = Err::create($message, 1);
    $err->set('level', $level);
    throw new Ex($err);
  }
  static function handleException($ex) {
    global $console;
    $stack = null;
    $output = array();
    if ($ex instanceof Ex) {
      $value = $ex->value;
      if ($value instanceof Err) {
        $stack = $value->stack;
        $frame = array_shift($stack);
        if (isset($frame['file'])) {
          $output[] = $frame['file'] . "(" . $frame['line'] . ")\n";
        }
        $output[] = $value->getMessage() . "\n";
      }
    }
    if ($stack === null) {
      $output[] = $ex->getFile() . "(" . $ex->getLine() . ")\n";
      $output[] = $ex->getMessage() . "\n";
      $stack = $ex->getTrace();
    }
    $output[] = self::renderStack($stack) . "\n";
    $output[] = "----\n";
    $output = implode('', $output);
    foreach(self::$errorOutputHandlers as $fn) {
      $fn($output);
    }
    if (isset($console) && ($console instanceof Object)) {
      $console->callMethod('log', $output);
    } else {
      echo $output;
    }
    exit(1);
  }
  static function renderStack($stack) {
    $lines = array();
    foreach ($stack as $frame) {
      $args = isset($frame['args']) ? $frame['args'] : array();
      $list = array();
      foreach ($args as $arg) {
        if (is_string($arg)) {
          $list[] = self::stringify($arg);
        } else if (is_array($arg)) {
          $list[] = 'array()';
        } else if (is_null($arg)) {
          $list[] = 'null';
        } else if (is_bool($arg)) {
          $list[] = ($arg) ? 'true' : 'false';
        } else if (is_object($arg)) {
          $class = get_class($arg);
          if ($arg instanceof Object) {
            $constructor = $arg->get('constructor');
            if ($constructor instanceof Func && $constructor->name) {
              $class .= '[' . $constructor->name . ']';
            }
          }
          $list[] = $class;
        } else if (is_resource($arg)) {
          $list[] = get_resource_type($arg);
        } else {
          $list[] = $arg;
        }
      }
      $function = $frame['function'];
      if ($function === '{closure}') {
        $function = '<anonymous>';
      }
      if (isset($frame['class'])) {
        $function = $frame['class'] . '->' . $function;
      }
      $line = '    at ';
      if (isset($frame['file'])) {
        $line .= $frame['file'] . '(' . $frame['line'] . ') ';
      }
      $line .= $function . '(' . join(', ', $list) . ') ';
      array_push($lines, $line);
    }
    return join("\n", $lines);
  }
  static function stringify($str) {
    $len = strlen($str);
    if ($len === 0) {
      return "''";
    }
    $str = preg_replace('/^[^\x20-\x7E]+/', '', $str, 1);
    $trimAt = null;
    $hasExtendedChars = preg_match('/[^\x20-\x7E]/', $str, $matches, PREG_OFFSET_CAPTURE);
    if ($hasExtendedChars === 1) {
      $trimAt = $matches[0][1];
    }
    if ($len > self::MAX_STR_LEN) {
      $trimAt = ($trimAt === null) ? self::MAX_STR_LEN : min($trimAt, self::MAX_STR_LEN);
    }
    if ($trimAt !== null) {
      return "'" . substr($str, 0, $trimAt) . "...'($len)";
    } else {
      return "'" . $str . "'";
    }
  }
}
if (function_exists('set_error_handler')) {
  set_error_handler(array('Ex', 'handleError'));
}
if (function_exists('set_exception_handler')) {
  set_exception_handler(array('Ex', 'handleException'));
}
class Buffer extends Object {
  public $raw = '';
  public $length = 0;
  static $protoObject = null;
  static $classMethods = null;
  static $protoMethods = null;
  static $SHOW_MAX = 51;
  function __construct() {
    parent::__construct();
    $this->proto = self::$protoObject;
    if (func_num_args() > 0) {
      $this->init(func_get_args());
    }
  }
  function init($args) {
    global $Buffer;
    list($subject, $encoding, $offset) = array_pad($args, 3, null);
    $type = gettype($subject);
    if ($type === 'integer' || $type === 'double') {
      $this->raw = str_repeat("\0", (int)$subject);
    } else if ($type === 'string') {
      $encoding = ($encoding === null) ? 'utf8' : to_string($encoding);
      if ($encoding === 'hex') {
        $this->raw = pack('H*', $subject);
      } else if ($encoding === 'base64') {
        $this->raw = base64_decode($subject);
      } else {
        $this->raw = $subject;
      }
    } else if (_instanceof($subject, $Buffer)) {
      $this->raw = $subject->raw;
    } else if ($subject instanceof Arr) {
      $this->raw = $util['arrToRaw']($subject);
    } else {
      throw new Ex(Err::create('Invalid parameters to construct Buffer'));
    }
    $len = strlen($this->raw);
    $this->length = $len;
    $this->set('length', (float)$len);
  }
  function toJSON($max = null) {
    $raw = $this->raw;
    if ($max !== null && $max < strlen($raw)) {
      return '<Buffer ' . bin2hex(substr($raw, 0, $max)) . '...>';
    } else {
      return '<Buffer ' . bin2hex($raw) . '>';
    }
  }
  static function getGlobalConstructor() {
    $Buffer = new Func('Buffer', function() {
      $self = new Buffer();
      $self->init(func_get_args());
      return $self;
    });
    $Buffer->set('prototype', Buffer::$protoObject);
    $Buffer->setMethods(Buffer::$classMethods, true, false, true);
    return $Buffer;
  }
}
Buffer::$classMethods = array(
  'isBuffer' => function($obj) {
      global $Buffer;
      return _instanceof($obj, $Buffer);
    },
  'concat' => function( $list, $totalLength = null) {
      if (!($list instanceof Arr)) {
        throw new Ex(Err::create('Usage: Buffer.concat(array, [length])'));
      }
      $rawList = array();
      $length = 0;
      foreach ($list->toArray() as $buffer) {
        if (!($buffer instanceof Buffer)) {
          throw new Ex(Err::create('Usage: Buffer.concat(array, [length])'));
        }
        $rawList[] = $buffer->raw;
        $length += $buffer->length;
      }
      $newRaw = join('', $rawList);
      if ($totalLength !== null) {
        $totalLength = (int)$totalLength;
        if ($totalLength > $length) {
          $newRaw .= str_repeat("\0", $totalLength - $length);
        } else if ($totalLength < $length) {
          $newRaw = substr($newRaw, 0, $totalLength);
        }
        $length = $totalLength;
      }
      $newBuffer = new Buffer();
      $newBuffer->raw = $newRaw;
      $newBuffer->length = $length;
      $newBuffer->set('length', (float)$length);
      return $newBuffer;
    },
  'byteLength' => function($string, $enc = null) {
      $b = new Buffer($string, $enc);
      return $b->length;
    }
);
Buffer::$protoMethods = array(
  'get' => function($index) {
      $self = Func::getContext();
      $i = (int)$index;
      if ($i < 0 || $i >= $self->length) {
        throw new Ex(Err::create('offset is out of bounds'));
      }
      return (float)ord($self->raw[$i]);
    },
  'set' => function($index, $byte) {
      $self = Func::getContext();
      $i = (int)$index;
      if ($i < 0 || $i >= $self->length) {
        throw new Ex(Err::create('offset is out of bounds'));
      }
      $old = $self->raw;
      $self->raw = substr($old, 0, $i) . chr($byte) . substr($old, $i + 1);
      return $self->raw;
    },
  'write' => function($data ) {
      $self = Func::getContext();
      $args = array_slice(func_get_args(), 1);
      $count = func_num_args() - 1;
      $offset = null; $len = null; $enc = null;
      if ($count > 0) {
        if (is_string($args[0])) {
          $enc = array_shift($args);
          $offset = array_shift($args);
          $len = array_shift($args);
        } else if (is_int_or_float($args[0])) {
          $offset = array_shift($args);
          $enc = array_pop($args);
          $len = array_pop($args);
          if (is_int_or_float($enc)) {
            list($len, $enc) = array($enc, $len);
          }
        }
      }
      if (!($data instanceof Buffer)) {
        $data = new Buffer($data, $enc);
      }
      $new = $data->raw;
      if ($len !== null) {
        $newLen = (int)$len;
        $new = substr($new, 0, $newLen);
      } else {
        $newLen = $data->length;
      }
      $offset = (int)$offset;
      $old = $self->raw;
      $oldLen = $self->length;
      if ($offset + $newLen > strlen($old)) {
        $newLen = $oldLen - $offset;
      }
      $pre = ($offset === 0) ? '' : substr($old, 0, $offset);
      $self->raw = $pre . $new . substr($old, $offset + $newLen);
    },
  'slice' => function($start, $end = null) {
      $self = Func::getContext();
      $len = $self->length;
      if ($len === 0) {
        return new Buffer(0);
      }
      $start = (int)$start;
      if ($start < 0) {
        $start = $len + $start;
        if ($start < 0) $start = 0;
      }
      if ($start >= $len) {
        return new Buffer(0);
      }
      $end = ($end === null) ? $len : (int)$end;
      if ($end < 0) {
        $end = $len + $end;
      }
      if ($end < $start) {
        $end = $start;
      }
      if ($end > $len) {
        $end = $len;
      }
      $new = substr($self->raw, $start, $end - $start);
      return new Buffer($new, 'binary');
    },
  'toString' => function($enc = 'utf8', $start = null, $end = null) {
      $self = Func::getContext();
      $raw = $self->raw;
      if (func_num_args() > 1) {
        $raw = substr($raw, $start, $end - $start + 1);
      }
      if ($enc === 'hex') {
        return bin2hex($raw);
      }
      if ($enc === 'base64') {
        return base64_encode($raw);
      }
      return $raw;
    },
  'toJSON' => function() {
      $self = Func::getContext();
      return $self->toJSON();
    },
  'inspect' => function() {
      $self = Func::getContext();
      return $self->toJSON(Buffer::$SHOW_MAX);
    }
);
Buffer::$protoObject = new Object();
Buffer::$protoObject->setMethods(Buffer::$protoMethods, true, false, true);
$global = Object::$global;
$undefined = null;
$Infinity = INF;
$NaN = NAN;
$Object = Object::getGlobalConstructor();
$Function = Func::getGlobalConstructor();
$Array = Arr::getGlobalConstructor();
$Boolean = Bln::getGlobalConstructor();
$Number = Number::getGlobalConstructor();
$String = Str::getGlobalConstructor();
$Date = Date::getGlobalConstructor();
$Error = Err::getGlobalConstructor();
$RangeError = RangeErr::getGlobalConstructor();
$ReferenceError = ReferenceErr::getGlobalConstructor();
$SyntaxError = SyntaxErr::getGlobalConstructor();
$TypeError = TypeErr::getGlobalConstructor();
$RegExp = RegExp::getGlobalConstructor();
$Buffer = Buffer::getGlobalConstructor();
call_user_func(function() use (&$escape, &$unescape, &$encodeURI, &$decodeURI, &$encodeURIComponent, &$decodeURIComponent) {
  $ord = function($ch) {
    $i = ord($ch[0]);
    if ($i <= 0x7F) {
      return $i;
    } else if ($i < 0xC2) {
      return $i; 
    } else if ($i <= 0xDF) {
      return ($i & 0x1F) << 6 | (ord($ch[1]) & 0x3F);
    } else if ($i <= 0xEF) {
      return ($i & 0x0F) << 12 | (ord($ch[1]) & 0x3F) << 6 | (ord($ch[2]) & 0x3F);
    } else if ($i <= 0xF4) {
      return ($i & 0x0F) << 18 | (ord($ch[1]) & 0x3F) << 12 | (ord($ch[2]) & 0x3F) << 6 | (ord($ch[3]) & 0x3F);
    } else {
      return $i; 
    }
  };
  $chr = function($i) {
    if ($i <= 0x7F) return chr($i);
    if ($i <= 0x7FF) return chr(0xC0 | ($i >> 6)) . chr(0x80 | ($i & 0x3F));
    if ($i <= 0xFFFF) return chr(0xE0 | ($i >> 12)) . chr(0x80 | ($i >> 6) & 0x3F) . chr(0x80 | $i & 0x3F);
    return chr(0xF0 | ($i >> 18)) . chr(0x80 | ($i >> 12) & 0x3F) . chr(0x80 | ($i >> 6) & 0x3F) . chr(0x80 | $i & 0x3F);
  };
  $escape = new Func(function($str) use (&$ord) {
    $result = '';
    $length = mb_strlen($str);
    for ($i = 0; $i < $length; $i++) {
      $ch = mb_substr($str, $i, 1);
      $j = $ord($ch);
      if ($j <= 41 || $j === 44 || ($j >= 58 && $j <= 63) || ($j >= 91 && $j <= 94) || $j === 96 || ($j >= 123 && $j <= 255)) {
        $result .= '%' . strtoupper($j < 16 ? '0' . dechex($j) : dechex($j));
      } else if ($j > 255) {
        $result .= '%u' . strtoupper($j < 4096 ? '0' . dechex($j) : dechex($j));
      } else {
        $result .= $ch;
      }
    }
    return $result;
  });
  $unescape = new Func(function($str) use (&$chr) {
    $result = '';
    $length = strlen($str);
    for ($i = 0; $i < $length; $i++) {
      $ch = $str[$i];
      if ($ch === '%' && $length > $i + 2) {
        if ($str[$i + 1] === 'u') {
          if ($length > $i + 4) {
            $hex = substr($str, $i + 2, 4);
            if (ctype_xdigit($hex)) {
              $result .= $chr(hexdec($hex));
              $i += 5;
              continue;
            }
          }
        } else {
          $hex = substr($str, $i + 1, 2);
          if (ctype_xdigit($hex)) {
            $result .= $chr(hexdec($hex));
            $i += 2;
            continue;
          }
        }
      }
      $result .= $ch;
    }
    return $result;
  });
  $encodeURI = new Func(function($str) {
    $result = '';
    $length = strlen($str);
    for ($i = 0; $i < $length; $i++) {
      $ch = substr($str, $i, 1);
      $j = ord($ch);
      if ($j === 33 || $j === 35 || $j === 36 || ($j >= 38 && $j <= 59) || $j === 61 || ($j >= 63 && $j <= 90) || $j === 95 || ($j >= 97 && $j <= 122) || $j === 126) {
        $result .= $ch;
      } else {
        $result .= '%' . strtoupper($j < 16 ? '0' . dechex($j) : dechex($j));
      }
    }
    return $result;
  });
  $decodeURI = new Func(function($str) {
    $result = '';
    $length = strlen($str);
    for ($i = 0; $i < $length; $i++) {
      $ch = $str[$i];
      if ($ch === '%' && $length > $i + 2) {
        $hex = substr($str, $i + 1, 2);
        if (ctype_xdigit($hex)) {
          $j = hexdec($hex);
          if ($j !== 35 && $j !== 36 && $j !== 38 && $j !== 43 && $j !== 44 && $j !== 47 && $j !== 58 && $j !== 59 && $j !== 61 && $j !== 63 && $j !== 64) {
            $result .= chr($j);
            $i += 2;
            continue;
          }
        }
      }
      $result .= $ch;
    }
    return $result;
  });
  $encodeURIComponent = new Func(function($str) {
    $result = '';
    $length = strlen($str);
    for ($i = 0; $i < $length; $i++) {
      $ch = substr($str, $i, 1);
      $j = ord($ch);
      if ($j === 33 || ($j >= 39 && $j <= 42) || $j === 45 || $j === 46 || ($j >= 48 && $j <= 57) || ($j >= 65 && $j <= 90) || $j === 95 || ($j >= 97 && $j <= 122) || $j === 126) {
        $result .= $ch;
      } else {
        $result .= '%' . strtoupper($j < 16 ? '0' . dechex($j) : dechex($j));
      }
    }
    return $result;
  });
  $decodeURIComponent = new Func(function($str) {
    return rawurldecode($str);
  });
});
$isNaN = $Number->get('isNaN');
$isFinite = $Number->get('isFinite');
$parseInt = $Number->get('parseInt');
$parseFloat = $Number->get('parseFloat');
$Math = call_user_func(function() {
  $randMax = mt_getrandmax();
  $methods = array(
    'random' => function() use (&$randMax) {
        return (float)(mt_rand() / ($randMax + 1));
      },
    'round' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)round($num);
      },
    'ceil' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)ceil($num);
      },
    'floor' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)floor($num);
      },
    'abs' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)abs($num);
      },
    'max' => function() {
        $max = -INF;
        foreach (func_get_args() as $num) {
          $num = to_number($num);
          if (is_nan($num)) return NAN;
          if ($num > $max) $max = $num;
        }
        return (float)$max;
      },
    'min' => function() {
        $min = INF;
        foreach (func_get_args() as $num) {
          $num = to_number($num);
          if (is_nan($num)) return NAN;
          if ($num < $min) $min = $num;
        }
        return (float)$min;
      },
    'pow' => function($num, $exp) {
        $num = to_number($num);
        $exp = to_number($exp);
        if (is_nan($num) || is_nan($exp)) {
          return NAN;
        }
        return (float)pow($num, $exp);
      },
    'log' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)log($num);
      },
    'exp' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)exp($num);
      },
    'sqrt' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)sqrt($num);
      },
    'sin' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)sin($num);
      },
    'cos' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)cos($num);
      },
    'tan' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)tan($num);
      },
    'atan' => function($num) {
        $num = to_number($num);
        return is_nan($num) ? NAN : (float)atan($num);
      },
    'atan2' => function($y, $x) {
        $y = to_number($y);
        $x = to_number($x);
        if (is_nan($y) || is_nan($x)) {
          return NAN;
        }
        return (float)atan2($y, $x);
      }
  );
  $constants = array(
    'E' => M_E,
    'LN10' => M_LN10,
    'LN2' => M_LN2,
    'LOG10E' => M_LOG10E,
    'LOG2E' => M_LOG2E,
    'PI' => M_PI,
    'SQRT1_2' => M_SQRT1_2,
    'SQRT2' => M_SQRT2
  );
  $Math = new Object();
  $Math->setMethods($methods, true, false, true);
  $Math->setProps($constants, true, false, true);
  return $Math;
});
$JSON = call_user_func(function() {
  $decode = function($value) use (&$decode) {
    if ($value === null) {
      return Object::$null;
    }
    $type = gettype($value);
    if ($type === 'integer') {
      return (float)$value;
    }
    if ($type === 'string' || $type === 'boolean' || $type === 'double') {
      return $value;
    }
    if ($type === 'array') {
      $result = new Arr();
      foreach ($value as $item) {
        $result->push($decode($item));
      }
    } else {
      $result = new Object();
      foreach ($value as $key => $item) {
        if ($key === '_empty_') {
          $key = '';
        }
        $result->set($key, $decode($item));
      }
    }
    return $result;
  };
  $escape = function($str) {
    return str_replace("\\/", "/", json_encode($str));
  };
  $encode = function($parent, $key, $value, $opts, $encodeNull = false) use (&$escape, &$encode) {
    if ($value instanceof Object) {
      if (method_exists($value, 'toJSON')) {
        $value = $value->toJSON();
      } else
      if (($toJSON = $value->get('toJSON')) instanceof Func) {
        $value = $toJSON->call($value);
      } else
      if (($valueOf = $value->get('valueOf')) instanceof Func) {
        $value = $valueOf->call($value);
      }
    }
    if ($opts->replacer instanceof Func) {
      $value = $opts->replacer->call($parent, $key, $value, $opts->level + 1);
    }
    if ($value === null) {
      return $encodeNull ? 'null' : $value;
    }
    if ($value === Object::$null || $value === INF || $value === -INF) {
      return 'null';
    }
    $type = gettype($value);
    if ($type === 'boolean') {
      return $value ? 'true' : 'false';
    }
    if ($type === 'integer' || $type === 'double') {
      return ($value !== $value) ? 'null' : $value . '';
    }
    if ($type === 'string') {
      return $escape($value);
    }
    $opts->level += 1;
    $prevGap = $opts->gap;
    if ($opts->gap !== null) {
      $opts->gap .= $opts->indent;
    }
    $result = null;
    if ($value instanceof Arr) {
      $parts = array();
      $len = $value->length;
      for ($i = 0; $i < $len; $i++) {
        $parts[] = $encode($value, $i, $value->get($i), $opts, true);
      }
      if ($opts->gap === null) {
        $result = '[' . join(',', $parts) . ']';
      } else {
        $result = (count($parts) === 0) ? "[]" :
          "[\n" . $opts->gap . join(",\n" . $opts->gap, $parts) . "\n" . $prevGap . "]";
      }
    }
    if ($result === null) {
      $parts = array();
      $sep = ($opts->gap === null) ? ':' : ': ';
      foreach ($value->getOwnKeys(true) as $key) {
        $item = $value->get($key);
        if ($item !== null) {
          $parts[] = $escape($key) . $sep . $encode($value, $key, $item, $opts);
        }
      }
      if ($opts->gap === null) {
        $result = '{' . join(',', $parts) . '}';
      } else {
        $result = (count($parts) === 0) ? "{}" :
          "{\n" . $opts->gap . join(",\n" . $opts->gap, $parts) . "\n" . $prevGap . "}";
      }
    }
    $opts->level -= 1;
    $opts->gap = $prevGap;
    return $result;
  };
  $methods = array(
    'parse' => function($string, $reviver = null) use(&$decode) {
        $string = '{"_":' . $string . '}';
        $value = json_decode($string);
        if ($value === null) {
          throw new Ex(SyntaxErr::create('Unexpected end of input'));
        }
        return $decode($value->_);
      },
    'stringify' => function($value, $replacer = null, $space = null) use (&$encode) {
        $opts = new stdClass();
        $opts->indent = null;
        $opts->gap = null;
        if (is_int_or_float($space)) {
          $space = floor($space);
          if ($space > 0) {
            $space = str_repeat(' ', $space);
          }
        }
        if (is_string($space)) {
          $length = strlen($space);
          if ($length > 10) $space = substr($space, 0, 10);
          if ($length > 0) {
            $opts->indent = $space;
            $opts->gap = '';
          }
        }
        $opts->replacer = ($replacer instanceof Func) ? $replacer : null;
        $opts->level = -1.0;
        $obj = ($opts->replacer !== null) ? new Object('', $value) : null;
        return $encode($obj, '', $value, $opts);
      }
  );
  $JSON = new Object();
  $JSON->setMethods($methods, true, false, true);
  $JSON->fromNative = $decode;
  return $JSON;
});
$console = call_user_func(function() {
  $stdout = defined('STDOUT') ? STDOUT : null;
  $stderr = defined('STDERR') ? STDERR : null;
  $toString = function($value) {
    if ($value instanceof Object) {
      if (class_exists('Debug')) {
        return call_user_func(Debug::$inspect->fn, $value);
      }
      $toString = $value->get('inspect');
      if (!($toString instanceof Func)) {
        $toString = $value->get('toString');
      }
      if (!($toString instanceof Func)) {
        $toString = Object::$protoObject->get('toString');
      }
      return $toString->call($value);
    }
    return to_string($value);
  };
  $console = new Object();
  $console->set('log', new Func(function() use (&$stdout, &$toString) {
    if ($stdout === null) {
      $stdout = fopen('php://stdout', 'w');
    }
    $output = array();
    foreach (func_get_args() as $value) {
      $output[] = $toString($value);
    }
    write_all($stdout, join(' ', $output) . "\n");
  }));
  $console->set('error', new Func(function() use (&$stderr, &$toString) {
    if ($stderr === null) {
      $stderr = fopen('php://stderr', 'w');
    }
    $output = array();
    foreach (func_get_args() as $value) {
      $output[] = $toString($value);
    }
    write_all($stderr, join(' ', $output) . "\n");
  }));
  return $console;
});
$process = new Object();
$process->set('sapi_name', php_sapi_name());
$process->set('exit', new Func(function($code = 0) {
  $code = intval($code);
  exit($code);
}));
$process->set('binding', new Func(function($name) {
  $module = Module::get($name);
  if ($module === null) {
    throw new Ex(Err::create("Binding `$name` not found."));
  }
  return $module;
}));
$process->argv = isset(GlobalObject::$OLD_GLOBALS['argv']) ? GlobalObject::$OLD_GLOBALS['argv'] : array();
$process->argv = array_slice($process->argv, 1);
$process->set('argv', Arr::fromArray($process->argv));


$symbol_t = null; $construction_t = null; $null_t = null; $data_t = null; $error_t = null; $just_t = null; $delay_evaluate_t = null; $delay_builtin_func_t = null; $delay_builtin_form_t = null; $delay_apply_t = null; $null_v = null; $system_symbol = null; $name_symbol = null; $function_symbol = null; $form_symbol = null; $equal_symbol = null; $evaluate_sym = null; $theThing_symbol = null; $something_symbol = null; $mapping_symbol = null; $if_symbol = null; $typeAnnotation_symbol = null; $isOrNot_symbol = null; $sub_symbol = null; $true_symbol = null; $false_symbol = null; $quote_symbol = null; $apply_symbol = null; $null_symbol = null; $construction_symbol = null; $data_symbol = null; $error_symbol = null; $symbol_symbol = null; $list_symbol = null; $head_symbol = null; $tail_symbol = null; $thing_symbol = null; $theWorldStopped_symbol = null; $effect_symbol = null; $sequentialWordFormation_symbol = null; $inputOutput_symbol = null; $the_world_stopped_v = null; $new_data_function_builtin_systemName = null; $data_name_function_builtin_systemName = null; $data_list_function_builtin_systemName = null; $data_p_function_builtin_systemName = null; $new_error_function_builtin_systemName = null; $error_name_function_builtin_systemName = null; $error_list_function_builtin_systemName = null; $error_p_function_builtin_systemName = null; $new_construction_function_builtin_systemName = null; $construction_p_function_builtin_systemName = null; $construction_head_function_builtin_systemName = null; $construction_tail_function_builtin_systemName = null; $symbol_p_function_builtin_systemName = null; $null_p_function_builtin_systemName = null; $equal_p_function_builtin_systemName = null; $apply_function_builtin_systemName = null; $evaluate_function_builtin_systemName = null; $list_chooseOne_function_builtin_systemName = null; $if_function_builtin_systemName = null; $quote_form_builtin_systemName = null; $lambda_form_builtin_systemName = null; $function_builtin_use_systemName = null; $form_builtin_use_systemName = null; $form_use_systemName = null; $false_v = null; $true_v = null; $env_null_v = null; $real_builtin_func_apply_s = null;
$ERROR = new Func("ERROR", function() {
  throw new Ex("TheLanguage PANIC");
});
$ASSERT = new Func("ASSERT", function($x = null) use (&$ERROR) {
  if (not($x)) {
    return call($ERROR);
  }
});
$new_symbol = new Func("new_symbol", function($x = null) use (&$symbol_t) {
  return new Arr($symbol_t, $x);
});
$symbol_p = new Func("symbol_p", function($x = null) {
  return get($x, 0.0) === 0.0;
});
$un_symbol = new Func("un_symbol", function($x = null) {
  return get($x, 1.0);
});
$new_construction = new Func("new_construction", function($x = null, $y = null) use (&$construction_t) {
  return new Arr($construction_t, $x, $y);
});
$construction_p = new Func("construction_p", function($x = null) use (&$construction_t) {
  return get($x, 0.0) === $construction_t;
});
$construction_head = new Func("construction_head", function($x = null) {
  return get($x, 1.0);
});
$construction_tail = new Func("construction_tail", function($x = null) {
  return get($x, 2.0);
});
$null_p = new Func("null_p", function($x = null) use (&$null_t) {
  return get($x, 0.0) === $null_t;
});
$new_data = new Func("new_data", function($x = null, $y = null) use (&$data_t) {
  return new Arr($data_t, $x, $y);
});
$data_p = new Func("data_p", function($x = null) use (&$data_t) {
  return get($x, 0.0) === $data_t;
});
$data_name = new Func("data_name", function($x = null) {
  return get($x, 1.0);
});
$data_list = new Func("data_list", function($x = null) {
  return get($x, 2.0);
});
$new_error = new Func("new_error", function($x = null, $y = null) use (&$error_t) {
  return new Arr($error_t, $x, $y);
});
$error_p = new Func("error_p", function($x = null) use (&$error_t) {
  return get($x, 0.0) === $error_t;
});
$error_name = new Func("error_name", function($x = null) {
  return get($x, 1.0);
});
$error_list = new Func("error_list", function($x = null) {
  return get($x, 2.0);
});
$lang_set_do = new Func("lang_set_do", function($x = null, $y = null) use (&$just_t) {
  if ($x === $y) {
    return ;
  }
  set($x, 0.0, $just_t);
  set($x, 1.0, $y);
  set($x, 2.0, false);
  set($x, 3.0, false);
});
$just_p = new Func("just_p", function($x = null) use (&$just_t) {
  return get($x, 0.0) === $just_t;
});
$un_just = new Func("un_just", function($x = null) {
  return get($x, 1.0);
});
$evaluate = new Func("evaluate", function($x = null, $y = null) use (&$delay_evaluate_t) {
  return new Arr($delay_evaluate_t, $x, $y);
});
$delay_evaluate_p = new Func("delay_evaluate_p", function($x = null) use (&$delay_evaluate_t) {
  return get($x, 0.0) === $delay_evaluate_t;
});
$delay_evaluate_env = new Func("delay_evaluate_env", function($x = null) {
  return get($x, 1.0);
});
$delay_evaluate_x = new Func("delay_evaluate_x", function($x = null) {
  return get($x, 2.0);
});
$builtin_form_apply = new Func("builtin_form_apply", function($x = null, $y = null, $z = null) use (&$delay_builtin_form_t) {
  return new Arr($delay_builtin_form_t, $x, $y, $z);
});
$delay_builtin_form_p = new Func("delay_builtin_form_p", function($x = null) use (&$delay_builtin_form_t) {
  return get($x, 0.0) === $delay_builtin_form_t;
});
$delay_builtin_form_env = new Func("delay_builtin_form_env", function($x = null) {
  return get($x, 1.0);
});
$delay_builtin_form_f = new Func("delay_builtin_form_f", function($x = null) {
  return get($x, 2.0);
});
$delay_builtin_form_xs = new Func("delay_builtin_form_xs", function($x = null) {
  return get($x, 3.0);
});
$builtin_func_apply = new Func("builtin_func_apply", function($x = null, $y = null) use (&$delay_builtin_func_t) {
  return new Arr($delay_builtin_func_t, $x, $y);
});
$delay_builtin_func_p = new Func("delay_builtin_func_p", function($x = null) use (&$delay_builtin_func_t) {
  return get($x, 0.0) === $delay_builtin_func_t;
});
$delay_builtin_func_f = new Func("delay_builtin_func_f", function($x = null) {
  return get($x, 1.0);
});
$delay_builtin_func_xs = new Func("delay_builtin_func_xs", function($x = null) {
  return get($x, 2.0);
});
$apply = new Func("apply", function($f = null, $xs = null) use (&$delay_apply_t) {
  return new Arr($delay_apply_t, $f, $xs);
});
$delay_apply_p = new Func("delay_apply_p", function($x = null) use (&$delay_apply_t) {
  return get($x, 0.0) === $delay_apply_t;
});
$delay_apply_f = new Func("delay_apply_f", function($x = null) {
  return get($x, 1.0);
});
$delay_apply_xs = new Func("delay_apply_xs", function($x = null) {
  return get($x, 2.0);
});
$force_all_rec = new Func("force_all_rec", function($raw = null) use (&$force_all, &$data_p, &$error_p, &$construction_p) {
  $force_all_rec = Func::getCurrent();
  $x = null; $a = null; $d = null;
  $x = call($force_all, $raw);
  if (is(call($data_p, $x))) {
    $a = get($x, 1.0);
    $d = get($x, 2.0);
    set($x, 1.0, call($force_all_rec, $a));
    set($x, 2.0, call($force_all_rec, $d));
    return $x;
  } else if (is(call($error_p, $x))) {
    $a = get($x, 1.0);
    $d = get($x, 2.0);
    set($x, 1.0, call($force_all_rec, $a));
    set($x, 2.0, call($force_all_rec, $d));
    return $x;
  } else if (is(call($construction_p, $x))) {
    $a = get($x, 1.0);
    $d = get($x, 2.0);
    set($x, 1.0, call($force_all_rec, $a));
    set($x, 2.0, call($force_all_rec, $d));
    return $x;
  }


  return $x;
});
$systemName_make = new Func("systemName_make", function($x = null) use (&$new_data, &$name_symbol, &$new_list, &$system_symbol) {
  return call($new_data, $name_symbol, call($new_list, $system_symbol, $x));
});
$make_builtin_f_new_sym_f = new Func("make_builtin_f_new_sym_f", function($x_sym = null) use (&$systemName_make, &$new_list, &$typeAnnotation_symbol, &$theThing_symbol, &$function_symbol, &$something_symbol) {
  return call($systemName_make, call($new_list, $typeAnnotation_symbol, call($new_list, $function_symbol, $something_symbol, $x_sym), $theThing_symbol));
});
$make_builtin_f_get_sym_f = new Func("make_builtin_f_get_sym_f", function($t_sym = null, $x_sym = null) use (&$systemName_make, &$new_list, &$typeAnnotation_symbol, &$function_symbol, &$something_symbol) {
  return call($systemName_make, call($new_list, $typeAnnotation_symbol, call($new_list, $function_symbol, call($new_list, $t_sym), $something_symbol), $x_sym));
});
$make_builtin_f_p_sym_f = new Func("make_builtin_f_p_sym_f", function($t_sym = null) use (&$systemName_make, &$new_list, &$typeAnnotation_symbol, &$function_symbol, &$isOrNot_symbol, &$something_symbol) {
  return call($systemName_make, call($new_list, $typeAnnotation_symbol, $function_symbol, call($new_list, $isOrNot_symbol, call($new_list, $typeAnnotation_symbol, $t_sym, $something_symbol))));
});
$symbol_equal_p = new Func("symbol_equal_p", function($x = null, $y = null) use (&$un_symbol, &$lang_set_do) {
  if ($x === $y) {
    return true;
  }
  if (call($un_symbol, $x) === call($un_symbol, $y)) {
    call($lang_set_do, $x, $y);
    return true;
  } else {
    return false;
  }

});
$jsArray_to_list = new Func("jsArray_to_list", function($xs = null) use (&$null_v, &$new_construction) {
  $ret = null; $i = null;
  $ret = $null_v;
  for ($i = to_number(get($xs, "length")) - 1.0; $i >= 0.0; $i--) {
    $ret = call($new_construction, get($xs, $i), $ret);
  }
  return $ret;
});
$list_to_jsArray = new Func("list_to_jsArray", function($xs = null, $k_done = null, $k_tail = null) use (&$construction_p, &$construction_head, &$construction_tail, &$null_p) {
  $ret = null;
  $ret = new Arr();
  while (is(call($construction_p, $xs))) {
    call_method($ret, "push", call($construction_head, $xs));
    $xs = call($construction_tail, $xs);
  }
  if (is(call($null_p, $xs))) {
    return call($k_done, $ret);
  }
  return call($k_tail, $ret, $xs);
});
$maybe_list_to_jsArray = new Func("maybe_list_to_jsArray", function($xs = null) use (&$list_to_jsArray) {
  return call($list_to_jsArray, $xs, new Func(function($xs = null) {
    return $xs;
  }), new Func(function($xs = null, $x = null) {
    return false;
  }));
});
$new_list = new Func("new_list", function() use (&$jsArray_to_list) {
  $arguments = Func::getArguments();
  $xs = null; $_i = null;
  $xs = new Arr();
  for ($_i = 0.0; $_i < get($arguments, "length"); $_i++) {
    set($xs, $_i, get($arguments, $_i));
  }
  return call($jsArray_to_list, $xs);
});
$un_just_all = new Func("un_just_all", function($raw = null) use (&$just_p, &$un_just, &$lang_set_do) {
  $x = null; $xs = null; $i = null;
  $x = $raw;
  $xs = new Arr();
  while (is(call($just_p, $x))) {
    call_method($xs, "push", $x);
    $x = call($un_just, $x);
  }
  for ($i = 0.0; $i < get($xs, "length"); $i++) {
    call($lang_set_do, get($xs, $i), $x);
  }
  return $x;
});
$any_delay_just_p = new Func("any_delay_just_p", function($x = null) use (&$just_p, &$delay_evaluate_p, &$delay_builtin_form_p, &$delay_builtin_func_p, &$delay_apply_p) {
  return (is($or_ = (is($or1_ = (is($or2_ = (is($or3_ = call($just_p, $x)) ? $or3_ : call($delay_evaluate_p, $x))) ? $or2_ : call($delay_builtin_form_p, $x))) ? $or1_ : call($delay_builtin_func_p, $x))) ? $or_ : call($delay_apply_p, $x));
});
$force_all = new Func("force_all", function($raw = null, $parents_history = null, $ref_novalue_replace = null) use (&$any_delay_just_p, &$simple_print, &$delay_evaluate_p, &$delay_builtin_func_p, &$delay_builtin_func_f, &$delay_builtin_func_xs, &$data_name_function_builtin_systemName, &$data_list_function_builtin_systemName, &$data_p_function_builtin_systemName, &$error_name_function_builtin_systemName, &$error_list_function_builtin_systemName, &$error_p_function_builtin_systemName, &$construction_p_function_builtin_systemName, &$construction_head_function_builtin_systemName, &$construction_tail_function_builtin_systemName, &$symbol_p_function_builtin_systemName, &$null_p_function_builtin_systemName, &$jsbool_equal_p, &$ASSERT, &$builtin_func_apply, &$ERROR, &$equal_p_function_builtin_systemName, &$apply_function_builtin_systemName, &$evaluate_function_builtin_systemName, &$if_function_builtin_systemName, &$delay_builtin_form_p, &$delay_apply_p, &$force1, &$lang_set_do, &$the_world_stopped_v) {
  $force_all = Func::getCurrent();
  $history = null; $x = null; $xs = null; $x_id = null; $f = null; $xs_1 = null; $elim_s = null; $is_elim = null; $i = null; $inner = null; $tf = null;
  $replace_this_with_stopped = new Func("replace_this_with_stopped", function() use (&$ref_novalue_replace, &$lang_set_do, &$x, &$the_world_stopped_v, &$xs) {
    $i = null;
    set($ref_novalue_replace, 1.0, true);
    call($lang_set_do, $x, $the_world_stopped_v);
    for ($i = 0.0; $i < get($xs, "length"); $i++) {
      call($lang_set_do, get($xs, $i), $the_world_stopped_v);
    }
    return $the_world_stopped_v;
  });
  $do_rewrite_force_all = new Func("do_rewrite_force_all", function($newval = null) use (&$lang_set_do, &$x, &$xs, &$any_delay_just_p, &$force_all) {
    $i = null;
    call($lang_set_do, $x, $newval);
    for ($i = 0.0; $i < get($xs, "length"); $i++) {
      call($lang_set_do, get($xs, $i), $newval);
    }
    if (is(call($any_delay_just_p, $newval))) {
      $newval = call($force_all, $newval);
      call($lang_set_do, $x, $newval);
      for ($i = 0.0; $i < get($xs, "length"); $i++) {
        call($lang_set_do, get($xs, $i), $newval);
      }
    }
    return $newval;
  });
  $make_history = new Func("make_history", function() use (&$history, &$parents_history) {
    $ret = null; $x_id = null;
    $ret = new Object();
    foreach (keys($history) as $x_id) {
      set($ret, $x_id, true);
    }
    foreach (keys($parents_history) as $x_id) {
      set($ret, $x_id, true);
    }
    return $ret;
  });
  if ($parents_history === _void(0.0)) {
    $parents_history = new Object();
  }
  if ($ref_novalue_replace === _void(0.0)) {
    $ref_novalue_replace = new Arr(false, false);
  }
  $history = new Object();
  $x = $raw;
  $xs = new Arr();
  while (is(call($any_delay_just_p, $x))) {
    $x_id = call($simple_print, $x);
    if (get($parents_history, $x_id) === true) {
      return call($replace_this_with_stopped);
    }
    if (get($history, $x_id) === true) {
      set($ref_novalue_replace, 0.0, true);
      if (is(call($delay_evaluate_p, $x))) {
        return call($replace_this_with_stopped);
      } else if (is(call($delay_builtin_func_p, $x))) {
        $f = call($delay_builtin_func_f, $x);
        $xs_1 = call($delay_builtin_func_xs, $x);
        $elim_s = new Arr($data_name_function_builtin_systemName, $data_list_function_builtin_systemName, $data_p_function_builtin_systemName, $error_name_function_builtin_systemName, $error_list_function_builtin_systemName, $error_p_function_builtin_systemName, $construction_p_function_builtin_systemName, $construction_head_function_builtin_systemName, $construction_tail_function_builtin_systemName, $symbol_p_function_builtin_systemName, $null_p_function_builtin_systemName);
        $is_elim = false;
        for ($i = 0.0; $i < get($elim_s, "length"); $i++) {
          if (is(call($jsbool_equal_p, get($elim_s, $i), $f))) {
            $is_elim = true;
          }
        }
        if (is($is_elim)) {
          call($ASSERT, get($xs_1, "length") === 1.0);
          call($ASSERT, get($ref_novalue_replace, 1.0) === false);
          $inner = call($force_all, get($xs_1, 0.0), call($make_history), $ref_novalue_replace);
          if (is(get($ref_novalue_replace, 1.0))) {
            return call($do_rewrite_force_all, call($builtin_func_apply, $f, new Arr($inner)));
          } else {
            return call($ERROR);
          }

        }
        if (is(call($jsbool_equal_p, $f, $equal_p_function_builtin_systemName))) {
          return call($replace_this_with_stopped);
        } else if (is(call($jsbool_equal_p, $f, $apply_function_builtin_systemName))) {
          return call($replace_this_with_stopped);
        } else if (is(call($jsbool_equal_p, $f, $evaluate_function_builtin_systemName))) {
          return call($replace_this_with_stopped);
        } else if (is(call($jsbool_equal_p, $f, $if_function_builtin_systemName))) {
          call($ASSERT, get($xs_1, "length") === 3.0);
          call($ASSERT, get($ref_novalue_replace, 1.0) === false);
          $tf = call($force_all, get($xs_1, 0.0), call($make_history), $ref_novalue_replace);
          if (is(get($ref_novalue_replace, 1.0))) {
            return call($do_rewrite_force_all, call($builtin_func_apply, $if_function_builtin_systemName, new Arr($tf, get($xs_1, 1.0), get($xs_1, 2.0))));
          } else {
            return call($ERROR);
          }

        }



        return call($ERROR);
      } else if (is(call($delay_builtin_form_p, $x))) {
        return call($replace_this_with_stopped);
      } else if (is(call($delay_apply_p, $x))) {
        return call($replace_this_with_stopped);
      }



      return call($ERROR);
    }
    set($history, $x_id, true);
    call_method($xs, "push", $x);
    $x = call($force1, $x);
  }
  for ($i = 0.0; $i < get($xs, "length"); $i++) {
    call($lang_set_do, get($xs, $i), $x);
  }
  return $x;
});
$force1 = new Func("force1", function($raw = null) use (&$un_just_all, &$ASSERT, &$just_p, &$delay_evaluate_p, &$real_evaluate, &$delay_evaluate_env, &$delay_evaluate_x, &$delay_builtin_form_p, &$real_builtin_form_apply, &$delay_builtin_form_env, &$delay_builtin_form_f, &$delay_builtin_form_xs, &$delay_builtin_func_p, &$real_builtin_func_apply, &$delay_builtin_func_f, &$delay_builtin_func_xs, &$delay_apply_p, &$real_apply, &$delay_apply_f, &$delay_apply_xs, &$lang_set_do) {
  $x = null; $ret = null;
  $x = call($un_just_all, $raw);
  call($ASSERT, not(call($just_p, $x)));
  if (is(call($delay_evaluate_p, $x))) {
    $ret = call($real_evaluate, call($delay_evaluate_env, $x), call($delay_evaluate_x, $x));
  } else if (is(call($delay_builtin_form_p, $x))) {
    $ret = call($real_builtin_form_apply, call($delay_builtin_form_env, $x), call($delay_builtin_form_f, $x), call($delay_builtin_form_xs, $x));
  } else if (is(call($delay_builtin_func_p, $x))) {
    $ret = call($real_builtin_func_apply, call($delay_builtin_func_f, $x), call($delay_builtin_func_xs, $x));
  } else if (is(call($delay_apply_p, $x))) {
    $ret = call($real_apply, call($delay_apply_f, $x), call($delay_apply_xs, $x));
  } else {
    $ret = $x;
  }




  $ret = call($un_just_all, $ret);
  call($lang_set_do, $x, $ret);
  return $ret;
});
$env_set = new Func("env_set", function($env = null, $key = null, $val = null) use (&$jsbool_equal_p) {
  $ret = null; $i = null;
  $ret = new Arr();
  for ($i = 0.0; $i < get($env, "length"); $i = _plus($i, 2.0)) {
    if (is(call($jsbool_equal_p, get($env, _plus($i, 0.0)), $key))) {
      set($ret, _plus($i, 0.0), $key);
      set($ret, _plus($i, 1.0), $val);
      for ($i = _plus($i, 2.0); $i < get($env, "length"); $i = _plus($i, 2.0)) {
        set($ret, _plus($i, 0.0), get($env, _plus($i, 0.0)));
        set($ret, _plus($i, 1.0), get($env, _plus($i, 1.0)));
      }
      return $ret;
    } else {
      set($ret, _plus($i, 0.0), get($env, _plus($i, 0.0)));
      set($ret, _plus($i, 1.0), get($env, _plus($i, 1.0)));
    }

  }
  set($ret, _plus(get($env, "length"), 0.0), $key);
  set($ret, _plus(get($env, "length"), 1.0), $val);
  return $ret;
});
$env_get = new Func("env_get", function($env = null, $key = null, $default_v = null) use (&$jsbool_equal_p) {
  $i = null;
  for ($i = 0.0; $i < get($env, "length"); $i = _plus($i, 2.0)) {
    if (is(call($jsbool_equal_p, get($env, _plus($i, 0.0)), $key))) {
      return get($env, _plus($i, 1.0));
    }
  }
  return $default_v;
});
$must_env_get = new Func("must_env_get", function($env = null, $key = null) use (&$jsbool_equal_p, &$ERROR) {
  $i = null;
  for ($i = 0.0; $i < get($env, "length"); $i = _plus($i, 2.0)) {
    if (is(call($jsbool_equal_p, get($env, _plus($i, 0.0)), $key))) {
      return get($env, _plus($i, 1.0));
    }
  }
  return call($ERROR);
});
$env2val = new Func("env2val", function($env = null) use (&$null_v, &$new_construction, &$new_list, &$new_data, &$mapping_symbol) {
  $ret = null; $i = null;
  $ret = $null_v;
  for ($i = 0.0; $i < get($env, "length"); $i = _plus($i, 2.0)) {
    $ret = call($new_construction, call($new_list, get($env, _plus($i, 0.0)), get($env, _plus($i, 1.0))), $ret);
  }
  return call($new_data, $mapping_symbol, call($new_list, $ret));
});
$env_foreach = new Func("env_foreach", function($env = null, $f = null) {
  $i = null;
  for ($i = 0.0; $i < get($env, "length"); $i = _plus($i, 2.0)) {
    call($f, get($env, _plus($i, 0.0)), get($env, _plus($i, 1.0)));
  }
});
$val2env = new Func("val2env", function($x = null) use (&$force_all, &$data_p, &$data_name, &$symbol_p, &$symbol_equal_p, &$mapping_symbol, &$data_list, &$construction_p, &$null_p, &$construction_tail, &$construction_head, &$jsbool_equal_p) {
  $s = null; $ret = null; $xs = null; $x_1 = null; $k = null; $v = null; $not_breaked = null; $i = null;
  $x = call($force_all, $x);
  if (not(call($data_p, $x))) {
    return false;
  }
  $s = call($force_all, call($data_name, $x));
  if (not(call($symbol_p, $s))) {
    return false;
  }
  if (not(call($symbol_equal_p, $s, $mapping_symbol))) {
    return false;
  }
  $s = call($force_all, call($data_list, $x));
  if (not(call($construction_p, $s))) {
    return false;
  }
  if (not(call($null_p, call($force_all, call($construction_tail, $s))))) {
    return false;
  }
  $ret = new Arr();
  $xs = call($force_all, call($construction_head, $s));
  while (not(call($null_p, $xs))) {
    if (not(call($construction_p, $xs))) {
      return false;
    }
    $x_1 = call($force_all, call($construction_head, $xs));
    $xs = call($force_all, call($construction_tail, $xs));
    if (not(call($construction_p, $x_1))) {
      return false;
    }
    $k = call($construction_head, $x_1);
    $x_1 = call($force_all, call($construction_tail, $x_1));
    if (not(call($construction_p, $x_1))) {
      return false;
    }
    $v = call($construction_head, $x_1);
    if (not(call($null_p, call($force_all, call($construction_tail, $x_1))))) {
      return false;
    }
    $not_breaked = true;
    for ($i = 0.0; $i < get($ret, "length"); $i = _plus($i, 2.0)) {
      if (is(call($jsbool_equal_p, get($ret, _plus($i, 0.0)), $k))) {
        set($ret, _plus($i, 1.0), $v);
        $not_breaked = false;
        break;
      }
    }
    if (is($not_breaked)) {
      call_method($ret, "push", $k);
      call_method($ret, "push", $v);
    }
  }
  return $ret;
});
$real_evaluate = new Func("real_evaluate", function($env = null, $raw = null) use (&$force1, &$any_delay_just_p, &$evaluate, &$new_error, &$system_symbol, &$new_list, &$function_builtin_use_systemName, &$evaluate_function_builtin_systemName, &$env2val, &$construction_p, &$null_p, &$construction_head, &$construction_tail, &$jsbool_equal_p, &$form_builtin_use_systemName, &$builtin_form_apply, &$form_use_systemName, &$force_all, &$data_p, &$data_name, &$symbol_p, &$symbol_equal_p, &$form_symbol, &$data_list, &$apply, &$builtin_func_apply, &$name_p, &$env_get, &$error_p, &$ERROR) {
  $x = null; $error_v = null; $xs = null; $rest = null; $f = null; $args = null; $i = null; $f_type = null; $f_list = null; $f_x = null; $f_list_cdr = null;
  $x = call($force1, $raw);
  if (is(call($any_delay_just_p, $x))) {
    return call($evaluate, $env, $x);
  }
  $error_v = call($new_error, $system_symbol, call($new_list, $function_builtin_use_systemName, call($new_list, $evaluate_function_builtin_systemName, call($new_list, call($env2val, $env), $x))));
  if (is(call($construction_p, $x))) {
    $xs = new Arr();
    $rest = $x;
    while (not(call($null_p, $rest))) {
      if (is(call($any_delay_just_p, $rest))) {
        return call($evaluate, $env, $x);
      } else if (is(call($construction_p, $rest))) {
        call_method($xs, "push", call($construction_head, $rest));
        $rest = call($force1, call($construction_tail, $rest));
      } else {
        return $error_v;
      }


    }
    if (is(call($jsbool_equal_p, get($xs, 0.0), $form_builtin_use_systemName))) {
      if (get($xs, "length") === 1.0) {
        return $error_v;
      }
      $f = get($xs, 1.0);
      $args = new Arr();
      for ($i = 2.0; $i < get($xs, "length"); $i++) {
        set($args, to_number($i) - 2.0, get($xs, $i));
      }
      return call($builtin_form_apply, $env, $f, $args);
    } else if (is(call($jsbool_equal_p, get($xs, 0.0), $form_use_systemName))) {
      if (get($xs, "length") === 1.0) {
        return $error_v;
      }
      $f = call($force_all, call($evaluate, $env, get($xs, 1.0)));
      if (not(call($data_p, $f))) {
        return $error_v;
      }
      $f_type = call($force1, call($data_name, $f));
      if (is(call($any_delay_just_p, $f_type))) {
        return call($evaluate, $env, $x);
      }
      if (not(call($symbol_p, $f_type))) {
        return $error_v;
      }
      if (not(call($symbol_equal_p, $f_type, $form_symbol))) {
        return $error_v;
      }
      $f_list = call($force1, call($data_list, $f));
      if (is(call($any_delay_just_p, $f_list))) {
        return call($evaluate, $env, $x);
      }
      if (not(call($construction_p, $f_list))) {
        return $error_v;
      }
      $f_x = call($construction_head, $f_list);
      $f_list_cdr = call($force1, call($construction_tail, $f_list));
      if (is(call($any_delay_just_p, $f_list_cdr))) {
        return call($evaluate, $env, $x);
      }
      if (not(call($null_p, $f_list_cdr))) {
        return $error_v;
      }
      $args = new Arr(call($env2val, $env));
      for ($i = 2.0; $i < get($xs, "length"); $i++) {
        set($args, to_number($i) - 1.0, get($xs, $i));
      }
      return call($apply, $f_x, $args);
    } else if (is(call($jsbool_equal_p, get($xs, 0.0), $function_builtin_use_systemName))) {
      if (get($xs, "length") === 1.0) {
        return $error_v;
      }
      $f = get($xs, 1.0);
      $args = new Arr();
      for ($i = 2.0; $i < get($xs, "length"); $i++) {
        set($args, to_number($i) - 2.0, call($evaluate, $env, get($xs, $i)));
      }
      return call($builtin_func_apply, $f, $args);
    } else {
      $f = call($evaluate, $env, get($xs, 0.0));
      $args = new Arr();
      for ($i = 1.0; $i < get($xs, "length"); $i++) {
        set($args, to_number($i) - 1.0, call($evaluate, $env, get($xs, $i)));
      }
      return call($apply, $f, $args);
    }



  } else if (is(call($null_p, $x))) {
    return $x;
  } else if (is(call($name_p, $x))) {
    return call($env_get, $env, $x, $error_v);
  } else if (is(call($error_p, $x))) {
    return $error_v;
  }



  return call($ERROR);
});
$name_p = new Func("name_p", function($x = null) use (&$symbol_p, &$data_p) {
  return (is($or_ = call($symbol_p, $x)) ? $or_ : call($data_p, $x));
});
$make_builtin_p_func = new Func("make_builtin_p_func", function($p_sym = null, $p_jsfunc = null) use (&$force1, &$any_delay_just_p, &$builtin_func_apply, &$true_v, &$false_v) {
  return new Arr($p_sym, 1.0, new Func(function($x = null, $error_v = null) use (&$force1, &$any_delay_just_p, &$builtin_func_apply, &$p_sym, &$p_jsfunc, &$true_v, &$false_v) {
    $x = call($force1, $x);
    if (is(call($any_delay_just_p, $x))) {
      return call($builtin_func_apply, $p_sym, new Arr($x));
    }
    if (is(call($p_jsfunc, $x))) {
      return $true_v;
    }
    return $false_v;
  }));
});
$make_builtin_get_func = new Func("make_builtin_get_func", function($f_sym = null, $p_jsfunc = null, $f_jsfunc = null) use (&$force1, &$any_delay_just_p, &$builtin_func_apply) {
  return new Arr($f_sym, 1.0, new Func(function($x = null, $error_v = null) use (&$force1, &$any_delay_just_p, &$builtin_func_apply, &$f_sym, &$p_jsfunc, &$f_jsfunc) {
    $x = call($force1, $x);
    if (is(call($any_delay_just_p, $x))) {
      return call($builtin_func_apply, $f_sym, new Arr($x));
    }
    if (is(call($p_jsfunc, $x))) {
      return call($f_jsfunc, $x);
    }
    return $error_v;
  }));
});
$real_apply = new Func("real_apply", function($f = null, $xs = null) use (&$force1, &$any_delay_just_p, &$apply, &$data_p, &$force_all, &$data_name, &$symbol_p, &$symbol_equal_p, &$function_symbol, &$data_list, &$construction_p, &$force_all_rec, &$construction_head, &$construction_tail, &$null_p, &$env_null_v, &$name_p, &$null_v, &$new_construction, &$env_set, &$evaluate, &$new_error, &$system_symbol, &$new_list, &$function_builtin_use_systemName, &$apply_function_builtin_systemName, &$jsArray_to_list) {
  $f_type = null; $f_list = null; $args_pat = null; $f_list_cdr = null; $f_code = null; $env = null; $xs_i = null; $x = null; $i = null;
  $make_error_v = new Func("make_error_v", function() use (&$new_error, &$system_symbol, &$new_list, &$function_builtin_use_systemName, &$apply_function_builtin_systemName, &$f, &$jsArray_to_list, &$xs) {
    return call($new_error, $system_symbol, call($new_list, $function_builtin_use_systemName, call($new_list, $apply_function_builtin_systemName, call($new_list, $f, call($jsArray_to_list, $xs)))));
  });
  $f = call($force1, $f);
  if (is(call($any_delay_just_p, $f))) {
    return call($apply, $f, $xs);
  }
  if (not(call($data_p, $f))) {
    return call($make_error_v);
  }
  $f_type = call($force_all, call($data_name, $f));
  if (not((is($and_ = call($symbol_p, $f_type)) ? call($symbol_equal_p, $f_type, $function_symbol) : $and_))) {
    return call($make_error_v);
  }
  $f_list = call($force_all, call($data_list, $f));
  if (not(call($construction_p, $f_list))) {
    return call($make_error_v);
  }
  $args_pat = call($force_all_rec, call($construction_head, $f_list));
  $f_list_cdr = call($force_all, call($construction_tail, $f_list));
  if (not((is($and_ = call($construction_p, $f_list_cdr)) ? call($null_p, call($force_all, call($construction_tail, $f_list_cdr))) : $and_))) {
    return call($make_error_v);
  }
  $f_code = call($construction_head, $f_list_cdr);
  $env = $env_null_v;
  $xs_i = 0.0;
  while (not(call($null_p, $args_pat))) {
    if (is(call($name_p, $args_pat))) {
      $x = $null_v;
      for ($i = to_number(get($xs, "length")) - 1.0; $i >= $xs_i; $i--) {
        $x = call($new_construction, get($xs, $i), $x);
      }
      $env = call($env_set, $env, $args_pat, $x);
      $xs_i = get($xs, "length");
      $args_pat = $null_v;
    } else if (is(call($construction_p, $args_pat))) {
      if ($xs_i < get($xs, "length")) {
        $x = get($xs, $xs_i);
        $xs_i++;
        $env = call($env_set, $env, call($construction_head, $args_pat), $x);
        $args_pat = call($construction_tail, $args_pat);
      } else {
        return call($make_error_v);
      }

    } else {
      return call($make_error_v);
    }


  }
  if (get($xs, "length") !== $xs_i) {
    return call($make_error_v);
  }
  return call($evaluate, $env, $f_code);
});
$real_builtin_func_apply = new Func("real_builtin_func_apply", function($f = null, $xs = null) use (&$new_error, &$system_symbol, &$new_list, &$function_builtin_use_systemName, &$jsArray_to_list, &$real_builtin_func_apply_s, &$jsbool_equal_p, &$ERROR) {
  $error_v = null; $i = null; $actually_length = null; $f_1 = null;
  $error_v = call($new_error, $system_symbol, call($new_list, $function_builtin_use_systemName, call($new_list, $f, call($jsArray_to_list, $xs))));
  for ($i = 0.0; $i < get($real_builtin_func_apply_s, "length"); $i++) {
    if (is(call($jsbool_equal_p, $f, get(get($real_builtin_func_apply_s, $i), 0.0)))) {
      $actually_length = get(get($real_builtin_func_apply_s, $i), 1.0);
      if (get($xs, "length") !== $actually_length) {
        return $error_v;
      }
      $f_1 = get(get($real_builtin_func_apply_s, $i), 2.0);
      if ($actually_length === 1.0) {
        return call($f_1, get($xs, 0.0), $error_v);
      } else if ($actually_length === 2.0) {
        return call($f_1, get($xs, 0.0), get($xs, 1.0), $error_v);
      } else if ($actually_length === 3.0) {
        return call($f_1, get($xs, 0.0), get($xs, 1.0), get($xs, 2.0), $error_v);
      }


      return call($ERROR);
    }
  }
  return $error_v;
});
$real_builtin_form_apply = new Func("real_builtin_form_apply", function($env = null, $f = null, $xs = null) use (&$new_error, &$system_symbol, &$new_list, &$form_builtin_use_systemName, &$env2val, &$jsArray_to_list, &$jsbool_equal_p, &$quote_form_builtin_systemName, &$lambda_form_builtin_systemName, &$new_lambda) {
  $error_v = null;
  $error_v = call($new_error, $system_symbol, call($new_list, $form_builtin_use_systemName, call($new_list, call($env2val, $env), $f, call($jsArray_to_list, $xs))));
  if (is(call($jsbool_equal_p, $f, $quote_form_builtin_systemName))) {
    if (get($xs, "length") !== 1.0) {
      return $error_v;
    }
    return get($xs, 0.0);
  } else if (is(call($jsbool_equal_p, $f, $lambda_form_builtin_systemName))) {
    if (get($xs, "length") !== 2.0) {
      return $error_v;
    }
    return call($new_lambda, $env, get($xs, 0.0), get($xs, 1.0), $error_v);
  }

  return $error_v;
});
$new_lambda = new Func("new_lambda", function($env = null, $args_pat = null, $body = null, $error_v = null) use (&$force_all_rec, &$null_p, &$name_p, &$null_v, &$construction_p, &$construction_head, &$construction_tail, &$jsArray_to_list, &$env_foreach, &$new_construction, &$must_env_get, &$new_data, &$function_symbol, &$new_list, &$new_error, &$system_symbol, &$form_builtin_use_systemName, &$lambda_form_builtin_systemName, &$env2val, &$quote_form_builtin_systemName, &$jsbool_equal_p) {
  $args_pat_vars = null; $args_pat_is_dot = null; $args_pat_iter = null; $args_pat_vars_val = null; $env_vars = null; $new_args_pat = null; $i = null; $new_args = null;
  $make_error_v = new Func("make_error_v", function() use (&$error_v, &$new_error, &$system_symbol, &$new_list, &$form_builtin_use_systemName, &$lambda_form_builtin_systemName, &$env2val, &$env, &$jsArray_to_list, &$args_pat, &$body) {
    if ($error_v === false) {
      return call($new_error, $system_symbol, call($new_list, $form_builtin_use_systemName, call($new_list, call($env2val, $env), $lambda_form_builtin_systemName, call($jsArray_to_list, new Arr($args_pat, $body)))));
    } else {
      return $error_v;
    }

  });
  $make_quote = new Func("make_quote", function($x = null) use (&$new_list, &$form_builtin_use_systemName, &$quote_form_builtin_systemName) {
    return call($new_list, $form_builtin_use_systemName, $quote_form_builtin_systemName, $x);
  });
  if ($error_v === _void(0.0)) {
    $error_v = false;
  }
  $args_pat = call($force_all_rec, $args_pat);
  $args_pat_vars = new Arr();
  $args_pat_is_dot = false;
  $args_pat_iter = $args_pat;
  while (not(call($null_p, $args_pat_iter))) {
    if (is(call($name_p, $args_pat_iter))) {
      call_method($args_pat_vars, "push", $args_pat_iter);
      $args_pat_is_dot = true;
      $args_pat_iter = $null_v;
    } else if (is(call($construction_p, $args_pat_iter))) {
      call_method($args_pat_vars, "push", call($construction_head, $args_pat_iter));
      $args_pat_iter = call($construction_tail, $args_pat_iter);
    } else {
      return call($make_error_v);
    }


  }
  $args_pat_vars_val = $args_pat;
  if (is($args_pat_is_dot)) {
    $args_pat_vars_val = call($jsArray_to_list, $args_pat_vars);
  }
  $env_vars = new Arr();
  call($env_foreach, $env, new Func(function($k = null, $v = null) use (&$args_pat_vars, &$jsbool_equal_p, &$env_vars) {
    $i = null;
    for ($i = 0.0; $i < get($args_pat_vars, "length"); $i++) {
      if (is(call($jsbool_equal_p, get($args_pat_vars, $i), $k))) {
        return ;
      }
    }
    call_method($env_vars, "push", $k);
  }));
  $new_args_pat = $args_pat_vars_val;
  for ($i = to_number(get($env_vars, "length")) - 1.0; $i >= 0.0; $i--) {
    $new_args_pat = call($new_construction, get($env_vars, $i), $new_args_pat);
  }
  $new_args = $args_pat_vars_val;
  for ($i = to_number(get($env_vars, "length")) - 1.0; $i >= 0.0; $i--) {
    $new_args = call($new_construction, call($make_quote, call($must_env_get, $env, get($env_vars, $i))), $new_args);
  }
  return call($new_data, $function_symbol, call($new_list, $args_pat, call($new_construction, call($make_quote, call($new_data, $function_symbol, call($new_list, $new_args_pat, $body))), $new_args)));
});
$jsbool_equal_p = new Func("jsbool_equal_p", function($x = null, $y = null) use (&$force_all, &$null_p, &$lang_set_do, &$null_v, &$symbol_p, &$symbol_equal_p, &$construction_p, &$construction_head, &$construction_tail, &$error_p, &$error_name, &$error_list, &$data_p, &$data_name, &$data_list, &$ERROR) {
  $jsbool_equal_p = Func::getCurrent();
  $end_2 = new Func("end_2", function($x = null, $y = null, $f1 = null, $f2 = null) use (&$jsbool_equal_p, &$lang_set_do) {
    if (is(call($jsbool_equal_p, call($f1, $x), call($f1, $y))) && is(call($jsbool_equal_p, call($f2, $x), call($f2, $y)))) {
      call($lang_set_do, $x, $y);
      return true;
    } else {
      return false;
    }

  });
  if ($x === $y) {
    return true;
  }
  $x = call($force_all, $x);
  $y = call($force_all, $y);
  if ($x === $y) {
    return true;
  }
  if (is(call($null_p, $x))) {
    if (not(call($null_p, $y))) {
      return false;
    }
    call($lang_set_do, $x, $null_v);
    call($lang_set_do, $y, $null_v);
    return true;
  } else if (is(call($symbol_p, $x))) {
    if (not(call($symbol_p, $y))) {
      return false;
    }
    return call($symbol_equal_p, $x, $y);
  } else if (is(call($construction_p, $x))) {
    if (not(call($construction_p, $y))) {
      return false;
    }
    return call($end_2, $x, $y, $construction_head, $construction_tail);
  } else if (is(call($error_p, $x))) {
    if (not(call($error_p, $y))) {
      return false;
    }
    return call($end_2, $x, $y, $error_name, $error_list);
  } else if (is(call($data_p, $x))) {
    if (not(call($data_p, $y))) {
      return false;
    }
    return call($end_2, $x, $y, $data_name, $data_list);
  }




  return call($ERROR);
});
$jsbool_no_force_equal_p = new Func("jsbool_no_force_equal_p", function($x = null, $y = null) use (&$un_just_all, &$null_p, &$lang_set_do, &$null_v, &$symbol_p, &$symbol_equal_p, &$construction_p, &$construction_head, &$construction_tail, &$error_p, &$error_name, &$error_list, &$data_p, &$data_name, &$data_list, &$delay_evaluate_p, &$delay_builtin_func_p, &$delay_builtin_form_p, &$delay_apply_p, &$ERROR) {
  $jsbool_no_force_equal_p = Func::getCurrent();
  $end_2 = new Func("end_2", function($x = null, $y = null, $f1 = null, $f2 = null) use (&$jsbool_no_force_equal_p, &$lang_set_do) {
    if (is(call($jsbool_no_force_equal_p, call($f1, $x), call($f1, $y))) && is(call($jsbool_no_force_equal_p, call($f2, $x), call($f2, $y)))) {
      call($lang_set_do, $x, $y);
      return true;
    } else {
      return false;
    }

  });
  if ($x === $y) {
    return true;
  }
  $x = call($un_just_all, $x);
  $y = call($un_just_all, $y);
  if ($x === $y) {
    return true;
  }
  if (is(call($null_p, $x))) {
    if (not(call($null_p, $y))) {
      return false;
    }
    call($lang_set_do, $x, $null_v);
    call($lang_set_do, $y, $null_v);
    return true;
  } else if (is(call($symbol_p, $x))) {
    if (not(call($symbol_p, $y))) {
      return false;
    }
    return call($symbol_equal_p, $x, $y);
  } else if (is(call($construction_p, $x))) {
    if (not(call($construction_p, $y))) {
      return false;
    }
    return call($end_2, $x, $y, $construction_head, $construction_tail);
  } else if (is(call($error_p, $x))) {
    if (not(call($error_p, $y))) {
      return false;
    }
    return call($end_2, $x, $y, $error_name, $error_list);
  } else if (is(call($data_p, $x))) {
    if (not(call($data_p, $y))) {
      return false;
    }
    return call($end_2, $x, $y, $data_name, $data_list);
  } else if (is(call($delay_evaluate_p, $x))) {
    return false;
  } else if (is(call($delay_builtin_func_p, $x))) {
    return false;
  } else if (is(call($delay_builtin_form_p, $x))) {
    return false;
  } else if (is(call($delay_apply_p, $x))) {
    return false;
  }








  return call($ERROR);
});
$simple_print = new Func("simple_print", function($x = null) use (&$un_just_all, &$null_p, &$construction_p, &$construction_head, &$construction_tail, &$data_p, &$new_construction, &$data_name, &$data_list, &$error_p, &$error_name, &$error_list, &$symbol_p, &$un_symbol, &$delay_evaluate_p, &$env2val, &$delay_evaluate_env, &$delay_evaluate_x, &$delay_builtin_func_p, &$delay_builtin_func_f, &$jsArray_to_list, &$delay_builtin_func_xs, &$delay_builtin_form_p, &$delay_builtin_form_env, &$delay_builtin_form_f, &$delay_builtin_form_xs, &$delay_apply_p, &$delay_apply_f, &$delay_apply_xs, &$ERROR) {
  $simple_print = Func::getCurrent();
  $temp = null; $prefix = null;
  $x = call($un_just_all, $x);
  $temp = "";
  $prefix = "";
  if (is(call($null_p, $x))) {
    return "()";
  } else if (is(call($construction_p, $x))) {
    $temp = "(";
    $prefix = "";
    while (is(call($construction_p, $x))) {
      $temp = _plus($temp, _plus($prefix, call($simple_print, call($construction_head, $x))));
      $prefix = " ";
      $x = call($un_just_all, call($construction_tail, $x));
    }
    if (is(call($null_p, $x))) {
      $temp = _plus($temp, ")");
    } else {
      $temp = _plus($temp, _concat(" . ", call($simple_print, $x), ")"));
    }

    return $temp;
  } else if (is(call($data_p, $x))) {
    return _concat("#", call($simple_print, call($new_construction, call($data_name, $x), call($data_list, $x))));
  } else if (is(call($error_p, $x))) {
    return _concat("!", call($simple_print, call($new_construction, call($error_name, $x), call($error_list, $x))));
  } else if (is(call($symbol_p, $x))) {
    return call($un_symbol, $x);
  } else if (is(call($delay_evaluate_p, $x))) {
    return _concat("\$(", call($simple_print, call($env2val, call($delay_evaluate_env, $x))), " ", call($simple_print, call($delay_evaluate_x, $x)), ")");
  } else if (is(call($delay_builtin_func_p, $x))) {
    return _concat("%(", call($simple_print, call($delay_builtin_func_f, $x)), " ", call($simple_print, call($jsArray_to_list, call($delay_builtin_func_xs, $x))), ")");
  } else if (is(call($delay_builtin_form_p, $x))) {
    return _concat("@(", call($simple_print, call($env2val, call($delay_builtin_form_env, $x))), " ", call($simple_print, call($delay_builtin_form_f, $x)), " ", call($simple_print, call($jsArray_to_list, call($delay_builtin_form_xs, $x))), ")");
  } else if (is(call($delay_apply_p, $x))) {
    return _concat("^(", call($simple_print, call($delay_apply_f, $x)), " ", call($simple_print, call($jsArray_to_list, call($delay_apply_xs, $x))), ")");
  }








  return call($ERROR);
});
$simple_print_force_all_rec = new Func("simple_print_force_all_rec", function($x = null) use (&$simple_print, &$force_all_rec) {
  return call($simple_print, call($force_all_rec, $x));
});
$simple_parse = new Func("simple_parse", function($x = null) use (&$ASSERT, &$new_symbol, &$null_v, &$construction_p, &$ERROR, &$construction_tail, &$new_construction, &$new_data, &$construction_head, &$new_error, &$null_p, &$val2env, &$evaluate, &$list_to_jsArray, &$builtin_func_apply, &$builtin_form_apply, &$apply) {
  $state_const = null; $state = null; $readeval = null; $readfuncapply = null; $readformbuiltin = null; $readapply = null;
  $eof = new Func("eof", function() use (&$state, &$state_const) {
    return get($state_const, "length") === $state;
  });
  $get = new Func("get", function() use (&$ASSERT, &$eof, &$state_const, &$state) {
    $ret = null;
    call($ASSERT, not(call($eof)));
    $ret = get($state_const, $state);
    $state++;
    return $ret;
  });
  $put = new Func("put", function($x = null) use (&$ASSERT, &$state_const, &$state) {
    call($ASSERT, get($state_const, to_number($state) - 1.0) === $x);
    $state--;
  });
  $parse_error = new Func("parse_error", function() {
    throw new Ex("TheLanguage parse ERROR!");
  });
  $a_space_p = new Func("a_space_p", function($x = null) {
    return $x === " " || $x === "\n" || $x === "\t" || $x === "\r";
  });
  $space = new Func("space", function() use (&$eof, &$get, &$a_space_p, &$put) {
    $x = null;
    if (is(call($eof))) {
      return false;
    }
    $x = call($get);
    if (not(call($a_space_p, $x))) {
      call($put, $x);
      return false;
    }
    while (is(call($a_space_p, $x)) && not(call($eof))) {
      $x = call($get);
    }
    if (not(call($a_space_p, $x))) {
      call($put, $x);
    }
    return true;
  });
  $symbol = new Func("symbol", function() use (&$eof, &$get, &$a_symbol_p, &$put, &$new_symbol) {
    $x = null; $ret = null;
    if (is(call($eof))) {
      return false;
    }
    $x = call($get);
    $ret = "";
    if (not(call($a_symbol_p, $x))) {
      call($put, $x);
      return false;
    }
    while (is(call($a_symbol_p, $x)) && not(call($eof))) {
      $ret = _plus($ret, $x);
      $x = call($get);
    }
    if (is(call($a_symbol_p, $x))) {
      $ret = _plus($ret, $x);
    } else {
      call($put, $x);
    }

    return call($new_symbol, $ret);
  });
  $list = new Func("list", function() use (&$eof, &$get, &$put, &$new_symbol, &$space, &$parse_error, &$null_v, &$val, &$construction_p, &$ERROR, &$construction_tail, &$new_construction) {
    $x = null; $HOLE = null; $ret = null; $e_1 = null; $e = null;
    $set_last = new Func("set_last", function($lst = null) use (&$ret, &$HOLE, &$construction_p, &$ERROR, &$construction_tail) {
      $x = null; $d = null;
      if ($ret === $HOLE) {
        $ret = $lst;
        return ;
      }
      $x = $ret;
      while (true) {
        if (not(call($construction_p, $x))) {
          return call($ERROR);
        }
        $d = call($construction_tail, $x);
        if ($d === $HOLE) {
          break;
        }
        $x = call($construction_tail, $x);
      }
      if (not(call($construction_p, $x))) {
        return call($ERROR);
      }
      if (call($construction_tail, $x) !== $HOLE) {
        return call($ERROR);
      }
      set($x, 2.0, $lst);
    });
    $last_add = new Func("last_add", function($x = null) use (&$set_last, &$new_construction, &$HOLE) {
      call($set_last, call($new_construction, $x, $HOLE));
    });
    if (is(call($eof))) {
      return false;
    }
    $x = call($get);
    if ($x !== "(") {
      call($put, $x);
      return false;
    }
    $HOLE = call($new_symbol, "!!@@READ||HOLE@@!!");
    $ret = $HOLE;
    while (true) {
      call($space);
      if (is(call($eof))) {
        return call($parse_error);
      }
      $x = call($get);
      if ($x === ")") {
        call($set_last, $null_v);
        return $ret;
      }
      if ($x === ".") {
        call($space);
        $e_1 = call($val);
        call($set_last, $e_1);
        call($space);
        if (is(call($eof))) {
          return call($parse_error);
        }
        $x = call($get);
        if ($x !== ")") {
          return call($parse_error);
        }
        return $ret;
      }
      call($put, $x);
      $e = call($val);
      call($last_add, $e);
    }
  });
  $data = new Func("data", function() use (&$eof, &$get, &$put, &$list, &$parse_error, &$construction_p, &$new_data, &$construction_head, &$construction_tail) {
    $x = null; $xs = null;
    if (is(call($eof))) {
      return false;
    }
    $x = call($get);
    if ($x !== "#") {
      call($put, $x);
      return false;
    }
    $xs = call($list);
    if ($xs === false) {
      return call($parse_error);
    }
    if (not(call($construction_p, $xs))) {
      return call($parse_error);
    }
    return call($new_data, call($construction_head, $xs), call($construction_tail, $xs));
  });
  $readerror = new Func("readerror", function() use (&$eof, &$get, &$put, &$list, &$parse_error, &$construction_p, &$new_error, &$construction_head, &$construction_tail) {
    $x = null; $xs = null;
    if (is(call($eof))) {
      return false;
    }
    $x = call($get);
    if ($x !== "!") {
      call($put, $x);
      return false;
    }
    $xs = call($list);
    if ($xs === false) {
      return call($parse_error);
    }
    if (not(call($construction_p, $xs))) {
      return call($parse_error);
    }
    return call($new_error, call($construction_head, $xs), call($construction_tail, $xs));
  });
  $make_read_two = new Func("make_read_two", function($prefix = null, $k = null) use (&$eof, &$get, &$put, &$list, &$parse_error, &$construction_p, &$construction_tail, &$null_p, &$construction_head) {
    return new Func(function() use (&$eof, &$get, &$prefix, &$put, &$list, &$parse_error, &$construction_p, &$construction_tail, &$null_p, &$k, &$construction_head) {
      $c = null; $xs = null; $x = null;
      if (is(call($eof))) {
        return false;
      }
      $c = call($get);
      if ($c !== $prefix) {
        call($put, $c);
        return false;
      }
      $xs = call($list);
      if ($xs === false) {
        return call($parse_error);
      }
      if (not(call($construction_p, $xs))) {
        return call($parse_error);
      }
      $x = call($construction_tail, $xs);
      if (not((is($and_ = call($construction_p, $x)) ? call($null_p, call($construction_tail, $x)) : $and_))) {
        return call($parse_error);
      }
      return call($k, call($construction_head, $xs), call($construction_head, $x));
    });
  });
  $make_read_three = new Func("make_read_three", function($prefix = null, $k = null) use (&$eof, &$get, &$put, &$list, &$parse_error, &$construction_p, &$construction_tail, &$null_p, &$construction_head) {
    return new Func(function() use (&$eof, &$get, &$prefix, &$put, &$list, &$parse_error, &$construction_p, &$construction_tail, &$null_p, &$k, &$construction_head) {
      $c = null; $xs = null; $x = null; $x_d = null;
      if (is(call($eof))) {
        return false;
      }
      $c = call($get);
      if ($c !== $prefix) {
        call($put, $c);
        return false;
      }
      $xs = call($list);
      if ($xs === false) {
        return call($parse_error);
      }
      if (not(call($construction_p, $xs))) {
        return call($parse_error);
      }
      $x = call($construction_tail, $xs);
      if (not(call($construction_p, $x))) {
        return call($parse_error);
      }
      $x_d = call($construction_tail, $x);
      if (not((is($and_ = call($construction_p, $x_d)) ? call($null_p, call($construction_tail, $x_d)) : $and_))) {
        return call($parse_error);
      }
      return call($k, call($construction_head, $xs), call($construction_head, $x), call($construction_head, $x_d));
    });
  });
  $a_symbol_p = new Func("a_symbol_p", function($x = null) use (&$a_space_p) {
    $not_xs = null; $i = null;
    if (is(call($a_space_p, $x))) {
      return false;
    }
    $not_xs = new Arr("(", ")", "!", "#", ".", "\$", "%", "^", "@", "~", "/", "-", ">", "_", ":", "?", "[", "]", "&");
    for ($i = 0.0; $i < get($not_xs, "length"); $i++) {
      if ($x === get($not_xs, $i)) {
        return false;
      }
    }
    return true;
  });
  $val = new Func("val", function() use (&$space, &$list, &$symbol, &$data, &$readerror, &$readeval, &$readfuncapply, &$readformbuiltin, &$readapply, &$parse_error) {
    $fs = null; $i = null; $x_2 = null;
    call($space);
    $fs = new Arr($list, $symbol, $data, $readerror, $readeval, $readfuncapply, $readformbuiltin, $readapply);
    for ($i = 0.0; $i < get($fs, "length"); $i++) {
      $x_2 = call_method($fs, $i);
      if ($x_2 !== false) {
        return $x_2;
      }
    }
    return call($parse_error);
  });
  $state_const = $x;
  $state = 0.0;
  $readeval = call($make_read_two, "\$", new Func(function($e = null, $x = null) use (&$val2env, &$parse_error, &$evaluate) {
    $env = null;
    $env = call($val2env, $e);
    if ($env === false) {
      return call($parse_error);
    }
    return call($evaluate, $env, $x);
  }));
  $readfuncapply = call($make_read_two, "%", new Func(function($f = null, $xs = null) use (&$list_to_jsArray, &$builtin_func_apply, &$parse_error) {
    $jsxs = null;
    $jsxs = call($list_to_jsArray, $xs, new Func(function($xs = null) {
      return $xs;
    }), new Func(function($xs = null, $y = null) use (&$parse_error) {
      return call($parse_error);
    }));
    return call($builtin_func_apply, $f, $jsxs);
  }));
  $readformbuiltin = call($make_read_three, "@", new Func(function($e = null, $f = null, $xs = null) use (&$list_to_jsArray, &$val2env, &$parse_error, &$builtin_form_apply) {
    $jsxs = null; $env = null;
    $jsxs = call($list_to_jsArray, $xs, new Func(function($xs = null) {
      return $xs;
    }), new Func(function($xs = null, $y = null) use (&$parse_error) {
      return call($parse_error);
    }));
    $env = call($val2env, $e);
    if ($env === false) {
      return call($parse_error);
    }
    return call($builtin_form_apply, $env, $f, $jsxs);
  }));
  $readapply = call($make_read_two, "^", new Func(function($f = null, $xs = null) use (&$list_to_jsArray, &$apply, &$parse_error) {
    $jsxs = null;
    $jsxs = call($list_to_jsArray, $xs, new Func(function($xs = null) {
      return $xs;
    }), new Func(function($xs = null, $y = null) use (&$parse_error) {
      return call($parse_error);
    }));
    return call($apply, $f, $jsxs);
  }));
  return call($val);
});
$complex_parse = new Func("complex_parse", function($x = null) use (&$ASSERT, &$new_symbol, &$null_v, &$construction_p, &$ERROR, &$construction_tail, &$new_construction, &$new_data, &$construction_head, &$new_error, &$null_p, &$val2env, &$evaluate, &$list_to_jsArray, &$builtin_func_apply, &$builtin_form_apply, &$apply, &$new_list, &$form_symbol, &$system_symbol, &$typeAnnotation_symbol, &$theThing_symbol, &$function_symbol, &$something_symbol, &$isOrNot_symbol, &$sub_symbol, &$jsArray_to_list, &$symbol_p, &$systemName_make) {
  $state_const = null; $state = null; $readeval = null; $readfuncapply = null; $readformbuiltin = null; $readapply = null;
  $eof = new Func("eof", function() use (&$state, &$state_const) {
    return get($state_const, "length") === $state;
  });
  $get = new Func("get", function() use (&$ASSERT, &$eof, &$state_const, &$state) {
    $ret = null;
    call($ASSERT, not(call($eof)));
    $ret = get($state_const, $state);
    $state++;
    return $ret;
  });
  $put = new Func("put", function($x = null) use (&$ASSERT, &$state_const, &$state) {
    call($ASSERT, get($state_const, to_number($state) - 1.0) === $x);
    $state--;
  });
  $parse_error = new Func("parse_error", function() {
    throw new Ex("TheLanguage parse ERROR!");
  });
  $a_space_p = new Func("a_space_p", function($x = null) {
    return $x === " " || $x === "\n" || $x === "\t" || $x === "\r";
  });
  $space = new Func("space", function() use (&$eof, &$get, &$a_space_p, &$put) {
    $x = null;
    if (is(call($eof))) {
      return false;
    }
    $x = call($get);
    if (not(call($a_space_p, $x))) {
      call($put, $x);
      return false;
    }
    while (is(call($a_space_p, $x)) && not(call($eof))) {
      $x = call($get);
    }
    if (not(call($a_space_p, $x))) {
      call($put, $x);
    }
    return true;
  });
  $symbol = new Func("symbol", function() use (&$eof, &$get, &$a_symbol_p, &$put, &$new_symbol) {
    $x = null; $ret = null;
    if (is(call($eof))) {
      return false;
    }
    $x = call($get);
    $ret = "";
    if (not(call($a_symbol_p, $x))) {
      call($put, $x);
      return false;
    }
    while (is(call($a_symbol_p, $x)) && not(call($eof))) {
      $ret = _plus($ret, $x);
      $x = call($get);
    }
    if (is(call($a_symbol_p, $x))) {
      $ret = _plus($ret, $x);
    } else {
      call($put, $x);
    }

    return call($new_symbol, $ret);
  });
  $list = new Func("list", function() use (&$eof, &$get, &$put, &$new_symbol, &$space, &$parse_error, &$null_v, &$val, &$construction_p, &$ERROR, &$construction_tail, &$new_construction) {
    $x = null; $HOLE = null; $ret = null; $e_2 = null; $e = null;
    $set_last = new Func("set_last", function($lst = null) use (&$ret, &$HOLE, &$construction_p, &$ERROR, &$construction_tail) {
      $x = null; $d = null;
      if ($ret === $HOLE) {
        $ret = $lst;
        return ;
      }
      $x = $ret;
      while (true) {
        if (not(call($construction_p, $x))) {
          return call($ERROR);
        }
        $d = call($construction_tail, $x);
        if ($d === $HOLE) {
          break;
        }
        $x = call($construction_tail, $x);
      }
      if (not(call($construction_p, $x))) {
        return call($ERROR);
      }
      if (call($construction_tail, $x) !== $HOLE) {
        return call($ERROR);
      }
      set($x, 2.0, $lst);
    });
    $last_add = new Func("last_add", function($x = null) use (&$set_last, &$new_construction, &$HOLE) {
      call($set_last, call($new_construction, $x, $HOLE));
    });
    if (is(call($eof))) {
      return false;
    }
    $x = call($get);
    if ($x !== "(") {
      call($put, $x);
      return false;
    }
    $HOLE = call($new_symbol, "!!@@READ||HOLE@@!!");
    $ret = $HOLE;
    while (true) {
      call($space);
      if (is(call($eof))) {
        return call($parse_error);
      }
      $x = call($get);
      if ($x === ")") {
        call($set_last, $null_v);
        return $ret;
      }
      if ($x === ".") {
        call($space);
        $e_2 = call($val);
        call($set_last, $e_2);
        call($space);
        if (is(call($eof))) {
          return call($parse_error);
        }
        $x = call($get);
        if ($x !== ")") {
          return call($parse_error);
        }
        return $ret;
      }
      call($put, $x);
      $e = call($val);
      call($last_add, $e);
    }
  });
  $data = new Func("data", function() use (&$eof, &$get, &$put, &$list, &$parse_error, &$construction_p, &$new_data, &$construction_head, &$construction_tail) {
    $x = null; $xs = null;
    if (is(call($eof))) {
      return false;
    }
    $x = call($get);
    if ($x !== "#") {
      call($put, $x);
      return false;
    }
    $xs = call($list);
    if ($xs === false) {
      return call($parse_error);
    }
    if (not(call($construction_p, $xs))) {
      return call($parse_error);
    }
    return call($new_data, call($construction_head, $xs), call($construction_tail, $xs));
  });
  $readerror = new Func("readerror", function() use (&$eof, &$get, &$put, &$list, &$parse_error, &$construction_p, &$new_error, &$construction_head, &$construction_tail) {
    $x = null; $xs = null;
    if (is(call($eof))) {
      return false;
    }
    $x = call($get);
    if ($x !== "!") {
      call($put, $x);
      return false;
    }
    $xs = call($list);
    if ($xs === false) {
      return call($parse_error);
    }
    if (not(call($construction_p, $xs))) {
      return call($parse_error);
    }
    return call($new_error, call($construction_head, $xs), call($construction_tail, $xs));
  });
  $make_read_two = new Func("make_read_two", function($prefix = null, $k = null) use (&$eof, &$get, &$put, &$list, &$parse_error, &$construction_p, &$construction_tail, &$null_p, &$construction_head) {
    return new Func(function() use (&$eof, &$get, &$prefix, &$put, &$list, &$parse_error, &$construction_p, &$construction_tail, &$null_p, &$k, &$construction_head) {
      $c = null; $xs = null; $x = null;
      if (is(call($eof))) {
        return false;
      }
      $c = call($get);
      if ($c !== $prefix) {
        call($put, $c);
        return false;
      }
      $xs = call($list);
      if ($xs === false) {
        return call($parse_error);
      }
      if (not(call($construction_p, $xs))) {
        return call($parse_error);
      }
      $x = call($construction_tail, $xs);
      if (not((is($and_ = call($construction_p, $x)) ? call($null_p, call($construction_tail, $x)) : $and_))) {
        return call($parse_error);
      }
      return call($k, call($construction_head, $xs), call($construction_head, $x));
    });
  });
  $make_read_three = new Func("make_read_three", function($prefix = null, $k = null) use (&$eof, &$get, &$put, &$list, &$parse_error, &$construction_p, &$construction_tail, &$null_p, &$construction_head) {
    return new Func(function() use (&$eof, &$get, &$prefix, &$put, &$list, &$parse_error, &$construction_p, &$construction_tail, &$null_p, &$k, &$construction_head) {
      $c = null; $xs = null; $x = null; $x_d = null;
      if (is(call($eof))) {
        return false;
      }
      $c = call($get);
      if ($c !== $prefix) {
        call($put, $c);
        return false;
      }
      $xs = call($list);
      if ($xs === false) {
        return call($parse_error);
      }
      if (not(call($construction_p, $xs))) {
        return call($parse_error);
      }
      $x = call($construction_tail, $xs);
      if (not(call($construction_p, $x))) {
        return call($parse_error);
      }
      $x_d = call($construction_tail, $x);
      if (not((is($and_ = call($construction_p, $x_d)) ? call($null_p, call($construction_tail, $x_d)) : $and_))) {
        return call($parse_error);
      }
      return call($k, call($construction_head, $xs), call($construction_head, $x), call($construction_head, $x_d));
    });
  });
  $a_symbol_p = new Func("a_symbol_p", function($x = null) use (&$a_space_p) {
    $not_xs = null; $i = null;
    if (is(call($a_space_p, $x))) {
      return false;
    }
    $not_xs = new Arr("(", ")", "!", "#", ".", "\$", "%", "^", "@", "~", "/", "-", ">", "_", ":", "?", "[", "]", "&");
    for ($i = 0.0; $i < get($not_xs, "length"); $i++) {
      if ($x === get($not_xs, $i)) {
        return false;
      }
    }
    return true;
  });
  $val = new Func("val", function() use (&$space, &$list, &$readsysname, &$data, &$readerror, &$readeval, &$readfuncapply, &$readformbuiltin, &$readapply, &$parse_error) {
    $fs = null; $i = null; $x_3 = null;
    call($space);
    $fs = new Arr($list, $readsysname, $data, $readerror, $readeval, $readfuncapply, $readformbuiltin, $readapply);
    for ($i = 0.0; $i < get($fs, "length"); $i++) {
      $x_3 = call_method($fs, $i);
      if ($x_3 !== false) {
        return $x_3;
      }
    }
    return call($parse_error);
  });
  $un_maybe = new Func("un_maybe", function($x = null) use (&$parse_error) {
    if ($x === false) {
      return call($parse_error);
    }
    return $x;
  });
  $not_eof = new Func("not_eof", function() use (&$eof) {
    return not(call($eof));
  });
  $assert_get = new Func("assert_get", function($c = null) use (&$un_maybe, &$not_eof, &$get) {
    call($un_maybe, call($not_eof));
    call($un_maybe, call($get) === $c);
  });
  $readsysname_no_pack = new Func("readsysname_no_pack", function() use (&$eof, &$get, &$un_maybe, &$not_eof, &$new_list, &$form_symbol, &$system_symbol, &$put, &$assert_get, &$typeAnnotation_symbol, &$theThing_symbol, &$function_symbol, &$something_symbol, &$symbol, &$ERROR, &$list, &$data, &$readerror, &$readeval, &$readfuncapply, &$readformbuiltin, &$readapply, &$parse_error, &$isOrNot_symbol, &$new_construction, &$sub_symbol, &$jsArray_to_list) {
    $readsysname_no_pack = Func::getCurrent();
    $head = null; $c0 = null; $x_4 = null; $x_5 = null; $x_6 = null; $x_7 = null; $x_8 = null; $x_9 = null; $x_10 = null; $x_11 = null; $x_12 = null;
    $readsysname_no_pack_inner_must = new Func("readsysname_no_pack_inner_must", function($strict = null) use (&$list, &$symbol, &$data, &$readerror, &$readeval, &$readfuncapply, &$readformbuiltin, &$readapply, &$readsysname_no_pack, &$parse_error, &$assert_get) {
      $readsysname_no_pack_inner_must = Func::getCurrent();
      $fs = null; $i = null; $x_13 = null;
      $readsysname_no_pack_bracket = new Func("readsysname_no_pack_bracket", function() use (&$assert_get, &$readsysname_no_pack_inner_must) {
        $x = null;
        call($assert_get, "[");
        $x = call($readsysname_no_pack_inner_must);
        call($assert_get, "]");
        return $x;
      });
      if ($strict === _void(0.0)) {
        $strict = false;
      }
      $fs = is($strict) ? new Arr($list, $symbol, $readsysname_no_pack_bracket, $data, $readerror, $readeval, $readfuncapply, $readformbuiltin, $readapply) : new Arr($list, $readsysname_no_pack, $data, $readerror, $readeval, $readfuncapply, $readformbuiltin, $readapply);
      for ($i = 0.0; $i < get($fs, "length"); $i++) {
        $x_13 = call_method($fs, $i);
        if ($x_13 !== false) {
          return $x_13;
        }
      }
      return call($parse_error);
    });
    $may_xfx_xf = new Func("may_xfx_xf", function($x = null) use (&$eof, &$get, &$readsysname_no_pack_inner_must, &$new_list, &$typeAnnotation_symbol, &$function_symbol, &$something_symbol, &$isOrNot_symbol, &$new_construction, &$put, &$sub_symbol, &$jsArray_to_list, &$ERROR) {
      $head = null; $y = null; $ys = null; $c0 = null;
      if (is(call($eof))) {
        return $x;
      }
      $head = call($get);
      if ($head === ".") {
        $y = call($readsysname_no_pack_inner_must);
        return call($new_list, $typeAnnotation_symbol, call($new_list, $function_symbol, call($new_list, $x), $something_symbol), $y);
      } else if ($head === ":") {
        $y = call($readsysname_no_pack_inner_must);
        return call($new_list, $typeAnnotation_symbol, $y, $x);
      } else if ($head === "~") {
        return call($new_list, $isOrNot_symbol, $x);
      } else if ($head === "@") {
        $y = call($readsysname_no_pack_inner_must);
        return call($new_list, $typeAnnotation_symbol, call($new_list, $function_symbol, call($new_construction, $x, $something_symbol), $something_symbol), $y);
      } else if ($head === "?") {
        return call($new_list, $typeAnnotation_symbol, $function_symbol, call($new_list, $isOrNot_symbol, $x));
      } else if ($head === "/") {
        $ys = new Arr($x);
        while (true) {
          $y = call($readsysname_no_pack_inner_must, true);
          call_method($ys, "push", $y);
          if (is(call($eof))) {
            break;
          }
          $c0 = call($get);
          if ($c0 !== "/") {
            call($put, $c0);
            break;
          }
        }
        return call($new_list, $sub_symbol, call($jsArray_to_list, $ys));
      } else {
        call($put, $head);
        return $x;
      }






      return call($ERROR);
    });
    if (is(call($eof))) {
      return false;
    }
    $head = call($get);
    if ($head === "&") {
      call($un_maybe, call($not_eof));
      $c0 = call($get);
      if ($c0 === "+") {
        $x_4 = call($readsysname_no_pack_inner_must);
        return call($new_list, $form_symbol, call($new_list, $system_symbol, $x_4));
      } else {
        call($put, $c0);
      }

      $x_5 = call($readsysname_no_pack_inner_must);
      return call($new_list, $form_symbol, $x_5);
    } else if ($head === ":") {
      call($un_maybe, call($not_eof));
      $c0 = call($get);
      if ($c0 === "&") {
        call($assert_get, ">");
        $x_6 = call($readsysname_no_pack_inner_must);
        return call($new_list, $typeAnnotation_symbol, call($new_list, $form_symbol, call($new_list, $function_symbol, $something_symbol, $x_6)), $theThing_symbol);
      } else if ($c0 === ">") {
        $x_7 = call($readsysname_no_pack_inner_must);
        return call($new_list, $typeAnnotation_symbol, call($new_list, $function_symbol, $something_symbol, $x_7), $theThing_symbol);
      } else {
        call($put, $c0);
      }


      $x_8 = call($readsysname_no_pack_inner_must);
      return call($new_list, $typeAnnotation_symbol, $x_8, $theThing_symbol);
    } else if ($head === "+") {
      $x_9 = call($readsysname_no_pack_inner_must);
      return call($new_list, $system_symbol, $x_9);
    } else if ($head === "[") {
      $x_10 = call($readsysname_no_pack_inner_must);
      call($assert_get, "]");
      return call($may_xfx_xf, $x_10);
    } else if ($head === "_") {
      call($assert_get, ":");
      $x_11 = call($readsysname_no_pack_inner_must);
      return call($new_list, $typeAnnotation_symbol, $x_11, $something_symbol);
    } else {
      call($put, $head);
      $x_12 = call($symbol);
      if ($x_12 === false) {
        return false;
      }
      return call($may_xfx_xf, $x_12);
    }





    return call($ERROR);
    return call($ERROR);
  });
  $readsysname = new Func("readsysname", function() use (&$readsysname_no_pack, &$symbol_p, &$systemName_make) {
    $x = null;
    $x = call($readsysname_no_pack);
    if ($x === false) {
      return false;
    }
    if (is(call($symbol_p, $x))) {
      return $x;
    }
    return call($systemName_make, $x);
  });
  $state_const = $x;
  $state = 0.0;
  $readeval = call($make_read_two, "\$", new Func(function($e = null, $x = null) use (&$val2env, &$parse_error, &$evaluate) {
    $env = null;
    $env = call($val2env, $e);
    if ($env === false) {
      return call($parse_error);
    }
    return call($evaluate, $env, $x);
  }));
  $readfuncapply = call($make_read_two, "%", new Func(function($f = null, $xs = null) use (&$list_to_jsArray, &$builtin_func_apply, &$parse_error) {
    $jsxs = null;
    $jsxs = call($list_to_jsArray, $xs, new Func(function($xs = null) {
      return $xs;
    }), new Func(function($xs = null, $y = null) use (&$parse_error) {
      return call($parse_error);
    }));
    return call($builtin_func_apply, $f, $jsxs);
  }));
  $readformbuiltin = call($make_read_three, "@", new Func(function($e = null, $f = null, $xs = null) use (&$list_to_jsArray, &$val2env, &$parse_error, &$builtin_form_apply) {
    $jsxs = null; $env = null;
    $jsxs = call($list_to_jsArray, $xs, new Func(function($xs = null) {
      return $xs;
    }), new Func(function($xs = null, $y = null) use (&$parse_error) {
      return call($parse_error);
    }));
    $env = call($val2env, $e);
    if ($env === false) {
      return call($parse_error);
    }
    return call($builtin_form_apply, $env, $f, $jsxs);
  }));
  $readapply = call($make_read_two, "^", new Func(function($f = null, $xs = null) use (&$list_to_jsArray, &$apply, &$parse_error) {
    $jsxs = null;
    $jsxs = call($list_to_jsArray, $xs, new Func(function($xs = null) {
      return $xs;
    }), new Func(function($xs = null, $y = null) use (&$parse_error) {
      return call($parse_error);
    }));
    return call($apply, $f, $jsxs);
  }));
  return call($val);
});
$complex_print = new Func("complex_print", function($val = null) use (&$simple_parse, &$simple_print, &$null_p, &$construction_p, &$construction_head, &$construction_tail, &$data_p, &$data_name, &$data_list, &$maybe_list_to_jsArray, &$jsbool_no_force_equal_p, &$name_symbol, &$system_symbol, &$new_construction, &$error_p, &$error_name, &$error_list, &$symbol_p, &$un_symbol, &$delay_evaluate_p, &$env2val, &$delay_evaluate_env, &$delay_evaluate_x, &$delay_builtin_func_p, &$delay_builtin_func_f, &$jsArray_to_list, &$delay_builtin_func_xs, &$delay_builtin_form_p, &$delay_builtin_form_env, &$delay_builtin_form_f, &$delay_builtin_form_xs, &$delay_apply_p, &$delay_apply_f, &$delay_apply_xs, &$ERROR, &$typeAnnotation_symbol, &$function_symbol, &$something_symbol, &$theThing_symbol, &$isOrNot_symbol, &$form_symbol, &$sub_symbol, &$systemName_make) {
  $complex_print = Func::getCurrent();
  $x = null; $temp = null; $prefix = null; $name_1 = null; $list = null; $maybe_xs = null;
  $print_sys_name = new Func("print_sys_name", function($x = null, $where = null) use (&$symbol_p, &$un_symbol, &$maybe_list_to_jsArray, &$jsbool_no_force_equal_p, &$typeAnnotation_symbol, &$function_symbol, &$something_symbol, &$construction_p, &$construction_tail, &$construction_head, &$theThing_symbol, &$isOrNot_symbol, &$form_symbol, &$system_symbol, &$sub_symbol, &$simple_print, &$systemName_make, &$ERROR) {
    $print_sys_name = Func::getCurrent();
    $maybe_xs = null; $maybe_lst_2 = null; $var_2_1 = null; $maybe_lst_3 = null; $maybe_lst_44 = null; $maybe_lst_88 = null; $hd = null; $maybe_lst_288 = null; $maybe_lst_8934 = null; $tmp = null; $i = null;
    $inner_bracket = new Func("inner_bracket", function($x = null) use (&$where, &$ERROR) {
      if ($where === "inner") {
        return _concat("[", $x, "]");
      } else if ($where === "top") {
        return $x;
      }

      return call($ERROR);
    });
    if (is(call($symbol_p, $x))) {
      return call($un_symbol, $x);
    }
    $maybe_xs = call($maybe_list_to_jsArray, $x);
    if ($maybe_xs !== false && get($maybe_xs, "length") === 3.0 && is(call($jsbool_no_force_equal_p, get($maybe_xs, 0.0), $typeAnnotation_symbol))) {
      $maybe_lst_2 = call($maybe_list_to_jsArray, get($maybe_xs, 1.0));
      if ($maybe_lst_2 !== false && get($maybe_lst_2, "length") === 3.0 && is(call($jsbool_no_force_equal_p, get($maybe_lst_2, 0.0), $function_symbol))) {
        $var_2_1 = get($maybe_lst_2, 1.0);
        $maybe_lst_3 = call($maybe_list_to_jsArray, $var_2_1);
        if ($maybe_lst_3 !== false && get($maybe_lst_3, "length") === 1.0 && is(call($jsbool_no_force_equal_p, get($maybe_lst_2, 2.0), $something_symbol))) {
          return call($inner_bracket, _concat(call($print_sys_name, get($maybe_lst_3, 0.0), "inner"), ".", call($print_sys_name, get($maybe_xs, 2.0), "inner")));
        } else if (is(call($construction_p, $var_2_1)) && is(call($jsbool_no_force_equal_p, call($construction_tail, $var_2_1), $something_symbol)) && is(call($jsbool_no_force_equal_p, get($maybe_lst_2, 2.0), $something_symbol))) {
          return call($inner_bracket, _concat(call($print_sys_name, call($construction_head, $var_2_1), "inner"), "@", call($print_sys_name, get($maybe_xs, 2.0), "inner")));
        } else if (is(call($jsbool_no_force_equal_p, $var_2_1, $something_symbol)) && is(call($jsbool_no_force_equal_p, get($maybe_xs, 2.0), $theThing_symbol))) {
          return call($inner_bracket, _concat(":>", call($print_sys_name, get($maybe_lst_2, 2.0), "inner")));
        }


      }
      $maybe_lst_44 = call($maybe_list_to_jsArray, get($maybe_xs, 2.0));
      if (is(call($jsbool_no_force_equal_p, get($maybe_xs, 1.0), $function_symbol)) && $maybe_lst_44 !== false && get($maybe_lst_44, "length") === 2.0 && is(call($jsbool_no_force_equal_p, get($maybe_lst_44, 0.0), $isOrNot_symbol))) {
        return call($inner_bracket, _concat(call($print_sys_name, get($maybe_lst_44, 1.0), "inner"), "?"));
      }
      if ($maybe_lst_2 !== false && get($maybe_lst_2, "length") === 2.0 && is(call($jsbool_no_force_equal_p, get($maybe_xs, 2.0), $theThing_symbol)) && is(call($jsbool_no_force_equal_p, get($maybe_lst_2, 0.0), $form_symbol))) {
        $maybe_lst_88 = call($maybe_list_to_jsArray, get($maybe_lst_2, 1.0));
        if ($maybe_lst_88 !== false && get($maybe_lst_88, "length") === 3.0 && is(call($jsbool_no_force_equal_p, get($maybe_lst_88, 0.0), $function_symbol)) && is(call($jsbool_no_force_equal_p, get($maybe_lst_88, 1.0), $something_symbol))) {
          return call($inner_bracket, _concat(":&>", call($print_sys_name, get($maybe_lst_88, 2.0), "inner")));
        }
      }
      $hd = is(call($jsbool_no_force_equal_p, get($maybe_xs, 2.0), $something_symbol)) ? "_" : (is(call($jsbool_no_force_equal_p, get($maybe_xs, 2.0), $theThing_symbol)) ? "" : call($print_sys_name, get($maybe_xs, 2.0), "inner"));
      return call($inner_bracket, _concat($hd, ":", call($print_sys_name, get($maybe_xs, 1.0), "inner")));
    } else if ($maybe_xs !== false && get($maybe_xs, "length") === 2.0) {
      if (is(call($jsbool_no_force_equal_p, get($maybe_xs, 0.0), $form_symbol))) {
        $maybe_lst_288 = call($maybe_list_to_jsArray, get($maybe_xs, 1.0));
        if ($maybe_lst_288 !== false && get($maybe_lst_288, "length") === 2.0 && is(call($jsbool_no_force_equal_p, get($maybe_lst_288, 0.0), $system_symbol))) {
          return call($inner_bracket, _concat("&+", call($print_sys_name, get($maybe_lst_288, 1.0), "inner")));
        }
        return call($inner_bracket, _concat("&", call($print_sys_name, get($maybe_xs, 1.0), "inner")));
      } else if (is(call($jsbool_no_force_equal_p, get($maybe_xs, 0.0), $isOrNot_symbol))) {
        return call($inner_bracket, _concat(call($print_sys_name, get($maybe_xs, 1.0), "inner"), "~"));
      } else if (is(call($jsbool_no_force_equal_p, get($maybe_xs, 0.0), $system_symbol))) {
        return call($inner_bracket, _concat("+", call($print_sys_name, get($maybe_xs, 1.0), "inner")));
      } else if (is(call($jsbool_no_force_equal_p, get($maybe_xs, 0.0), $sub_symbol))) {
        $maybe_lst_8934 = call($maybe_list_to_jsArray, get($maybe_xs, 1.0));
        if ($maybe_lst_8934 !== false && get($maybe_lst_8934, "length") > 1.0) {
          $tmp = call($print_sys_name, get($maybe_lst_8934, 0.0), "inner");
          for ($i = 1.0; $i < get($maybe_lst_8934, "length"); $i++) {
            $tmp = _plus($tmp, _concat("/", call($print_sys_name, get($maybe_lst_8934, $i), "inner")));
          }
          return call($inner_bracket, $tmp);
        }
      }



    }

    if ($where === "inner") {
      return call($simple_print, $x);
    } else if ($where === "top") {
      return call($simple_print, call($systemName_make, $x));
    }

    return call($ERROR);
  });
  $x = call($simple_parse, call($simple_print, $val));
  $temp = "";
  $prefix = "";
  if (is(call($null_p, $x))) {
    return "()";
  } else if (is(call($construction_p, $x))) {
    $temp = "(";
    $prefix = "";
    while (is(call($construction_p, $x))) {
      $temp = _plus($temp, _plus($prefix, call($complex_print, call($construction_head, $x))));
      $prefix = " ";
      $x = call($construction_tail, $x);
    }
    if (is(call($null_p, $x))) {
      $temp = _plus($temp, ")");
    } else {
      $temp = _plus($temp, _concat(" . ", call($complex_print, $x), ")"));
    }

    return $temp;
  } else if (is(call($data_p, $x))) {
    $name_1 = call($data_name, $x);
    $list = call($data_list, $x);
    $maybe_xs = call($maybe_list_to_jsArray, $list);
    if ($maybe_xs !== false && get($maybe_xs, "length") === 2.0 && is(call($jsbool_no_force_equal_p, $name_1, $name_symbol)) && is(call($jsbool_no_force_equal_p, get($maybe_xs, 0.0), $system_symbol))) {
      return call($print_sys_name, get($maybe_xs, 1.0), "top");
    }
    return _concat("#", call($complex_print, call($new_construction, $name_1, $list)));
  } else if (is(call($error_p, $x))) {
    return _concat("!", call($complex_print, call($new_construction, call($error_name, $x), call($error_list, $x))));
  } else if (is(call($symbol_p, $x))) {
    return call($un_symbol, $x);
  } else if (is(call($delay_evaluate_p, $x))) {
    return _concat("\$(", call($complex_print, call($env2val, call($delay_evaluate_env, $x))), " ", call($complex_print, call($delay_evaluate_x, $x)), ")");
  } else if (is(call($delay_builtin_func_p, $x))) {
    return _concat("%(", call($complex_print, call($delay_builtin_func_f, $x)), " ", call($complex_print, call($jsArray_to_list, call($delay_builtin_func_xs, $x))), ")");
  } else if (is(call($delay_builtin_form_p, $x))) {
    return _concat("@(", call($complex_print, call($env2val, call($delay_builtin_form_env, $x))), " ", call($complex_print, call($delay_builtin_form_f, $x)), " ", call($complex_print, call($jsArray_to_list, call($delay_builtin_form_xs, $x))), ")");
  } else if (is(call($delay_apply_p, $x))) {
    return _concat("^(", call($complex_print, call($delay_apply_f, $x)), " ", call($complex_print, call($jsArray_to_list, call($delay_apply_xs, $x))), ")");
  }








  return call($ERROR);
});
$symbol_t = 0.0;
$construction_t = 1.0;
$null_t = 2.0;
$data_t = 3.0;
$error_t = 4.0;
$just_t = 5.0;
$delay_evaluate_t = 6.0;
$delay_builtin_func_t = 7.0;
$delay_builtin_form_t = 8.0;
$delay_apply_t = 9.0;
set($exports, "new_symbol", $new_symbol);
set($exports, "symbol_p", $symbol_p);
set($exports, "un_symbol", $un_symbol);
set($exports, "new_construction", $new_construction);
set($exports, "construction_p", $construction_p);
set($exports, "construction_head", $construction_head);
set($exports, "construction_tail", $construction_tail);
$null_v = new Arr($null_t);
set($exports, "null_v", $null_v);
set($exports, "null_p", $null_p);
set($exports, "new_data", $new_data);
set($exports, "data_p", $data_p);
set($exports, "data_name", $data_name);
set($exports, "data_list", $data_list);
set($exports, "new_error", $new_error);
set($exports, "error_p", $error_p);
set($exports, "error_name", $error_name);
set($exports, "error_list", $error_list);
set($exports, "evaluate", $evaluate);
set($exports, "apply", $apply);
set($exports, "force_all_rec", $force_all_rec);
$system_symbol = call($new_symbol, "\xE5\xA4\xAA\xE5\xA7\x8B\xE5\x88\x9D\xE6\xA0\xB8");
set($exports, "system_symbol", $system_symbol);
$name_symbol = call($new_symbol, "\xE7\xAC\xA6\xE5\x90\x8D");
set($exports, "name_symbol", $name_symbol);
$function_symbol = call($new_symbol, "\xE5\x8C\x96\xE6\xBB\x85");
set($exports, "function_symbol", $function_symbol);
$form_symbol = call($new_symbol, "\xE5\xBC\x8F\xE5\xBD\xA2");
set($exports, "form_symbol", $form_symbol);
$equal_symbol = call($new_symbol, "\xE7\xAD\x89\xE5\x90\x8C");
set($exports, "equal_symbol", $equal_symbol);
$evaluate_sym = call($new_symbol, "\xE8\xA7\xA3\xE7\xAE\x97");
set($exports, "evaluate_sym", $evaluate_sym);
$theThing_symbol = call($new_symbol, "\xE7\x89\xB9\xE5\xAE\x9A\xE5\x85\xB6\xE7\x89\xA9");
set($exports, "theThing_symbol", $theThing_symbol);
$something_symbol = call($new_symbol, "\xE7\x9C\x81\xE7\x95\xA5\xE4\xB8\x80\xE7\x89\xA9");
set($exports, "something_symbol", $something_symbol);
$mapping_symbol = call($new_symbol, "\xE6\x98\xA0\xE8\xA1\xA8");
set($exports, "mapping_symbol", $mapping_symbol);
$if_symbol = call($new_symbol, "\xE8\x8B\xA5");
set($exports, "if_symbol", $if_symbol);
$typeAnnotation_symbol = call($new_symbol, "\xE4\xB8\x80\xE9\xA1\x9E\xE4\xBD\x95\xE7\x89\xA9");
set($exports, "typeAnnotation_symbol", $typeAnnotation_symbol);
$isOrNot_symbol = call($new_symbol, "\xE6\x98\xAF\xE9\x9D\x9E");
set($exports, "isOrNot_symbol", $isOrNot_symbol);
$sub_symbol = call($new_symbol, "\xE5\x85\xB6\xE5\xAD\x90");
set($exports, "sub_symbol", $sub_symbol);
$true_symbol = call($new_symbol, "\xE9\x99\xBD");
set($exports, "true_symbol", $true_symbol);
$false_symbol = call($new_symbol, "\xE9\x99\xB0");
set($exports, "false_symbol", $false_symbol);
$quote_symbol = call($new_symbol, "\xE5\xBC\x95\xE7\x94\xA8");
set($exports, "quote_symbol", $quote_symbol);
$apply_symbol = call($new_symbol, "\xE6\x87\x89\xE7\x94\xA8");
set($exports, "apply_symbol", $apply_symbol);
$null_symbol = call($new_symbol, "\xE7\xA9\xBA");
set($exports, "null_symbol", $null_symbol);
$construction_symbol = call($new_symbol, "\xE9\x80\xA3");
set($exports, "construction_symbol", $construction_symbol);
$data_symbol = call($new_symbol, "\xE6\xA7\x8B");
set($exports, "data_symbol", $data_symbol);
$error_symbol = call($new_symbol, "\xE8\xAA\xA4");
set($exports, "error_symbol", $error_symbol);
$symbol_symbol = call($new_symbol, "\xE8\xA9\x9E\xE7\xB4\xA0");
set($exports, "symbol_symbol", $symbol_symbol);
$list_symbol = call($new_symbol, "\xE5\x88\x97");
set($exports, "list_symbol", $list_symbol);
$head_symbol = call($new_symbol, "\xE9\xA6\x96");
set($exports, "head_symbol", $head_symbol);
$tail_symbol = call($new_symbol, "\xE5\xB0\xBE");
set($exports, "tail_symbol", $tail_symbol);
$thing_symbol = call($new_symbol, "\xE7\x89\xA9");
set($exports, "thing_symbol", $thing_symbol);
$theWorldStopped_symbol = call($new_symbol, "\xE5\xAE\x87\xE5\xAE\x99\xE4\xBA\xA1\xE7\x9F\xA3");
set($exports, "theWorldStopped_symbol", $theWorldStopped_symbol);
$effect_symbol = call($new_symbol, "\xE6\x95\x88\xE6\x87\x89");
set($exports, "effect_symbol", $effect_symbol);
$sequentialWordFormation_symbol = call($new_symbol, "\xE7\x82\xBA\xE7\xAC\xA6\xE5\x90\x8D\xE9\x80\xA3");
set($exports, "sequentialWordFormation_symbol", $sequentialWordFormation_symbol);
$inputOutput_symbol = call($new_symbol, "\xE5\x87\xBA\xE5\x85\xA5\xE6\x94\xB9\xE6\xBB\x85");
set($exports, "inputOutput_symbol", $inputOutput_symbol);
$the_world_stopped_v = call($new_error, $system_symbol, call($new_list, $theWorldStopped_symbol, $something_symbol));
$new_data_function_builtin_systemName = call($make_builtin_f_new_sym_f, $data_symbol);
set($exports, "new_data_function_builtin_systemName", $new_data_function_builtin_systemName);
$data_name_function_builtin_systemName = call($make_builtin_f_get_sym_f, $data_symbol, $name_symbol);
set($exports, "data_name_function_builtin_systemName", $data_name_function_builtin_systemName);
$data_list_function_builtin_systemName = call($make_builtin_f_get_sym_f, $data_symbol, $list_symbol);
set($exports, "data_list_function_builtin_systemName", $data_list_function_builtin_systemName);
$data_p_function_builtin_systemName = call($make_builtin_f_p_sym_f, $data_symbol);
set($exports, "data_p_function_builtin_systemName", $data_p_function_builtin_systemName);
$new_error_function_builtin_systemName = call($make_builtin_f_new_sym_f, $error_symbol);
set($exports, "new_error_function_builtin_systemName", $new_error_function_builtin_systemName);
$error_name_function_builtin_systemName = call($make_builtin_f_get_sym_f, $error_symbol, $name_symbol);
set($exports, "error_name_function_builtin_systemName", $error_name_function_builtin_systemName);
$error_list_function_builtin_systemName = call($make_builtin_f_get_sym_f, $error_symbol, $list_symbol);
set($exports, "error_list_function_builtin_systemName", $error_list_function_builtin_systemName);
$error_p_function_builtin_systemName = call($make_builtin_f_p_sym_f, $error_symbol);
set($exports, "error_p_function_builtin_systemName", $error_p_function_builtin_systemName);
$new_construction_function_builtin_systemName = call($make_builtin_f_new_sym_f, $construction_symbol);
set($exports, "new_construction_function_builtin_systemName", $new_construction_function_builtin_systemName);
$construction_p_function_builtin_systemName = call($make_builtin_f_p_sym_f, $construction_symbol);
set($exports, "construction_p_function_builtin_systemName", $construction_p_function_builtin_systemName);
$construction_head_function_builtin_systemName = call($make_builtin_f_get_sym_f, $construction_symbol, $head_symbol);
set($exports, "construction_head_function_builtin_systemName", $construction_head_function_builtin_systemName);
$construction_tail_function_builtin_systemName = call($make_builtin_f_get_sym_f, $construction_symbol, $tail_symbol);
set($exports, "construction_tail_function_builtin_systemName", $construction_tail_function_builtin_systemName);
$symbol_p_function_builtin_systemName = call($make_builtin_f_p_sym_f, $symbol_symbol);
set($exports, "symbol_p_function_builtin_systemName", $symbol_p_function_builtin_systemName);
$null_p_function_builtin_systemName = call($make_builtin_f_p_sym_f, $null_symbol);
set($exports, "null_p_function_builtin_systemName", $null_p_function_builtin_systemName);
$equal_p_function_builtin_systemName = call($systemName_make, call($new_list, $typeAnnotation_symbol, $function_symbol, call($new_list, $isOrNot_symbol, $equal_symbol)));
set($exports, "equal_p_function_builtin_systemName", $equal_p_function_builtin_systemName);
$apply_function_builtin_systemName = call($systemName_make, call($new_list, $typeAnnotation_symbol, call($new_list, $function_symbol, call($new_construction, $function_symbol, $something_symbol), $something_symbol), $apply_symbol));
set($exports, "apply_function_builtin_systemName", $apply_function_builtin_systemName);
$evaluate_function_builtin_systemName = call($systemName_make, call($new_list, $typeAnnotation_symbol, $function_symbol, $evaluate_sym));
set($exports, "evaluate_function_builtin_systemName", $evaluate_function_builtin_systemName);
$list_chooseOne_function_builtin_systemName = call($make_builtin_f_get_sym_f, $list_symbol, call($new_list, $typeAnnotation_symbol, $thing_symbol, $something_symbol));
set($exports, "list_chooseOne_function_builtin_systemName", $list_chooseOne_function_builtin_systemName);
$if_function_builtin_systemName = call($systemName_make, call($new_list, $typeAnnotation_symbol, $function_symbol, $if_symbol));
set($exports, "if_function_builtin_systemName", $if_function_builtin_systemName);
$quote_form_builtin_systemName = call($systemName_make, call($new_list, $typeAnnotation_symbol, $form_symbol, $quote_symbol));
set($exports, "quote_form_builtin_systemName", $quote_form_builtin_systemName);
$lambda_form_builtin_systemName = call($systemName_make, call($new_list, $typeAnnotation_symbol, call($new_list, $form_symbol, call($new_list, $function_symbol, $something_symbol, $function_symbol)), $theThing_symbol));
set($exports, "lambda_form_builtin_systemName", $lambda_form_builtin_systemName);
$function_builtin_use_systemName = call($systemName_make, call($new_list, $form_symbol, call($new_list, $system_symbol, $function_symbol)));
set($exports, "function_builtin_use_systemName", $function_builtin_use_systemName);
$form_builtin_use_systemName = call($systemName_make, call($new_list, $form_symbol, call($new_list, $system_symbol, $form_symbol)));
set($exports, "form_builtin_use_systemName", $form_builtin_use_systemName);
$form_use_systemName = call($systemName_make, call($new_list, $form_symbol, $form_symbol));
set($exports, "form_use_systemName", $form_use_systemName);
$false_v = call($new_data, $false_symbol, call($new_list));
$true_v = call($new_data, $true_symbol, call($new_list));
set($exports, "jsArray_to_list", $jsArray_to_list);
set($exports, "maybe_list_to_jsArray", $maybe_list_to_jsArray);
set($exports, "new_list", $new_list);
set($exports, "delay_p", $any_delay_just_p);
set($exports, "force_all", $force_all);
set($exports, "force1", $force1);
$env_null_v = new Arr();
set($exports, "env_null_v", $env_null_v);
set($exports, "env_set", $env_set);
set($exports, "env_get", $env_get);
set($exports, "env2val", $env2val);
set($exports, "env_foreach", $env_foreach);
set($exports, "val2env", $val2env);
$real_builtin_func_apply_s = new Arr(call($make_builtin_p_func, $data_p_function_builtin_systemName, $data_p), new Arr($new_data_function_builtin_systemName, 2.0, $new_data), call($make_builtin_get_func, $data_name_function_builtin_systemName, $data_p, $data_name), call($make_builtin_get_func, $data_list_function_builtin_systemName, $data_p, $data_list), call($make_builtin_p_func, $error_p_function_builtin_systemName, $error_p), new Arr($new_error_function_builtin_systemName, 2.0, $new_error), call($make_builtin_get_func, $error_name_function_builtin_systemName, $error_p, $error_name), call($make_builtin_get_func, $error_list_function_builtin_systemName, $error_p, $error_list), call($make_builtin_p_func, $null_p_function_builtin_systemName, $null_p), new Arr($new_construction_function_builtin_systemName, 2.0, $new_construction), call($make_builtin_p_func, $construction_p_function_builtin_systemName, $construction_p), call($make_builtin_get_func, $construction_head_function_builtin_systemName, $construction_p, $construction_head), call($make_builtin_get_func, $construction_tail_function_builtin_systemName, $construction_p, $construction_tail), new Arr($equal_p_function_builtin_systemName, 2.0, new Func(function($x = null, $y = null, $error_v = null) use (&$true_v, &$force1, &$any_delay_just_p, &$builtin_func_apply, &$equal_p_function_builtin_systemName, &$ASSERT, &$null_p, &$false_v, &$symbol_p, &$symbol_equal_p, &$data_p, &$data_name, &$data_list, &$construction_p, &$construction_head, &$construction_tail, &$error_p, &$error_name, &$error_list, &$ERROR, &$if_function_builtin_systemName) {
  $H_if = new Func("H_if", function($b = null, $x = null, $y = null) use (&$builtin_func_apply, &$if_function_builtin_systemName) {
    return call($builtin_func_apply, $if_function_builtin_systemName, new Arr($b, $x, $y));
  });
  $H_and = new Func("H_and", function($x = null, $y = null) use (&$H_if, &$false_v) {
    return call($H_if, $x, $y, $false_v);
  });
  $end_2 = new Func("end_2", function($x = null, $y = null, $f1 = null, $f2 = null) use (&$H_and, &$builtin_func_apply, &$equal_p_function_builtin_systemName) {
    return call($H_and, call($builtin_func_apply, $equal_p_function_builtin_systemName, new Arr(call($f1, $x), call($f1, $y))), call($builtin_func_apply, $equal_p_function_builtin_systemName, new Arr(call($f2, $x), call($f2, $y))));
  });
  if ($x === $y) {
    return $true_v;
  }
  $x = call($force1, $x);
  $y = call($force1, $y);
  if (is(call($any_delay_just_p, $x)) || is(call($any_delay_just_p, $y))) {
    return call($builtin_func_apply, $equal_p_function_builtin_systemName, new Arr($x, $y));
  }
  if ($x === $y) {
    return $true_v;
  }
  call($ASSERT, not(call($any_delay_just_p, $x)));
  if (is(call($null_p, $x))) {
    if (not(call($null_p, $x))) {
      return $false_v;
    }
    return $true_v;
  } else if (is(call($symbol_p, $x))) {
    if (not(call($symbol_p, $y))) {
      return $false_v;
    }
    return is(call($symbol_equal_p, $x, $y)) ? $true_v : $false_v;
  } else if (is(call($data_p, $x))) {
    if (not(call($data_p, $y))) {
      return $false_v;
    }
    return call($end_2, $x, $y, $data_name, $data_list);
  } else if (is(call($construction_p, $x))) {
    if (not(call($construction_p, $y))) {
      return $false_v;
    }
    return call($end_2, $x, $y, $construction_head, $construction_tail);
  } else if (is(call($error_p, $x))) {
    if (not(call($error_p, $y))) {
      return $false_v;
    }
    return call($end_2, $x, $y, $error_name, $error_list);
  }




  return call($ERROR);
})), new Arr($apply_function_builtin_systemName, 2.0, new Func(function($f = null, $xs = null, $error_v = null) use (&$force_all, &$construction_p, &$construction_head, &$construction_tail, &$null_p, &$apply) {
  $jslist = null; $iter = null;
  $jslist = new Arr();
  $iter = call($force_all, $xs);
  while (is(call($construction_p, $iter))) {
    call_method($jslist, "push", call($construction_head, $iter));
    $iter = call($force_all, call($construction_tail, $iter));
  }
  if (not(call($null_p, $iter))) {
    return $error_v;
  }
  return call($apply, $f, $jslist);
})), new Arr($evaluate_function_builtin_systemName, 2.0, new Func(function($env = null, $x = null, $error_v = null) use (&$val2env, &$evaluate) {
  $maybeenv = null;
  $maybeenv = call($val2env, $env);
  if ($maybeenv === false) {
    return $error_v;
  }
  return call($evaluate, $maybeenv, $x);
})), call($make_builtin_p_func, $symbol_p_function_builtin_systemName, $symbol_p), new Arr($list_chooseOne_function_builtin_systemName, 1.0, new Func(function($xs = null, $error_v = null) use (&$force1, &$any_delay_just_p, &$builtin_func_apply, &$list_chooseOne_function_builtin_systemName, &$construction_p, &$construction_head) {
  $xs = call($force1, $xs);
  if (is(call($any_delay_just_p, $xs))) {
    return call($builtin_func_apply, $list_chooseOne_function_builtin_systemName, new Arr($xs));
  }
  if (not(call($construction_p, $xs))) {
    return $error_v;
  }
  return call($construction_head, $xs);
})), new Arr($if_function_builtin_systemName, 3.0, new Func(function($b = null, $x = null, $y = null, $error_v = null) use (&$force1, &$any_delay_just_p, &$builtin_func_apply, &$if_function_builtin_systemName, &$data_p, &$force_all, &$data_name, &$symbol_p, &$symbol_equal_p, &$true_symbol, &$false_symbol) {
  $nam = null;
  $b = call($force1, $b);
  if (is(call($any_delay_just_p, $b))) {
    return call($builtin_func_apply, $if_function_builtin_systemName, new Arr($b, $x, $y));
  }
  if (not(call($data_p, $b))) {
    return $error_v;
  }
  $nam = call($force_all, call($data_name, $b));
  if (not(call($symbol_p, $nam))) {
    return $error_v;
  }
  if (is(call($symbol_equal_p, $nam, $true_symbol))) {
    return $x;
  }
  if (is(call($symbol_equal_p, $nam, $false_symbol))) {
    return $y;
  }
  return $error_v;
})));
set($exports, "equal_p", $jsbool_equal_p);
set($exports, "simple_print", $simple_print);
set($exports, "simple_print_force_all_rec", $simple_print_force_all_rec);
set($exports, "simple_parse", $simple_parse);
set($exports, "complex_parse", $complex_parse);
set($exports, "complex_print", $complex_print);
