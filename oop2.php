<?php

interface JsonInterface
{
    public function toJson(): string;
//    public function toJson2(): string;
}

abstract class User
{
    public string $race = 'unknown';
    private float $money = 0;
    private DateTimeImmutable $createdAt;
    public static int $userCount = 0;

    abstract public function type(): string;
    private function __construct(private string $firstName, private string $lastName)
    {
        $this->createdAt = new DateTimeImmutable();
        $this->validateName($this->firstName);
        $this->validateName($this->lastName);
        self::$userCount += 1; //self::$userCount = self::$userCount + 1;
    }

    protected static function createBasic(string $firstName, string $lastName): static
    {
        // self - вызываем метод именно этого класса, static - вызываем метод текущего класса.
        return new static($firstName, $lastName);
    }

    protected static function createWithMoney(string $firstName, string $lastName, float $money): static
    {
        $entity = static::createBasic($firstName, $lastName);
        $entity->money = $money;
        return $entity;
    }

    public function fullName(): string
    {
        return "$this->firstName $this->lastName";
    }

    private function validateName(string $name): void
    {
        if (preg_match('/[0-9]+/', $name)){
            throw new Exception('name has digit symbols');
        }
    }

    public function getMoney():float
    {
        return $this->money;
    }

}

final class Manager extends User implements JsonInterface
{
    public static function create(string $firstName, string $lastName): self
    {
        return parent::createBasic($firstName, $lastName);
    }

    public function type(): string
    {
        return 'manager';
    }

    public function toJson(): string
    {
        $data = ['fullName' => $this->fullName(), 'type' => $this->type()];
        return json_encode($data);
    }

}

final class Client extends User implements JsonInterface
{
    public static function create(string $firstName, string $lastName, float $money): self
    {
        return parent::createWithMoney($firstName, $lastName, $money);
    }

    public function type(): string
    {
        return 'client';
    }

    public function toJson(): string
    {
        $data = ['fullName' => $this->fullName(), 'type' => $this->type(), 'money' => $this->getMoney()];
        return json_encode($data);
    }


}

function abc(JsonInterface $entity): string
{
    return "User: {$entity->toJson()}";
}

$ivan = Manager::create('ivan', 'peskov');
$andrey = Client::create('andrey', 'peskov', 150.40);
echo $ivan->type().PHP_EOL;
echo $andrey->type().PHP_EOL;
echo $andrey->fullName().PHP_EOL;
$arr = [$ivan, $andrey, 'abc', 123];
foreach ($arr as $item){
    if ($item instanceof JsonInterface){
        echo abc($item).PHP_EOL;
    } else {
        echo $item.PHP_EOL;
    }
}
//echo abc($ivan).PHP_EOL;
//echo abc($andrey).PHP_EOL;
//echo abc(123).PHP_EOL;

//$ivan->setMoney(102);
//echo $ivan->getMoney().PHP_EOL;
//var_dump($ivan);