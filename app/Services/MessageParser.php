<?php

namespace App\Services;

use Carbon\Carbon;

class MessageParser
{
    /**
     * The raw message that needs to be parsed.
     *
     * @var string
     */
    private $message;

    /**
     * @var
     */
    private $data;

    /**
     * @var string
     */
    private $newlineCharacter = "\n";

    /**
     * Substitutes the parameters with values from the query
     *
     * @param string $message Message to be parsed
     * @param array  $data Data to be injected
     * @return string
     */
    public function parse($message = '', $data = [])
    {
        $this->setMessage($message);
        $this->setData($data);

        if ( ! str_contains($this->message, "\n")) {
            $this->newlineCharacter = "<br>";
        }

        if ($this->isGroupedData()) {
            $this->expandLoop();
        }

        foreach ($this->getData() as $key => $value) {
            $this->setMessage($this->replaceVariable(trim($key), $value, $this->getMessage()));
        }

        return $this->getMessage();
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param $data
     */
    private function setData($data)
    {
        $this->data = collect($data)->map(function ($data) {
            return is_object($data) ? (array)$data : $data;
        })->toArray();
    }

    /**
     * @return mixed
     */
    private function getData()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isGroupedData()
    {
        return is_array($this->getFirstInLoopData());
    }

    /**
     * @return mixed
     */
    private function getFirstInLoopData()
    {
        $data = $this->getData();

        return array_shift($data);
    }

    /**
     * @return void
     */
    public function expandLoop()
    {
        if ($this->hasLoop($this->message)) {
            $loop = collect(explode($this->newlineCharacter, $this->message));

            $indices = $this->getLoopIndices($loop);
            $loop->splice($indices[0], ($indices[1] - $indices[0]) + 1, $this->parseLoop());
            $this->setMessage(implode($this->newlineCharacter, $loop->toArray()));
            $this->setData($this->getFirstInLoopData());
        }
    }

    /**
     * @param $string
     * @return bool
     */
    private function hasLoop($string)
    {
        return str_contains($string, '@loop') && str_contains($string, '@endloop');
    }

    /**
     * @param $loop
     * @return array
     */
    private function getLoopIndices($loop)
    {
        $indices = [];

        foreach ($loop as $key => $value) {
            if (str_contains($value, '@loop') || str_contains($value, '@endloop')) {
                $indices[] = $key;
            }
        }

        return $indices;
    }

    /**
     * @return array
     */
    private function parseLoop()
    {
        $html = [];

        foreach ($this->data as $data) {
            $string = implode($this->newlineCharacter, $this->extractLoop());

            foreach ($data as $key => $value) {
                $string = $this->replaceVariable($key, $value, $string);
            }

            $html[] = $string;
        }

        return $html;
    }

    /**
     * @return array
     */
    private function extractLoop()
    {
        $start = strpos($this->message, '@loop');
        $length = strpos($this->message, '@endloop') - $start;
        $lines = collect(explode($this->newlineCharacter, substr($this->message, $start, $length)));

        return $lines->slice(1, $lines->count() - 2)->toArray();
    }

    /**
     * @param $key
     * @param $value
     * @param $string
     * @return mixed
     */
    public function replaceVariable($key, $value, $string)
    {
        $variable = $this->findTemplateTagFromKey($key, $string);

        return str_replace($variable, $this->valueFormatter($variable, $value), $string);
    }

    /**
     * @param $key
     * @param $string
     * @return mixed
     */
    public function findTemplateTagFromKey($key, $string)
    {
        preg_match("/{(?=$key)\w+.*?}/", $string, $matches);

        return $matches ? $matches[0] : null;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $variable
     * @param $value
     * @return mixed
     */
    public function valueFormatter($variable, $value)
    {
        if ( ! str_contains($variable, '|')) {
            return trim($value);
        }

        $elements = preg_split("/[|:]/", $this->extract($variable));

        if ($elements[1] === 'date') {
            return Carbon::createFromFormat('Y-m-d', $value)->format($elements[2]);
        }
    }

    /**
     * In essence removes curly braces from a variable and returns it as a 'key'.
     *
     * @param $variable
     * @return mixed
     */
    public function extract($variable)
    {
        return preg_replace("/[{}]/", '', $variable);
    }

}