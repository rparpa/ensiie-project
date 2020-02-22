<?php


/**
 * Class chat
 */
class Chat implements SourceInterface
{
    /**
     * @return string
     */
    public function getTable(): string
    {
        return "chat";
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return -1;
    }
}