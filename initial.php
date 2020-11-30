<?php


class StringValue
{
    protected string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function message(): string
    {
        $word = 'hello';

        $pos = strpos($this->text, $word);

        if ($pos === -1) {
            return sprintf("'%s' does not contain '%s'", $this->text, $word);
        }

        if ($pos === 0) {
            return sprintf("'%s' contains '%s' but is not the first word", $this->text, $word);
        }

        return sprintf("'%s' contains '%s' and its the first word", $this->text, $word);
    }
}

class NumberValue
{
    /** @var int|float $number */
    protected $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function message()
    {
        try {
            switch (abs($this->number) / $this->number) {
                case 1:
                    $sign = 'positive';
                    break;
                case -1:
                    $sign = 'negative';
                    break;
                default:
                    $sign = 'no sign';
            };
        } catch (DivisionByZeroError $exception) {
            $sign = 'no sign';
        }

        return sprintf("The sign of %s is %s", $this->number, $sign);
    }
}


function f($value)
{
    $obj = null;

    if (is_numeric($value)) {
        $obj = new NumberValue($value);
    } else if (is_string($value)) {
        $obj = new StringValue($value);
    }

    if ($obj) {
        return 'Message: ' . $obj->message() . PHP_EOL;
    }

    return 'Message: ' . PHP_EOL;
}


echo f('Scalable Scripts says hello');
echo f('hello from Scalable Scripts');
echo f('Hi there');
echo f(1);
echo f(-2.5);
echo f(0);
echo f(null);
