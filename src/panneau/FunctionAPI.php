<?php


namespace panneau;


class FunctionAPI
{

    public $map = [];

    /** Panneau Function
     * @param string $name
     * @param bool $value
     * @param string $cmd
     */
    public function setVarTo(string $name, bool $value, $cmd = ""): void
    {
        if ( $value == true ) {
            if ( !isset($this->map[$name]) ) {
                $this->map[$name] = $cmd;
            }
        } elseif ( $value == false ) {
            if ( isset($this->map[$name]) ) {
                    unset($this->map[$name]);
            }
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isVarToggle(string $name): bool
    {
        if ( isset($this->map[$name]) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $name
     * @return string
     */
    public function getVar(string $name): string
    {
        if ( isset($this->map[$name]) ) {
            return $this->map[$name];
        }
        return "";
    }
}

?>