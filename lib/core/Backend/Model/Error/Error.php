<?php
namespace Backend\Model\Error;

class Error
{
    private $exception;
    
    public function __construct($exception=null)
    {
        echo "
            <strong>
                <font color=\"red\">
                    An exception was captured:
                </font>
            </strong>
            <pre>
        ";
        print_r($exception);
        echo "
            </pre>
        ";
    }
}