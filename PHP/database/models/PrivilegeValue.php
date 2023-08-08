<?php

class PrivilegeValue implements JsonSerializable
{

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function __construct(
        private int $id,
        private string $value = "",
    ) {
        $this->id = $id;
        $this->setValue($value);
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getValue(): string
    {
        return $this->value;
    }
    // setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
    // To Array
    public function toArray(): array
    {
        $data = [
            "id" => $this->getId(),
            "value" => $this->getValue(),
        ];

        return $data;
    }
}
