<?php


interface SourceInterface
{
    /**
     * @return string
     */
    public function getTable();

    /**
     * @return int
     */
    public function getId();
}