<?php

namespace App\utils\tables;

class Table
{
    private array $arrayTable;
    private array $metaArrayTable;

    public function __construct(array $arrayTable = [],array $metaArrayTable = [])
    {
        $this->arrayTable = $arrayTable;
        $this->metaArrayTable = $metaArrayTable;
    }

    /**
     * Get the value of arrayTable
     */
    public function getArrayTable():array
    {
        return $this->arrayTable;
    }

    /**
     * Set the value of arrayTable
     *
     * @return  self
     */
    public function setArrayTable(array $arrayTable)
    {
        $this->arrayTable = $arrayTable;

        return $this;
    }
    /**
     * Get the value of metaArrayTable
     */
    public function getMetaArrayTable():array
    {
        return $this->metaArrayTable;
    }

    /**
     * Set the value of metaArrayTable
     *
     * @return  self
     */
    public function setMetaArrayTable(array $metaArrayTable)
    {
        $this->metaArrayTable = $metaArrayTable;

        return $this;
    }

    public function toHTML(): string
    {
        $str = '<table>';
        $str .= $this->getThead();
        $str .='<tbody>';
        foreach ($this->arrayTable as $lines) {
            $str .= '<tr>';
            foreach ($lines as $cell) {
                $str .= sprintf('<td>%s</td>', $cell);
            }
            $str .= '</tr>';
        }
        $str .='</tbody>';
        $str .= '</table>';
        return $str;
    }

    private function getThead(): string {
        $str = '';
        if(!empty($this->metaArrayTable)) {
            $str = '<thead><tr>';
            foreach ($this->metaArrayTable as $colName) {
                $str .= sprintf('<th>%s</th>', $colName);
            }
            $str .= '</tr></thead>';
        }
        return $str;
    }
}
