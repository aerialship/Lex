
Lex
====

PHP implementation of Lexical Analyzer.


Usage
=====


Token definition
----------------

Define the tokens in the yaml file. Key is regex pattern for the token, and value is token name. All patterns with
empty name will be ignored and will not result in a token, but will keep the scan running and not brake it. On the
other hand, if scanner encounters a non-recognizable chunk it will raise an exception.
```
# math.yml
\s:
\d+: number
\+: plus
-: minus
\*: mul
/: div
```

> **Note:**
> Regex pattern MUST NOT include delimiters, nor start and end of string meta-chars (^ and $).
> They are prepeded with those during the scan.
> If invalid pattern supplied it will trigger InvalidArgumentException during the configuration load


Scanning with a callback
------------------------

Construct the lexer with such tokens config
``` php
$lexer = new Lexer(new LexConfig(new YamlFileConfig('math.yml')));
```

And now you are ready to tokenize the input string
``` php
$lexer->tokenizeAsync(' 2131 + 33   / 567', function(Token $token) {
    print "{$token->getToken()}({$token->getValue()})\n";
});
```

Which will print the result on output
```
number(2131)
plus(+)
number(33)
div(/)
number(567)
```

Scan and return array of tokens
-------------------------------

Optionally you could get all tokens collected into an array and returned together, without supplying a callback
for individual tokens
``` php
$result = $lexer->tokenize(' 2131 + 33   / 567');
print_r($result);
```

Unknown token exception
-----------------------

If at any position content of input string does not match with any regex pattern from the config
the UnknownTokenException will be thrown containing the offset of its position

``` php
try {
    $lexer->tokenize(' 2131 + blabla');
} catch (UnknownTokenException $ex) {
    print $ex->getOffset();  // 8
}
```

