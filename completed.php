<?php


class StringValue
{
    public function __construct(protected string $text)
    {
    }

    public function message(): string
    {
        $word = 'hello';

        if (!str_contains(haystack: $this->text, needle: $word)) {
            return sprintf("'%s' does not contain '%s'", $this->text, $word);
        }

        if (str_starts_with(haystack: $this->text, needle: $word)) {
            return sprintf("'%s' contains '%s' and its the first word", $this->text, $word);
        }

        return sprintf("'%s' contains '%s' but is not the first word", $this->text, $word);
    }
}

class NumberValue
{
    public function __construct(protected int|float $number)
    {
    }

    public function message()
    {
        try {
            $sign = match ((int)(abs($this->number) / $this->number)) {
                1 => 'positive',
                -1 => 'negative',
                default => 'no sign'
            };
        } catch (DivisionByZeroError) {
            $sign = 'no sign';
        }

        return sprintf("The sign of %s is %s", $this->number, $sign);
    }
}


function f(mixed $value)
{
    $obj = null;

    if (is_numeric($value)) {
        $obj = new NumberValue($value);
    } else if (is_string($value)) {
        $obj = new StringValue($value);
    }

    return 'Message: ' . $obj?->message() . PHP_EOL;
}


echo f('Scalable Scripts says hello');
echo f('hello from Scalable Scripts');
echo f('Hi there');
echo f(1);
echo f(-2.5);
echo f(0);
echo f(null);
